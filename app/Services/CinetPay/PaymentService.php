<?php

namespace App\Services\CinetPay;

use App\Models\Payment;
use Exception;

class PaymentService
{
    /**
     * Initialise le paiement d'un payment via CinetPay
     * 
     * @param payment $payment Le payment à traiter
     * @return array Les paymentnées de paiement (avec le lien de paiement)
     */
    public function initierPaiement(Payment $payment)
    {
        try {
            // 1. Créer une instance de CinetPay avec les identifiants
            $cinetpay = new CinetPay(
                Marchand::getSiteId(),      // Ton site_id
                Marchand::getApiKey(),      // Ta clé API
                true                        // Vérifier SSL (true en production)
            );

            // 2. Préparer les paymentnées pour CinetPay
            $donneeApi = [
                // OBLIGATOIRES
                'transaction_id' => $payment->transaction_id,
                'amount' => $payment->montant,  // Montant en FCFA
                'currency' => 'XOF',              // Devise (XOF = FCFA)
                'description' => "payment de {$payment->prenom} {$payment->nom}",
                
                // Informations client
                'customer_name' => $payment->nom,
                'customer_surname' => $payment->prenom,
                'customer_email' => $payment->email,
                'customer_phone_number' => $payment->telephone,
                
                // URLs de callback
                'notify_url' => $payment->notify_url,  // CinetPay nous notifie ici
                'return_url' => $payment->return_url,  // Où rediriger l'utilisateur
                
                // Méthode de paiement
                'channels' => 'ALL',
                
                // Métapaymentnées (infos supplémentaires)
                'metadata' => json_encode([
                    'payment_id' => $payment->id,
                    'nationalite' => $payment->nationalite
                ]),
                
                // paymentnées de facturation (vide si pas renseigné)
                'invoice_data' => []
            ];

            // dd([
            //     $payment->adresse,
            //     $payment->ville,
            //     $payment->pays,
            //     $payment->code_postal
            // ]);

            // 3. Si paiement par carte, ajouter les infos obligatoires
            if ($payment->methode_paiement === 'card') {
                $donneeApi['customer_address'] = $payment->adresse ?? 'Non renseigné';
                $donneeApi['customer_city'] = $payment->ville ?? 'Non renseigné';
                $donneeApi['customer_country'] = $payment->pays ?? 'FR'; 
                $donneeApi['customer_state'] = $payment->pays ?? 'FR';  
                $donneeApi['customer_zip_code'] = $payment->code_postal ?? '00000';
            }

            // 4. Générer le lien de paiement
            $resultat = $cinetpay->generatePaymentLink($donneeApi);

            // 5. Sauvegarder le payment_token dans la base
            if (isset($resultat['data']['payment_token'])) {
                $payment->update([
                    'payment_token' => $resultat['data']['payment_token']
                ]);
            }

            return $resultat;

        } catch (Exception $e) {
            // En cas d'erreur, on la remonte
            throw new Exception("Erreur CinetPay : " . $e->getMessage());
        }
    }

    /**
     * Détermine le canal de paiement selon la méthode choisie
    */
    // private function determinerCanal($methodePaiement)
    // {
    //     return match($methodePaiement) {
    //         'card' => 'CREDIT_CARD',      // Carte bancaire
    //         'mobile' => 'MOBILE_MONEY',   // Mobile Money
    //         default => 'ALL'              // Tous les moyens
    //     };
    // }

    /**
     * Vérifie le statut d'un paiement auprès de CinetPay
     * 
     * @param string $transactionId L'ID de transaction
     * @return array Les informations de paiement
    */
    public function verifierPaiement($transactionId)
    {
        try {
            $cinetpay = new CinetPay(
                Marchand::getSiteId(),
                Marchand::getApiKey(),
                true
            );

            // Appeler l'API de vérification
            $cinetpay->getPayStatus($transactionId, Marchand::getSiteId());

            // Retourner les informations structurées
            return [
                'code' => $cinetpay->chk_code,
                'message' => $cinetpay->chk_message,
                'amount' => $cinetpay->chk_amount,
                'currency' => $cinetpay->chk_currency,
                'payment_method' => $cinetpay->chk_payment_method,
                'payment_date' => $cinetpay->chk_payment_date,
                'operator_id' => $cinetpay->chk_operator_id,
                'metadata' => $cinetpay->chk_metadata,
            ];

        } catch (Exception $e) {
            throw new Exception("Erreur vérification : " . $e->getMessage());
        }
    }

    /**
     * Met à jour le statut du payment après paiement
     */
    public function mettreAJourStatut(Payment $payment, array $infoPaiement)
    {
        // Code 00 = paiement réussi chez CinetPay
        if ($infoPaiement['code'] == '00') {
            $payment->update([
                'statut' => Payment::STATUT_PAYE,
                'cinetpay_transaction_id' => $infoPaiement['operator_id'] ?? null
            ]);
            return true;
        }

        // Sinon, la requête est marquée comme échoué
        $payment->update([
            'statut' => Payment::STATUT_ECHOUE
        ]);
        return false;
    }
}