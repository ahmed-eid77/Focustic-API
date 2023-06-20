<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MySessionTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_session_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('task_id');

            $table->foreign('session_id')
                ->references('id')
                ->on('my_sessions')
                ->onDelete('cascade');

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_session_tasks');
    }
}
