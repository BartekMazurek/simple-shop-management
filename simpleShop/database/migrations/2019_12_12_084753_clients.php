<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('modified_at')->useCurrent();

            $table->foreign('group_id')->references('id')->on('client_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
