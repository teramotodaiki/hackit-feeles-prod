<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->boolean('is_admin')->nullable();
            $table->string('userid')->unique();
            $table->boolean('is_male')->nullable();
            $table->date('birthday')->nullable();
            $table->string('thumbnail')->nullable();
            $table->softDeletes();

            $table->dropUnique(['email']);
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table)
        {
            // $table->dropUnique(['userid']);
            $table->dropColumn([
                'is_admin',
                'userid',
                'is_male',
                'birthday',
                'thumbnail',
                'deleted_at'
            ]);
        });
    }
}
