<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     // Foreign keys
     // https://makitweb.com/how-to-add-foreign-key-in-migration-laravel/ 
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn',255);
            $table->string('titulo',255);
            $table->integer('year');
            $table->integer('cantidad');
            $table->unsignedBigInteger('editorial_id');
            $table->unsignedBigInteger('author_id');
            // links
            $table->foreign('editorial_id')->references('id')->on('editorials')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
