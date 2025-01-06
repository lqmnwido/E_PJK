<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    public function up(): void
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('profileID');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('noIC');
            $table->date('DOB');
            $table->string('nationality');
            $table->string('race');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone')->nullable();
            $table->string('address');
            $table->string('heir')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
    
}
