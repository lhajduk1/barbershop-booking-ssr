<?php

declare(strict_types=1);

use App\Models\Employee;
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
        Schema::create('working_hours', function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(Employee::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('weekday')->default(1);
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
