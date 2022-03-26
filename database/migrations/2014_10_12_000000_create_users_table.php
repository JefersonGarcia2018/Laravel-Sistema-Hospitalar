<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('cpf', 14)->unique();
            $table->string('celular', 14);
            $table->boolean('admin')->nullable();
            $table->boolean('rh')->nullable();
            $table->boolean('recepcao')->nullable();
            $table->boolean('enfermagem')->nullable();
            $table->boolean('medicina')->nullable();
            $table->string('setor', 50);
            $table->string('cargo', 50);
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
