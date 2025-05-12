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
        Schema::create('course_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            $table->string('title'); // نام دوره پیشنهادی
            $table->string('provider')->nullable(); // مرجع مدنظر کاربر
            $table->string('teacher')->nullable(); // استاد پیشنهادی
            $table->date('suggested_date')->nullable(); // تاریخ پیشنهادی (میلادی)
    
            $table->enum('status', ['pending', 'seen', 'rejected', 'approved'])->default('pending');
            $table->text('admin_note')->nullable();
    
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
        Schema::dropIfExists('course_requests');
    }
};
