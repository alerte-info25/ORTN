<?php

use App\Models\CategorieAudio;
use App\Models\CategorieVideo;
use App\Models\Media;
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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Media::class)->constrained()->onDelete("CASCADE");
            $table->foreignIdFor(CategorieVideo::class)->constrained()->onDelete("CASCADE");
            $table->string("url_video");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
