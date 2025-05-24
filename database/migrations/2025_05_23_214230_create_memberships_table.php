<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['membership', 'course', 'program']);
            $table->unsignedBigInteger('related_id')->nullable(); // ID دوره یا برنامه
            $table->integer('year')->nullable(); // برای حق عضویت
            $table->string('transaction_code');
            $table->string('receipt_file')->nullable();
            $table->boolean('approved')->default(false); // توسط ادمین تأیید شده؟

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('memberships');
    }
}
