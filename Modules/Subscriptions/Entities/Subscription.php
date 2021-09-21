<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [];
    protected $table = 'subscriptions';

    /** Get subscriptions */
    public static function GetSubscriptions(){

        $sub_pkgs = Subscription::select(
            'subscriptions.*',
            'subscriptions.id as sub_id',
            'u.id as user_id',
            'u.name',
            'u.email',
            'pm.payment_method',
            'sb.sub_pkg_code',
            'sb.sub_pkg_name',
            'sb.sub_pkg_amount'
        )
            ->leftJoin('users as u', 'subscriptions.s_model_id', 'u.id')
            ->leftJoin('payment_methods as pm', 'subscriptions.payment_method_id', 'pm.id')
            ->leftJoin('sub_packages as sb', 'subscriptions.sub_pkg_id', 'sb.id')
            ->get();

        return $sub_pkgs;
    }
}
