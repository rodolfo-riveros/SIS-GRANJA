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
        Schema::create('cows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('photo');
            $table->unsignedBigInteger('mother_id')->nullable();
            $table->unsignedBigInteger('father_id')->nullable();
            $table->date('birth_date');
            $table->timestamps();

            $table->foreign('mother_id')->references('id')->on('cows')->nullOnDelete();
            $table->foreign('father_id')->references('id')->on('cows')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cows');
    }
};
