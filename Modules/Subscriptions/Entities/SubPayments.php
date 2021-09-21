<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Model;

class SubPayments extends Model
{
    protected $fillable = [];

    protected $table = 'sub_payments';

    /** Get the payments */
    public static function GetSubPayments(){

        $sub_pkgs_payments = SubPayments::select(
            'sub_payments.*',
            'sub_payments.id as sub_pay_id',
            'pm.payment_method',
            'sb.sub_pkg_code',
            'sb.sub_pkg_name',
            'sub.s_model_id'
        )
        
            ->leftJoin('subscriptions as sub', 'sub_payments.sp_sub_id', 'sub.id')
            ->leftJoin('payment_methods as pm', 'sub_payments.sp_payment_method_id', 'pm.id')
            ->leftJoin('sub_packages as sb', 'sub.sub_pkg_id', 'sb.id')
            ->get();

        return $sub_pkgs_payments;
    }
}
