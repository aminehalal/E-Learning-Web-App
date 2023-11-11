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
        Schema::create('teacher_demandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacherId');
            $table->string('username');
            $table->string('certificate');
            $table->longText('coverLetter');
            $table->string('etat')->default('Not Yet');
            $table->timestamps();

            $table->foreign('teacherId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_demandes');
    }
};
