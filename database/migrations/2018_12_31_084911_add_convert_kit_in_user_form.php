<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConvertKitInUserForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_forms', function (Blueprint $table) {
            $table->boolean('convert_kit_opt')->default(0)->after('email_collection_title');
            $table->string('convert_kit_form_id')->nullable()->after('convert_kit_opt');
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
