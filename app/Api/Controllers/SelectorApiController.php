<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Selector;
use Illuminate\Http\Request;

class SelectorApiController extends Controller
{
    /** Get services */
    public function get_services_api(){
        $services = Selector::GetServices();

        return response()->json([
            'services' => $services, 'status' => 201
        ]);
    }

    /** Get availabilities api */
    public function get_availabilities_api(){
        $availabilities = Selector::GetAvailabilities();

        return response()->json([
            'availabilities' => $availabilities, 'status' => 201
        ]);
    }
}
