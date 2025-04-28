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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('UserID');
            $table->string('firstname',60);
            $table->string('lastname',60);
            $table->string('username',60);
            $table->string('password');
            $table->string('address')->nullable();
            $table->unsignedBigInteger('RoleID');
            $table->string('email',60)->nullable();
            $table->string('contactNumber',11)->nullable();
            $table->date('birthday');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
