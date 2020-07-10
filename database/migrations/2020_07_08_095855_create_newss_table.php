<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newss', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('newscats')->onDelete('cascade');
            $table->string('title', 255);
            $table->char('re_name', 255);
            $table->char('image', 255)->nullable();
            $table->text('brief')->nullable();
            $table->longText('content')->nullable();
            $table->tinyInteger('isactive');
            $table->bigInteger('priority');
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
        Schema::dropIfExists('newss');
    }
}
