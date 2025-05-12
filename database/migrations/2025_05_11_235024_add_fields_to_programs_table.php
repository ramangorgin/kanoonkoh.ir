<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            // برنامه رایگان است؟
            $table->boolean('is_free')->default(false)->after('status');

            // آیا حمل‌ونقل گروهی دارد؟
            $table->boolean('has_transport')->default(true)->after('is_free');

            // حداکثر ظرفیت شرکت‌کننده
            $table->unsignedInteger('max_participants')->nullable()->after('capacity');

            // توضیح برای سختی
            $table->text('difficulty_description')->nullable()->after('difficulty_level');

            // یادداشت زمان حرکت
            $table->string('meeting_time_note')->nullable()->after('departure_time_tehran');

            // هشدار یا اطلاعیه مهم
            $table->text('important_alert')->nullable()->after('notes_for_participants');

            // توضیح تکمیلی برای ثبت‌نام
            $table->text('registration_notes')->nullable()->after('important_alert');

            // شماره تماس اضطراری
            $table->string('contact_phone')->nullable()->after('registration_notes');
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'is_free',
                'has_transport',
                'max_participants',
                'difficulty_description',
                'meeting_time_note',
                'important_alert',
                'registration_notes',
                'contact_phone',
            ]);
        });
    }
};
