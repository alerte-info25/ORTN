<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone');
            $table->string('nationalite');
            $table->string('pays');
            $table->string('ville');
            $table->string('adresse');
            $table->string('code_postal');
            $table->decimal('montant', 10, 2);
            $table->string('methode_paiement')->nullable();
            $table->string('transaction_id')->unique();
            $table->string('cinetpay_transaction_id')->nullable();
            $table->string('payment_token')->nullable();
            $table->string('statut')->default('en_attente');
            $table->string('notify_url')->nullable();
            $table->string('return_url')->nullable();
            $table->timestamp('date_heure_don')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dons');
    }
};
