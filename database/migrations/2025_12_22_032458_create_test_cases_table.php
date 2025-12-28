<?php

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
        Schema::create('test_cases', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')
                ->constrained('users');
            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users');

            $table->char('code', 10)->index();
            $table->string('module');
            $table->enum('priority', ['normal', 'medium', 'high']);
            $table->enum('status', ['open', 'in_course', 'closed', 'review', 'completed']);
            $table->dateTime('execution_at');
            $table->string('version', 25)->nullable();

            $table->string('title');
            $table->text('description');
            $table->text('predonditions');
            $table->text('steps_to_execute');
            $table->text('expected_result');
            $table->text('result');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_cases');
    }
};
