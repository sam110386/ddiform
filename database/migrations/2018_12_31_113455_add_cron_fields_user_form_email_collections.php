<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCronFieldsUserFormEmailCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_form_email_collections', function (Blueprint $table) {
            $table->boolean('cron')->default(0)->after('email');
            $table->boolean('status')->default(0)->after('cron');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_form_email_collections', function (Blueprint $table) {
            //
        });
    }
}
