<?php

use App\Models\Media;
use App\Models\Partenaire;
use App\Models\Redacteur;
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
        Schema::create('publicites', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Media::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(Partenaire::class)->constrained()->onDelete("CASCADE");
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicites');
    }
};
