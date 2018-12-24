<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_form_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('form_key');
            $table->string('data_key');
            $table->text('data');
            $table->string('remote_address');
            $table->boolean('is_deleted')->default(0);
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
        Schema::table('user_form_responses', function (Blueprint $table) {
            //
        });
    }
}
