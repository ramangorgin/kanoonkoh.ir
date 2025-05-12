<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            // از فیلدهای موجود رد می‌شیم: title, region, date (=> execution_date), leader

            $table->string('slug')->unique()->nullable()->after('title');
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();

            $table->enum('type', [
                'کوهنوردی سنگین', 'کوهنوردی متوسط', 'کوهنوردی سبک',
                'طبیعت‌گردی', 'برنامه فرهنگی', 'سنگ نوردی'
            ])->nullable();

            $table->enum('difficulty_level', ['آسان', 'متوسط', 'سخت'])->nullable();
            $table->unsignedInteger('peak_altitude')->nullable();
            $table->string('start_location')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->boolean('is_registration_open')->default(true);
            $table->unsignedInteger('view_count')->default(0);

            $table->dateTime('registration_deadline')->nullable();

            // حرکت از تهران
            $table->date('departure_date_tehran')->nullable();
            $table->time('departure_time_tehran')->nullable();
            $table->string('departure_place_tehran')->nullable();
            $table->decimal('departure_lat_tehran', 10, 7)->nullable();
            $table->decimal('departure_lon_tehran', 10, 7)->nullable();

            // حرکت از کرج
            $table->date('departure_date_karaj')->nullable();
            $table->time('departure_time_karaj')->nullable();
            $table->string('departure_place_karaj')->nullable();
            $table->decimal('departure_lat_karaj', 10, 7)->nullable();
            $table->decimal('departure_lon_karaj', 10, 7)->nullable();

            // مسئولین دیگر (leader موجوده)
            $table->foreignId('assistant_leader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('technical_manager_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('support_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('guide_id')->nullable()->constrained('users')->nullOnDelete();

            // هزینه‌ها
            $table->unsignedInteger('member_cost')->nullable();
            $table->unsignedInteger('guest_cost')->nullable();

            // اطلاعات مورد نیاز
            $table->text('required_equipment')->nullable();
            $table->text('required_meals')->nullable();
            $table->text('notes_for_participants')->nullable();
            $table->boolean('has_insurance_required')->default(false);

            // وضعیت
            $table->enum('status', ['پیش‌رو', 'برگزار شده', 'لغو شده'])->default('پیش‌رو');

            // اطلاعات مالی
            $table->string('card_number')->nullable();
            $table->string('sheba_number')->nullable();
            $table->string('card_holder')->nullable();
            $table->string('bank_name')->nullable();

            // گزارش
            $table->text('report_summary')->nullable();
            $table->json('report_photos')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'description', 'cover_image', 'type', 'difficulty_level',
                'peak_altitude', 'start_location', 'capacity', 'is_registration_open', 'view_count',
                'registration_deadline',
                'departure_date_tehran', 'departure_time_tehran', 'departure_place_tehran',
                'departure_lat_tehran', 'departure_lon_tehran',
                'departure_date_karaj', 'departure_time_karaj', 'departure_place_karaj',
                'departure_lat_karaj', 'departure_lon_karaj',
                'assistant_leader_id', 'technical_manager_id', 'support_id', 'guide_id',
                'member_cost', 'guest_cost', 'required_equipment', 'required_meals',
                'notes_for_participants', 'has_insurance_required', 'status',
                'card_number', 'sheba_number', 'card_holder', 'bank_name',
                'report_summary', 'report_photos'
            ]);
        });
    }
};
