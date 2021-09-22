<?php

namespace App\Api\Models;

use App\Http\Controllers\Controller;
use App\Models\Api\Models\ModelApi;
use Illuminate\Http\Request;
use DB;
use Modules\Subscriptions\Entities\Subscription;

class ModelsApi extends Controller
{
    protected $table = 'models';

    /** Get model for profile */
    public static function GetModel()
    {
        $models = DB::table('models')->select(
            'models.*',
            'u.id as user_id',
            'u.name',
            'u.email',
            'co.country_name',
            'ct.city_name',
            'et.ethnicity',
            'bl.build'
        )
            ->leftJoin('users as u', 'models.m_model_id', 'u.id')
            ->leftJoin('countries as co', 'models.country_id', 'co.id')
            ->leftJoin('cities as ct', 'models.city_id', 'ct.id')
            ->leftJoin('ethnicities as et', 'models.ethnicity_id', 'et.id')
            ->leftJoin('build as bl', 'models.build_id', 'bl.id')
            ->get();

        return $models;
    }

        /** Get models for website - VIP */
        public static function GetVIPModels()
        {
            $active_models = DB::table('models')->select(
                'models.*',
                'models.id as m_user_id',
                'u.id as user_id',
                'u.name',
                'u.email',
                'co.country_name',
                'ct.city_name',
                'et.ethnicity',
                'bl.build',
                'sb.sub_pkg_id',
                'sb.sub_amount',
                'sb.sub_start_date',
                'sb.sub_end_date',
                'sb.sub_status'
            )
                ->leftJoin('users as u', 'models.m_model_id', 'u.id')
                ->leftJoin('countries as co', 'models.country_id', 'co.id')
                ->leftJoin('cities as ct', 'models.city_id', 'ct.id')
                ->leftJoin('ethnicities as et', 'models.ethnicity_id', 'et.id')
                ->leftJoin('build as bl', 'models.build_id', 'bl.id')
                ->leftJoin('subscriptions as sb', 'models.m_model_id', 'sb.s_model_id')
                ->inRandomOrder()
                ->where('sb.sub_status', 1)
                ->get();

            return $active_models;
        }


    /** Get model subscriptions */
    public static function GetModelSubs(){
        $sub_pkgs = Subscription::select(
            'subscriptions.*',
            'subscriptions.id as sub_id',
            'u.id as user_id',
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
