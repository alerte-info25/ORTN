<?php

use App\Models\Partenaire;
use App\Models\TypePartenariat;
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
        Schema::create('partenaire_type_partenariats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypePartenariat::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(Partenaire::class)->constrained()->onDelete("CASCADE");
            $table->date("date_debut");
            $table->date("date_fin");
            $table->string("statut");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaire_type_partenariaits');
    }
};
