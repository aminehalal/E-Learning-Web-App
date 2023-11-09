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
        Schema::create('course_etats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('courseId');
            $table->unsignedBigInteger('teacherId');
            $table->unsignedBigInteger('studentId');
            $table->string('etat');
            $table->string('comment')-> nullable();
            $table->timestamps();


            $table->foreign('teacherId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('courseId')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('studentId')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_etats');
    }
};
