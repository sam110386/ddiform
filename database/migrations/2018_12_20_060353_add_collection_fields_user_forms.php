<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollectionFieldsUserForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_forms', function (Blueprint $table) {
            $table->boolean('email_collection')->default(0)->after('status');
            $table->boolean('name_collection')->default(0)->after('email_collection');
            $table->string('submit_text')->default('Submit')->after('name_collection');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_forms', function (Blueprint $table) {
            //
        });
    }
}
