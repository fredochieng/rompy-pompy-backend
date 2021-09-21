<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubsciptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sub_no');
            $table->unsignedBigInteger('s_model_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('sub_pkg_id');
            $table->string('sub_trans_code');
            $table->double('sub_amount', 10, 2);
            $table->double('paid_amount', 10, 2);
            $table->double('balance', 10, 2);
            $table->string('sub_start_date');
            $table->string('sub_duration');
            $table->string('sub_end_date');
            $table->unsignedBigInteger('sub_status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('s_model_id')
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
        Schema::dropIfExists('subscriptions');
    }
}
