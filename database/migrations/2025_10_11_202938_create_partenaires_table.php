<?php

use App\Models\User;
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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete("CASCADE");
            $table->string("nom");
            $table->longText("description");
            $table->string("email")->unique();
            $table->string("contact");
            $table->string("site_web")->nullable();
            $table->string("reseaux")->nullable();
            $table->string("adresse")->nullable();
            $table->string("secteur_activite")->nullable();
            $table->string("logo")->nullable();
            $table->date("date_debut")->nullable();
            $table->date("date_fin")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
