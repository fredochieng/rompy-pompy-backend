<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Selector extends Model
{
    use HasFactory;

    /** Get list of all countries */
    public static function GetCountries(){
        $countries = DB::table('countries as co')->select(
            'co.id as country_id', 'co.country_name'
        )
            ->orderBy('co.id', 'asc')
            ->get();

        return $countries;
    }

    /** Get list of cities of selected country */
    public static function GetCities()
    {
        $cities = DB::table('cities as ct')->select(
            'ct.id as c_city_id','ct.c_country_id','ct.city_name'
        )
            ->orderBy('ct.id', 'asc')
            ->get();

        return $cities;
    }

     /** Get list of ethnicities */
     public static function GetEthnities()
     {
         $ethnicities = DB::table('ethnicities as et')->select(
             'et.id as ethnicity_id','et.e_country_id','et.ethnicity'
         )
             ->orderBy('et.id', 'asc')
             ->get();

         return $ethnicities;
     }

      /** Get list of builds */
      public static function GetBuilds()
      {
          $builds = DB::table('build as bl')->select(
              'bl.id as build_id','bl.build'
          )
              ->orderBy('bl.id', 'asc')
              ->get();

          return $builds;
      }

        /** Get list of services */
        public static function GetServices()
        {
            $services = DB::table('services as ss')->select(
                'ss.id as service_id','ss.service'
            )
                ->orderBy('ss.id', 'asc')
                ->get();

            return $services;
        }

         /** Get list of availability options */
         public static function GetAvailabilities()
         {
             $avalabilities = DB::table('availability as av')->select(
                 'av.id as availability_id','av.availability'
             )
                 ->orderBy('av.id', 'asc')
                 ->get();

             return $avalabilities;
         }


         /** Get list of payment methods */
         public static function GetPaymentMethods()
         {
             $payment_methods = DB::table('payment_methods as pm')->select(
                 'pm.id as payment_method_id','pm.payment_method'
             )
                 ->orderBy('pm.id', 'asc')
                 ->get();

             return $payment_methods;
         }

          /** Get list of sub pkgs */
          public static function GetSubPkgs()
          {
              $sub_pkgs = DB::table('sub_packages as sb')->select(
                  'sb.id as sub_pkg_id','sb.sub_pkg_code', 'sb.sub_pkg_name','sb.sub_pkg_amount',
                  'sb.created_at as sub_pkg_created_at'
              )
                  ->orderBy('sb.id', 'asc')
                  ->get();

              return $sub_pkgs;
          }

}
