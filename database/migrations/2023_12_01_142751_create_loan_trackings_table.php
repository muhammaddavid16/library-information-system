<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_trackings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('loan_id')->unique('loan_trackings_load_id_unique');
            $table->integer('total_borrowed');
            $table->integer('total_returned')->default(0);
            $table->timestamps();

            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_trackings');
    }
};
