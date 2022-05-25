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
        Schema::create('token_storage_credentials', function (Blueprint $table) {
            $table->id();
            $table->text('token');
            $table->unsignedInteger('storage_id');

            $table->foreign('storage_id')
                ->references('id')
                ->on('storages')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_storage_credentials');
    }
};
