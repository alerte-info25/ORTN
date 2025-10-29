<?php

use App\Models\Redacteur;
use App\Models\Sondage;
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
        Schema::create('client_sondages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(Sondage::class)->constrained()->onDelete("CASCADE");
            $table->longText('option_choisie');
            $table->longText("commentaire")->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'sondage_id']);    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_sondages');
    }
};
