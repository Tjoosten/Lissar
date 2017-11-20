<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id'); 
            $table->integer('category_id')->nullable();
            $table->integer('assignee_id')->nullable(); 
            $table->integer('priority_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('subject');
            $table->text('description');
            $table->string('closed');
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
        Schema::dropIfExists('tickets');
    }
}
