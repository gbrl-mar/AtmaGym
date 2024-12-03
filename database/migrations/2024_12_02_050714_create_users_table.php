<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel users.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->date('birthdate');
            $table->string('gender');
            $table->string('password');
            $table->double('weight')->nullable();
            $table->double('height')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('idMember')->nullable();
            $table->unsignedBigInteger('idPayment')->nullable();
            $table->timestamps();

            $table->foreign('idMember')->references('id')->on('memberships')->onDelete('cascade');

            $table->foreign('idPayment')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Menghapus tabel users jika rollback.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}