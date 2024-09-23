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
        Schema::create('ekstrakulikuler_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ekstrakulikuler_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('year');

            $table->foreign('ekstrakulikuler_id')
                  ->references('id')
                  ->on('ekstrakulikuler')
                  ->onDelete('cascade');

            $table->foreign('student_id')
                  ->references('id')
                  ->on('student')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakulikuler_siswa');
    }
};
