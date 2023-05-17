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
        Schema::create('check_lists', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->unsignedBigInteger('specification_id');
            $table->timestamps();
            $table->foreign('specification_id')->references('id')->on('specifications')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('system_id');
            $table->unsignedBigInteger('shift_id');
            $table->timestamps();

            $table->foreign('system_id')->references('id')->on('systems')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_lists');
        Schema::dropIfExists('tasks');
    }
};
