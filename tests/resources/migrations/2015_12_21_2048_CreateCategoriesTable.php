<?php

use Illuminate\DataBase\Schema\Blueprint;

use Illuminate\DataBase\Migrations\Migration;

/**
* Migrations da categoria
*/
class CreateCategoriesTable
{
    public function up()
    {
        Schema::create('trezevel_categories', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('trezevel_categories');
    }
}
