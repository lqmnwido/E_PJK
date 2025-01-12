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
        Schema::create('jenazah', function (Blueprint $table) {
            $table->id();
            $table->string('jenazahID');
            $table->string('userID');
            $table->string('jenazahIC');
            $table->string('jenazahName');
            $table->string('jenazahGender');
            $table->string('jenazahDOB');
            $table->string('jenazahBangsa');
            $table->string('jenazahWarga');
            $table->date('deathDate');
            $table->string('locationID')->nullable();
            $table->string('permit')->nullable();
            $table->string('graveLot')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenazah');
    }
};
