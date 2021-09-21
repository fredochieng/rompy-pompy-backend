<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ms_model_id');
            $table->unsignedBigInteger('ms_service_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('ms_model_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

                $table->foreign('ms_service_id')
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
        Schema::dropIfExists('model_services');
    }
}
