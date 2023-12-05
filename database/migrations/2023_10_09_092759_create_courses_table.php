<?php

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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('introduction');
            $table->decimal('price', 5, 2);
            $table->tinyInteger('discount');
            $table->tinyInteger('category_id')->unsigned();
            $table->integer('instructor_id')->unsigned();
            $table->string('trailer_url');
            $table->decimal('average_rating', 2, 1);
            $table->integer('num_reviews');
            $table->integer('total_students');
            $table->integer('total_lessons');
            $table->tinyInteger('languages');
            $table->tinyInteger('level');
            $table->string('poster_url');
            $table->decimal('total_time', 4, 1);
            $table->text('description');
            $table->text('learns_description');
            $table->text('requirements_description');
            $table->enum('is_active', ['true', 'false']);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories');
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
