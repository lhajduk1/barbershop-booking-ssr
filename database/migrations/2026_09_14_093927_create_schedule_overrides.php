<?php

declare(strict_types=1);

use App\Models\Schedule;
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
        Schema::create('schedule_overrides', function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(Schedule::class, 'schedule_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_working')->default(true);

            $table->unique(['schedule_id', 'date']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_overrides');
    }
};
