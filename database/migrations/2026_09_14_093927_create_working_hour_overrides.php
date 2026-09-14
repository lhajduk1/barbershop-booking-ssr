<?php

declare(strict_types=1);

use App\Models\WorkingHour;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('working_hour_overrides', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(WorkingHour::class, 'working_hour_id')
                ->contrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('weekday')->default(0);
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_working')->default(true);

            $table->unique(['working_hour_id', 'date']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_hour_overrides');
    }
};
