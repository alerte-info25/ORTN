<?php

use App\Models\Redacteur;
use App\Models\TypeProgramme;
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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypeProgramme::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(Redacteur::class)->constrained()->onDelete("CASCADE");
            $table->string('nom');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string('animateur')->nullable();
            $table->json('jour_diffusion');
            for ($i = 1; $i <= 4; $i++) {
                $table->time("heure_debut{$i}")->nullable();
                $table->time("heure_fin{$i}")->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
