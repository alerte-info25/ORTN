<?php

use App\Models\Media;
use App\Models\Tags;
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
        Schema::create('media_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Media::class)->constrained('media')->onDelete('cascade');
            $table->foreignIdFor(Tags::class)->constrained('tags')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['media_id', 'tags_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_tags');
    }
};
