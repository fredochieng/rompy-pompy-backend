<?php

namespace App\Api\Controllers;

use App\Api\Models\ModelsApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModelsApiController extends Controller
{

    public function get_vip_models()
    {

        $vip_models = ModelsApi::GetVIPModels()->where('sub_pkg_id', 1);

        return response()->json([
            'model' => $vip_models, 'status' => 201,
            'success' => 'Model details retrieved',
        ]);
    }

    public function get_regular_models()
    {

        $regular_models = ModelsApi::GetVIPModels()->where('sub_pkg_id', 2);

        return response()->json([
            'model' => $regular_models, 'status' => 201,
            'success' => 'Model details retrieved',
        ]);
    }
}
