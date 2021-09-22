<?php

namespace Modules\Subscriptions\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Modules\Models\Entities\Models;
use Modules\Subscriptions\Entities\SubPayments;
use Modules\Subscriptions\Entities\Subscription;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('subscriptions::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('subscriptions::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (is_numeric($request->s_model_id)) {

            $sub_pkg_id = $request->sub_pkg_id;
            $s_model_id = $request->s_model_id;
            $payment_method = $request->payment_method_id;
            $sub_amount = $request->sub_amount;
            $paid_amount = $request->paid_amount;
            $balance = $request->balance;
            $sub_start_date = $request->sub_start_date;
            $sub_duration = $request->sub_duration;
            $sub_end_date = $request->sub_end_date;
            $sub_trans_code = $request->sub_trans_code;


            DB::beginTransaction();
            try {
                /** Generate subscription number */
                $length = 8;
                $intMin = (10 ** $length) / 10; // 100...
                $intMax = (10 ** $length) - 1;  // 999...
                $sub_no = mt_rand($intMin, $intMax);

                /** Determine if the sub pkg amount is paid in full */
                /** Status 1 = active (sub amount paid in full) */
                /** Status 2 = inactive (sub amount paid in partial/nothing) */
                if ($balance == 0) {
                    $sub_pkg_status = 1;
                } else {
                    $sub_pkg_status = 2;
                }

                /** Save subscription details */
                $sub = new Subscription();
                $sub->sub_no = $sub_no;
                $sub->s_model_id = $s_model_id;
                $sub->payment_method_id = $payment_method;
                $sub->sub_pkg_id = $sub_pkg_id;
                $sub->sub_trans_code = $sub_trans_code;
                $sub->sub_amount = $sub_amount;
                $sub->paid_amount = $paid_amount;
                $sub->balance = $balance;
                $sub->sub_start_date = $sub_start_date;
                $sub->sub_duration = $sub_duration;
                $sub->sub_end_date = $sub_end_date;
                $sub->sub_status = $sub_pkg_status;

                $sub->save();

                $saved_sub_id = $sub->id;

                /** Insert payment in payments table */

                /** Generate subscription number */
                $length = 8;
                $intMin = (10 ** $length) / 10; // 100...
                $intMax = (10 ** $length) - 1;  // 999...
                $sp_trans_no = mt_rand($intMin, $intMax);

                $subpay = new SubPayments();
                $subpay->sp_sub_id = $saved_sub_id;
                $subpay->sp_payment_method_id = $payment_method;
                $subpay->sp_tran_no = $sp_trans_no;
                $subpay->sp_trans_code = $sub_trans_code;
                $subpay->sp_amount = $paid_amount;
                $subpay->sp_sub_start_date = $sub_start_date;
                $subpay->sp_sub_end_date = $sub_end_date;


                $subpay->save();

                DB::commit();

                toastr()->success('Subscription added successfully');
                return back();
            } catch (\Throwable $e) {

                DB::rollBack();
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                toastr()->error('Ooops!!! Try again');
                return back();
            }
        }
    }

    public function renew_sub(Request $request)
    {
        if (is_numeric($request->sub_id)) {
            $sub_id = $request->sub_id;
            $s_model_id = $request->s_model_id;
            $paid_amount = $request->paid_amount1;
            $sub_duration = $request->sub_duration1;
            $sub_end_date = $request->sub_end_date1;
            $sub_start_date = $request->sub_start_date1;
            $payment_method = $request->payment_method_id;
            $balance = $request->balance1;
            $sub_trans_code = strtoupper($request->sub_trans_code);


            DB::beginTransaction();
            try {
                /** Generate subscription number */
                $length = 8;
                $intMin = (10 ** $length) / 10; // 100...
                $intMax = (10 ** $length) - 1;  // 999...
                $sp_trans_no = mt_rand($intMin, $intMax);

                /** Since this is a renewal */
                if ($balance == 0) {
                    $sub_pkg_status = 1;
                } else {
                    $sub_pkg_status = 2;
                }

                /** Calculate new sub duration and paid anmount
                 * Take current duration then add to added duration
                 */
                $current_subsc = Subscription::where('id', $sub_id)->first();
                $current_sub_duration = $current_subsc->sub_duration;
                $current_paid_amount = $current_subsc->paid_amount;

                /** Update the sub with new sub end date */
                $sub_details = array(
                    'sub_status' => $sub_pkg_status,
                    'sub_end_date' => $sub_end_date,
                    'paid_amount' => $paid_amount + $current_paid_amount,
                    'sub_duration' => $sub_duration + $current_sub_duration
                );


                $sub_renew = Subscription::where('id', $sub_id)->update($sub_details);

                /** Insert payment in payments table */
                $subpay = new SubPayments();
                $subpay->sp_sub_id = $sub_id;
                $subpay->sp_payment_method_id = $payment_method;
                $subpay->sp_tran_no = $sp_trans_no;
                $subpay->sp_trans_code = $sub_trans_code;
                $subpay->sp_amount = $paid_amount;
                $subpay->sp_sub_start_date = $sub_start_date;
                $subpay->sp_sub_end_date = $sub_end_date;

                $subpay->save();

                /** Check if model status is inactive
                 * If yes, activate it
                 */
                $model_status = array(
                    'status' => 2
                );

                $update_sub = Models::where('m_model_id', $s_model_id)->update($model_status);


                DB::commit();

                toastr()->success('Subscription renewed successfully');
                return back();
            } catch (\Throwable $e) {

                DB::rollBack();
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                toastr()->error('Ooops!!! Try again');
                return back();
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('subscriptions::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('subscriptions::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
