<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('sub_payments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('sp_sub_id');
                $table->double('sp_amount');
                $table->unsignedBigInteger('sp_payment_method_id');
                $table->string('sp_tran_no');
                $table->string('sp_trans_code');
                $table->string('sp_sub_start_date');
                $table->string('sp_sub_end_date');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_payments');
    }
}
