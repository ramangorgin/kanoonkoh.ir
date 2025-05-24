<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // اطلاعات هویتی
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender')->nullable(); // male, female
            $table->date('birth_date')->nullable();
            $table->string('father_name')->nullable();
            $table->string('national_id')->nullable()->unique();
            $table->string('personal_photo')->nullable();

            // اطلاعات تماس و آدرس
            $table->string('phone')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code')->nullable();

            // اطلاعات دوره‌های پیشین
            $table->json('previous_courses')->nullable(); 

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
