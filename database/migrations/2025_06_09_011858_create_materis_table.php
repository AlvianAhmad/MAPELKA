<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterisTable extends Migration
{
    public function up()
{
    Schema::create('materis', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('thumbnail')->nullable();
        $table->string('file')->nullable();
        $table->string('video_file')->nullable();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('materis');
    }
}
