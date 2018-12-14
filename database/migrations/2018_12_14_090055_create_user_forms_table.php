<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('form_key')->uniuqe();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('fields')->nullable();
            $table->string('columns_each_row')->default('col-md-12');
            $table->string('image')->nullable();
            $table->boolean('image_pos')->default(0);
            $table->boolean('hide')->default(1);
            $table->boolean('email')->default(1);
            $table->string('success_message')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('user_forms');
    }
}
