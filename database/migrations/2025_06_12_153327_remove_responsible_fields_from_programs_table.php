<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveResponsibleFieldsFromProgramsTable extends Migration
{
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            // ابتدا حذف foreign keys اگر وجود دارند
            $table->dropForeign(['leader_id']);
            $table->dropForeign(['assistant_leader_id']);
            $table->dropForeign(['technical_manager_id']);
            $table->dropForeign(['support_id']);
            $table->dropForeign(['guide_id']);

            // سپس حذف ستون‌ها
            $table->dropColumn([
                'leader_id',
                'assistant_leader_id',
                'technical_manager_id',
                'support_id',
                'guide_id',
                'leader_name',
                'assistant_leader_name',
                'technical_manager_name',
                'support_name',
                'guide_name',
            ]);
        });
    }

    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            // بازگرداندن ستون‌ها در صورت نیاز
            $table->unsignedBigInteger('leader_id')->nullable();
            $table->unsignedBigInteger('assistant_leader_id')->nullable();
            $table->unsignedBigInteger('technical_manager_id')->nullable();
            $table->unsignedBigInteger('support_id')->nullable();
            $table->unsignedBigInteger('guide_id')->nullable();

            $table->string('leader_name')->nullable();
            $table->string('assistant_leader_name')->nullable();
            $table->string('technical_manager_name')->nullable();
            $table->string('support_name')->nullable();
            $table->string('guide_name')->nullable();

            // روابط کلید خارجی
            $table->foreign('leader_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assistant_leader_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('technical_manager_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('support_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('guide_id')->references('id')->on('users')->onDelete('set null');
        });
    }
}
