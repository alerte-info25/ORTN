<?php

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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete("CASCADE");
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->string('format')->nullable();
            $table->string('venue')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('online_url')->nullable();
            $table->string('organizer');
            $table->string('organizer_email')->nullable();
            $table->string('organizer_phone')->nullable();
            $table->string('image')->nullable();
            $table->integer('capacity')->nullable();
            $table->enum('access_type', ['free', 'paid']);
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('requires_registration')->default(false);
            $table->string('registration_url')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
