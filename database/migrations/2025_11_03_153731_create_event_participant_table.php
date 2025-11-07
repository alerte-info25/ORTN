<?php

use App\Models\Event;
use App\Models\Participant;
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
        Schema::create('event_participant', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Event::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Participant::class)->constrained()->onDelete('cascade');
            $table->enum('status', ['inscrit', 'present', 'absent'])->default('inscrit');
            $table->timestamp('registered_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_participant');
    }
};
