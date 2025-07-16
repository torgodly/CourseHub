<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('users')->cascadeOnDelete();
            $table->string('title', 255);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('learn_goals')->nullable();
            $table->json('requirements')->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->decimal('price', 8, 2)->default(0.00);
            $table->boolean('is_free')->default(false);
            $table->boolean('is_approved')->default(true);
            $table->string('status')->default(\App\Enum\CourseStatus::Draft->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
