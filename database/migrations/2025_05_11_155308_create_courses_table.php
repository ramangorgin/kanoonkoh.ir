<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // نام دوره
            $table->string('type'); // internal یا external
            $table->string('provider')->nullable(); // مرجع برگزاری (برای external)
            $table->date('date')->nullable(); // تاریخ دوره
            $table->boolean('certificate_required')->default(true);
            $table->unsignedBigInteger('created_by')->nullable(); // ادمینی که دوره رو ساخته
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
        Schema::dropIfExists('courses');
    }
};
