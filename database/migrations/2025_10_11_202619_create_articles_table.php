<?php

use App\Models\CategorieArticle;
use App\Models\CategorieAudio;
use App\Models\Media;
use App\Models\TypeArticle;
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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Media::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(CategorieArticle::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(TypeArticle::class)->constrained()->onDelete("CASCADE");
            $table->string("sous_titre");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
