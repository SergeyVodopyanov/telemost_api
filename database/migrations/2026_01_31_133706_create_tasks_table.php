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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['todo', 'in_progress', 'done'])->default('todo');;
            $table->enum('priority', ['low', 'medium', 'high', 'critical']);
            $table->dateTime('due_date');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('completed_at')->nullable();

            $table->foreignId('team_id')
                ->constrained('teams')
                ->onDelete('cascade');
            $table->foreignId('creator_id')
                ->constrained('users')
                ->onDelete('restrict');
            $table->foreignId('assignee_id')
                ->constrained('users')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
