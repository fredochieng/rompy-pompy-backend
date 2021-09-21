<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('m_model_id');
            $table->unsignedBigInteger('status')->default(1);
            $table->string('phone_no');
            $table->string('real_phone_no');
            $table->string('gender');
            $table->unsignedBigInteger('age');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('ethnicity_id');
            $table->unsignedBigInteger('build_id');
            $table->string('services');
            $table->string('availability');
            $table->longText('about');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('m_model_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('models');
    }
}
