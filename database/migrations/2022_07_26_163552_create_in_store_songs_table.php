<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_store_songs', function (Blueprint $table) {
            $table->id();
            $table->text('artist');
            $table->text('title');
            $table->text('featuring')->nullable();
            $table->text('genre');
            $table->text('year');
            $table->string('cover');
            $table->string('song');
            $table->double('price');
            $table->foreignId('uploaded_by')->constrained('users');
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
        Schema::dropIfExists('in_store_songs');
    }
};
