<?php

namespace App\Http\Controllers;

use App\Models\Selector;
use Illuminate\Http\Request;
use DB;

class SelectorController extends Controller
{

    //Function to get the cities values based on the selected country
    public function GetCountryCities(Request $request)
    {
        $country_id = $request->country_id;

        $country_cities = Selector::GetCities()
            ->where('c_country_id', $country_id);
        return response()->json($country_cities);
    }

    //Function to get the ethnicities values based on the selected country
    public function GetCountryEthnicities(Request $request)
    {
        $country_id = $request->country_id;

        $country_ethnicities = Selector::GetEthnities()
            ->where('e_country_id', $country_id);
        return response()->json($country_ethnicities);
    }

    //Function to get the price for the selected sub pkg
    public function GetSubPkgAmount(Request $request)
    {
        $sub_pkg_id = $request->sub_pkg_id;

        $sub_pkg_amount = DB::table('sub_packages as sp')->select(
            'sp.sub_pkg_amount'
        )->where('id', $sub_pkg_id)
            ->first();

        return response()->json($sub_pkg_amount);
    }

      //Function to get the price for the selected sub pkg
      public function GetSubPkgEndDate(Request $request)
      {
          $sub_pkg_id = $request->sub_pkg_id;

          $sub_pkg_amount = DB::table('sub_packages as sp')->select(
              'sp.sub_pkg_amount'
          )->where('id', $sub_pkg_id)
              ->first();

          return response()->json($sub_pkg_amount);
      }
}
