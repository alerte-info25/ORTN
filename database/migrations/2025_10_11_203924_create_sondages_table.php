<?php

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
        Schema::create('sondages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Redacteur::class)->constrained()->onDelete("CASCADE");
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('option1');
            $table->string('option2');
            $table->string('option3')->nullable(); 
            $table->string('option4')->nullable(); 
            $table->string('option5')->nullable(); 
            $table->timestamp('date_debut')->useCurrent();
            $table->timestamp('date_fin')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sondages');
    }
};
