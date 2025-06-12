<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramUserRolesTable extends Migration
{
    public function up()
    {
        Schema::create('program_user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('role_title'); // مثلا: سرپرست، راهنما و ...
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_user_roles');
    }
}
