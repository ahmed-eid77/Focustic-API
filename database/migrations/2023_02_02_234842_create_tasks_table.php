<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Timer\Duration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('note');
            $table->enum('duration', [30, 45, 90]);
            $table->enum('state', ['active', 'completed'])->default('active');
            $table->boolean('reminder')->default(false);
            $table->dateTime('reminder_date');
            $table->dateTime('initiated_at');
            $table->dateTime('due_date');
            $table->enum('kind', ['daily', 'weekly', 'monthly']);
            $table->boolean('repeat')->default(false);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
