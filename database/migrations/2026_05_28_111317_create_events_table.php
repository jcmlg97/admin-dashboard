<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();

            $table->string('location')->nullable();

            $table->string('type')->default('general'); 

            $table->string('status')->default('active');
            // active, cancelled, finished

            $table->string('color')->nullable();
            // para FullCalendar

            $table->boolean('all_day')->default(false);

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};