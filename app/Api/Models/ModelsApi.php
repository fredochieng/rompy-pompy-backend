<?php

namespace App\Api\Models;

use App\Http\Controllers\Controller;
use App\Models\Api\Models\ModelApi;
use Illuminate\Http\Request;
use DB;
use Modules\Models\Entities\ModelAvailability;
use Modules\Models\Entities\ModelServices;
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
    public static function GetModels()
    {
        $active_models = DB::table('models')->select(
            'models.*',
            'models.id as m_user_id',
            'u.id as user_id',
            'u.name',
            'u.email',
            'co.country_name',
            'ct.id as c_city_id',
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

     /** Get models for website - VIP */
     public static function GetVIPModels()
     {
         $VIP_models = DB::table('models')->select(
             'models.*',
             'models.id as m_user_id',
             'u.id as user_id',
             'u.name',
             'u.email',
             'co.country_name',
             'ct.id as c_city_id',
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
             ->where('sub_pkg_id', '=', 1)
             ->get();

         return $VIP_models;
     }

     /** Get models for website - Regular */
     public static function GetRegularModels()
     {
         $Reg_models = DB::table('models')->select(
             'models.*',
             'models.id as m_user_id',
             'u.id as user_id',
             'u.name',
             'u.email',
             'co.country_name',
             'ct.id as c_city_id',
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
             ->where('sub_pkg_id', '=', 2)
             ->get();

         return $Reg_models;
     }

     /** Get models for website - Regular */
     public static function GetVIPCityModels($city_id)
     {
         $vip_city_models = DB::table('models')->select(
             'models.*',
             'models.id as m_user_id',
             'u.id as user_id',
             'u.name',
             'u.email',
             'co.country_name',
             'ct.id as c_city_id',
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
             ->where('sub_pkg_id', '=', 1)
             ->where('sub_pkg_id', 1)->where('ct.id', $city_id)
             ->get();

         return $vip_city_models;
     }


    /** Get model subscriptions */
    public static function GetModelSubs()
    {
        $sub_pkgs = Subscription::select(
            'subscriptions.*',
            'subscriptions.id as sub_id',
            'u.id as user_id',
            'm.model_no',
            'pm.payment_method',
            'sb.sub_pkg_code',
            'sb.sub_pkg_name',
            'sb.sub_pkg_amount'
        )
            ->leftJoin('users as u', 'subscriptions.s_model_id', 'u.id')
            ->leftJoin('models as m', 'u.id', 'm.m_model_id')
            ->leftJoin('payment_methods as pm', 'subscriptions.payment_method_id', 'pm.id')
            ->leftJoin('sub_packages as sb', 'subscriptions.sub_pkg_id', 'sb.id')
            ->get();

        return $sub_pkgs;
    }

    /** Get model services for the API */
    public static function GetModelServicesApi($ms_model_no)
    {
        $model_services = ModelServices::select(
            'model_services.*',
            'm.model_no',
            's.service'
        )
            ->leftJoin('models as m', 'model_services.ms_model_id', 'm.m_model_id')
            ->leftJoin('services as s', 'model_services.ms_service_id', 's.id')
            ->where('m.model_no', $ms_model_no)
            ->get();

        return $model_services;
    }

     /** Get services a model can add */
    //  public static function GetModelAvailableServicesApi($ms_model_no)
    //  {
    //      $model_services = ModelServices::select(
    //          'model_services.*',
    //          'm.model_no',
    //          's.service'
    //      )
    //          ->leftJoin('models as m', 'model_services.ms_model_id', 'm.m_model_id')
    //          ->leftJoin('services as s', 'model_services.ms_service_id', 's.id')
    //          ->where('m.model_no', $ms_model_no)
    //          ->get();

    //      return $model_services;
    //  }

    /** Get model ava for the API */
    public static function GetModelAvailabilityApi($model_no)
    {

        $model_availabilities = ModelAvailability::select(
            'model_availabilities.*',
            'm.model_no',
            'a.availability'
        )
            ->leftJoin('models as m', 'model_availabilities.ma_model_id', 'm.m_model_id')
            ->leftJoin('availability as a', 'model_availabilities.ma_availability_id', 'a.id')
            ->where('m.model_no', $model_no)
            ->get();

        return $model_availabilities;
    }

    /** Get model pictures */
    public static function GetModelPictures($model_id){
        $model_pics = DB::table('model_pictures')->select(
            DB::raw('model_pictures.mp_model_id'),
            DB::raw('model_pictures.model_pic_url')
        )->where('model_pictures.mp_model_id', $model_id)
        ->get();

        return $model_pics;
    }
}
