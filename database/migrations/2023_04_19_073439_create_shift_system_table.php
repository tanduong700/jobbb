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
        Schema::create('shift_system', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_id');
            $table->foreignId('shift_id');
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
        Schema::dropIfExists('shift_system');
    }
};
