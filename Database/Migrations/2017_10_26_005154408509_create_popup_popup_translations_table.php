<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopupPopupTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup__popup_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your translatable fields
            $table->string('title')->nullable();
            $table->string('content')->nullable();

            $table->integer('popup_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['popup_id', 'locale']);
            $table->foreign('popup_id')->references('id')->on('popup__popups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('popup__popup_translations', function (Blueprint $table) {
            $table->dropForeign(['popup_id']);
        });
        Schema::dropIfExists('popup__popup_translations');
    }
}
