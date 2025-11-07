<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Dashboard\RedacteurStoreRequest;
use App\Mail\Identifiant\SendIdentifiantEmail;
use App\Mail\Welcome\WelcomeEmail;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Departement;
use App\Models\Genre;
use App\Models\Localite;
use App\Models\Redacteur;
use App\Models\TypeContact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RedacteurController extends Controller
{
    public function form ()
    {
        return view ("back.redacteurs.redacteurs");
    }

    public function render ()
    {
        $redacteurs = Redacteur::with(['user', 'departement'])->latest()->paginate(10);
        $redacteursCount = Redacteur::count();
        return view ("back.redacteurs.redacteursListe", compact(
            "redacteurs", "redacteursCount"
        )); 
    }

    public function delete (Redacteur $redacteur)
    {
        try {
            $redacteur->user->contacts()->delete();
            $redacteur->user()->delete();
            $redacteur->delete();
       

            return redirect()->back()->with('alert', [
                'message' => "redacteur supprimé avec succès",
                'type' => 'success'
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'message' => "Impossible de supprimer le rédacteur : " . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function store (RedacteurStoreRequest $request)
    {
        // dd($request->validated());

        try {

            $matricule = "red - ". uniqid();

            $password = Str::random(10);

            DB::beginTransaction();

            $data = $request->validated();

            $genre = Genre::firstOrCreate([
                'libelle' => $data['genre']
            ]);

            $localite = Localite::firstOrCreate([
                'libelle' => $data['localite']
            ]);

            $typeContact = TypeContact::firstOrCreate([
                'libelle' => 'telephone',
            ]);

            $departement = Departement::firstOrCreate([
                'libelle' => $data["departement"],
            ]);

            $user = User::firstOrCreate([
                'genre_id' => $genre->id,
                'localite_id' => $localite->id,
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
                'password' => Hash::make($password), 
                'role' => 'redacteur',
            ]);

            $contact = Contact::firstOrCreate([
                'type_contact_id' => $typeContact->id,
                'user_id' => $user->id,
                'libelle' => $data['contact'],
            ]);

            $redacteur = Redacteur::firstOrCreate([
                'user_id' => $user->id,
                'departement_id' => $departement->id,
                'matricule' => $matricule,
                'profession' => $data['poste'],
                'date_embauche' => $data['date_embauche']
            ]);

            // mail de bienvenue avec les infos de connexion
            Mail::to($user->email)->queue(new SendIdentifiantEmail($user, $password));

            DB::commit();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'le redacteur ' . $user->nom . ' a été créé avec succès ! Bienvenue sur ORTN.',
                'nom' => $user->nom,
                'matricule' => $redacteur->matricule,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}
