<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_availabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ma_model_id');
            $table->unsignedBigInteger('ma_availability_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('ma_model_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

                $table->foreign('ma_availability_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_availabilities');
    }
}
