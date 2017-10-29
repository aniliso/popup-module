<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopupPopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup__popups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your fields
            $table->enum('design_type', ['image', 'text', 'html', 'video', 'social', 'iframe'])->default('image');
            $table->text('design_desc')->nullable();
            $table->text('settings')->nullable();

            $table->date('start_at')->default('0000-00-00');
            $table->date('end_at')->default('0000-00-00');
            $table->time('start_hour')->default('00:00:00');
            $table->time('end_hour')->default('00:00:00');

            $table->string('template')->nullable();

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
        Schema::dropIfExists('popup__popups');
    }
}
