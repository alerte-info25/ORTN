<?php

use App\Models\CategorieNewsletter;
use App\Models\Media;
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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Media::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(CategorieNewsletter::class)->constrained()->onDelete("CASCADE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
