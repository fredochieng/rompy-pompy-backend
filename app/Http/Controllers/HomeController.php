<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Models\Entities\Models;
use Modules\Subscriptions\Entities\SubPayments;
use Modules\Subscriptions\Entities\Subscription;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subscriptions = Subscription::where('id', '>', 0)->get();
        $total_sub_array = array();
        foreach ($subscriptions as $value) {
            $total_sub_array[] = $value->sub_amount;
        }

        /** Get total number of subscriptions */
        /** Active and inactive subscriptions */
        $data['active_subs'] = count($subscriptions->where('sub_status', 1));
        $data['inactive_subs'] = count($subscriptions->where('sub_status', 2));

        /** Get total subscriptiions amount */
        $data['total_sub_amount'] = number_format(json_encode(array_sum($total_sub_array)), 2, '.', ',');

        /** Get number of subscribers */
        $subs = Models::where('id', '>', 0)->get();
        $data['active_models'] = count($subs->where('status', 1));
        $data['inactive_models'] = count($subs->where('status', 2));

        /** Get the total of payments made
         */
        $sub_payments = SubPayments::where('id', '>', 0)->get();
        $data['total_no_payments'] = count($sub_payments);

        return view('home')->with($data);
    }
}
