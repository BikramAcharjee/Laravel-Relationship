<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name")->nullable();
            $table->string("image_path")->nullable();
            $table->string("slug")->nullable();
            $table->string("child")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('super_categories');
    }
}
