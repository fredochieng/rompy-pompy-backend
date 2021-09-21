<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEthnicitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ethnicities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('e_country_id');
            $table->string('ethnicity');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('e_country_id')
                ->references('id')
                ->on('countries')
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
        Schema::dropIfExists('ethnicities');
    }
}
