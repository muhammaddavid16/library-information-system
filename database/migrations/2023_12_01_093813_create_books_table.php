<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id');
            $table->uuid('bookshelf_id');
            $table->string('isbn', 100)->unique('books_isbn_unique');
            $table->string('title', 100)->unique('books_title_unique');
            $table->string('publisher', 100)->nullable();
            $table->year('publication_year', 100);
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('bookshelf_id')->references('id')->on('bookshelves');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
