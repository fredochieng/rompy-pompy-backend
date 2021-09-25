<?php

namespace App\Api\Controllers;

use App\Api\Models\ModelsApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class ModelsApiController extends Controller
{

    /** Get all VIP models */
    public function get_vip_models()
    {
        $vip_models = ModelsApi::GetModels()->where('sub_pkg_id', '=', 1)->all();

        return response()->json([
            'model' => $vip_models
        ], 200);

    //     return Response::json([
    //         'model' => $vip_models
    //    ], 200);
    }

    /** Get all VIP models - city_id filter */
    public function get_city_vip_models(Request $request)
    {
        $city_id = $request->city_id;
        $city_vip_models = ModelsApi::GetModels()->where('sub_pkg_id', 1)->where('c_city_id', $city_id);

        if(count($city_vip_models) > 0){
            return response()->json([
                'model' => $city_vip_models, 'status' => 201,
                'success' => 'City models details retrieved',
            ]);
        }else{
            $message = array("message" => "No models found", "status" => 400);
            return response()->json($message, 400);
        }
    }

    /** Get all regular models */
    public function get_regular_models()
    {

        $regular_models = ModelsApi::GetModels()->where('sub_pkg_id', 2);

        return response()->json([
            'model' => $regular_models, 'status' => 201,
            'success' => 'Model details retrieved',
        ]);
    }

    /** Get all regular models - city_id filter */
    public function get_city_regular_models(Request $request)
    {
        $city_id = $request->city_id;
        $city_regular_models = ModelsApi::GetModels()->where('sub_pkg_id', 2)->where('c_city_id', $city_id);

        if(count($city_regular_models) > 0){
            return response()->json([
                'model' => $city_regular_models, 'status' => 201,
                'success' => 'Regular models details retrieved',
            ]);
        }else{
            $message = array("message" => "No models found", "status" => 400);
            return response()->json($message, 400);
        }
    }
}
