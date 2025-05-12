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
        Schema::create('program_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            $table->string('title'); // عنوان برنامه پیشنهادی
            $table->string('region'); // منطقه پیشنهادی
            $table->string('leader')->nullable(); // سرپرست پیشنهادی
            $table->date('suggested_date')->nullable(); // تاریخ پیشنهادی میلادی
    
            $table->enum('status', ['pending', 'seen', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable(); // توضیح مدیر
    
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
        Schema::dropIfExists('program_requests');
    }
};
