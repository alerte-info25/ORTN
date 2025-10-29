<?php

use App\Models\Departement;
use App\Models\Genre;
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
        Schema::create('redacteurs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(Departement::class)->constrained()->onDelete("CASCADE");
            $table->string("matricule")->unique();
            $table->string("profession");
            $table->date("date_embauche");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redacteurs');
    }
};
