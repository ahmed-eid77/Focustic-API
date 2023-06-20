<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatesToUsersTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bio')->nullable()->after('email');
            $table->string('position')->nullable()->after('email');
            $table->string('linkedIn_url')->nullable()->after('email');
            $table->string('profile_picture')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bio');
            $table->dropColumn('position');
            $table->dropColumn('linkedIn_url');
            $table->dropColumn('profile_picture');
        });
    }
}
