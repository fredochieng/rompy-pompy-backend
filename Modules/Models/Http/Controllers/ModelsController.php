<?php

namespace Modules\Models\Http\Controllers;

use App\Models\Selector;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Modules\Models\Entities\Models;
use Modules\Subscriptions\Entities\Subscription;
use Modules\Subscriptions\Entities\SubPayments;
use Modules\Models\Entities\ModelServices;
use Modules\Models\Entities\ModelAvailability;

class ModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['models'] = Models::GetAllModels();
        //dd($data['models']);
        return view('models::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // if (!auth()->user()->can('model.register')) {
        //     abort(401, 'You are not allowed to access this page.');
        // }

        // if(!auth()->user()->hasPermissionTo('model.register', 'web')){
        //     abort(401, 'You are not allowed to access this page.');
        // }

        toastr()->success('User added successfully');
        $data['countries'] = Selector::GetCountries();
        $data['builds'] = Selector::GetBuilds();
        $data['services'] = Selector::GetServices();
        $data['availabilities'] = Selector::GetAvailabilities();

        return view('models::create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $name = ucwords($request->name);
        $email = $request->email;
        $phone_no = $request->phone_no;
        $real_phone_no = $request->real_phone_no;
        $gender = $request->gender;
        $dob = $request->dob;
        $age = Carbon::parse($dob)->diffInYears(Carbon::now());
        $country_id = $request->country_id;
        $city_id = $request->city_id;
        $ethnicity_id = $request->ethnicity_id;
        $build_id = $request->build_id;
        $service_id = $request->service_id;
        $availability_id = $request->availability_id;
        $about = $request->about;
        $password = Hash::make($request->password);

        /** Run validator for both email and phone number */
        $email_validator = Validator::make($request->all(), [
            'email' => ['unique:users'],
        ]);

        $phone_validator = Validator::make($request->all(), [
            'phone_no' => ['unique:models'],
        ]);

        if ($email_validator->fails() && !$phone_validator->fails()) {

            toastr()->success('Email already registered!');
            DB::rollBack();
            return back();
        } elseif (!$email_validator->fails() && $phone_validator->fails()) {
            toastr()->success('Phone already registered!');
            DB::rollBack();
            return back();
        } elseif ($email_validator->fails() && $phone_validator->fails()) {
            toastr()->success('Email and phone already registered!');
            DB::rollBack();
            return back();
        } else {

            /** Generate random password */
            $password = Models::GeneratePassword(8);

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make(12345678);

            DB::beginTransaction();
            try {

                 /** Process the image */
                 $file = $request->file('preview_image');
                 $file_name = Models::GeneratePassword(30).$file->getClientOriginalName();
                 $file->move('uploads/model_preview_images', $file_name);
                 $preview_image_url = 'uploads/model_preview_images/' . $file_name;

                $user->save();
                $saved_user_id = $user->id;

                $user_role_data = array(
                    'role_id' => 2,
                    'model_type' => 'App\User',
                    'model_id' => $saved_user_id
                );

                $save_user_role_data = DB::table('model_has_roles')->insert($user_role_data);

                $accessToken = $user->createToken('authToken')->accessToken;

                $success_response['token'] =  $user->createToken('authToken')->accessToken;
                $success_response['name'] =  $user->name;

                /** Generate model number */
                $length = 6;
                $intMin = (10 ** $length) / 10; // 100...
                $intMax = (10 ** $length) - 1;  // 999...

                $model_no = mt_rand($intMin, $intMax);

                /** Save model details */
                $model = new Models();
                $model->model_no = $model_no;
                $model->m_model_id = $saved_user_id;
                $model->phone_no = $phone_no;
                $model->real_phone_no = $real_phone_no;
                $model->gender = $gender;
                $model->age = $age;
                $model->country_id = $country_id;
                $model->city_id = $city_id;
                $model->ethnicity_id = $ethnicity_id;
                $model->build_id = $build_id;
                $model->services = 1;
                $model->availability = 1;
                $model->preview_image = $preview_image_url;
                $model->about = $about;

                $model->save();

                /** save model services in m_services table */
                $count = count($service_id);

                for ($i = 0; $i < $count; $i++) {
                    $data = array(
                        'ms_model_id' => $saved_user_id,
                        'ms_service_id' => $service_id[$i]
                    );

                    $insertServices[] = $data;
                }

                ModelServices::insert($insertServices);

                 /** save model availabilities in m_availability table */
                 $count = count($service_id);

                 for ($i = 0; $i < $count; $i++) {
                     $data1 = array(
                         'ma_model_id' => $saved_user_id,
                         'ma_availability_id' => $availability_id[$i]
                     );

                     $insertAvailability[] = $data1;
                 }

                 ModelAvailability::insert($insertAvailability);


                DB::commit();
                toastr()->success('User added successfully');
                return back();
            } catch (\Throwable $e) {

                DB::rollBack();
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                toastr()->error('Ooops!!! Try again');
                return back();
            }
        }
    }

    public function details(Request $request, $model_no)
    {
        // if (!auth()->user()->can('model.view-details')) {
        //     abort(401, 'You are not allowed to access this page.');
        // }

        if (is_numeric($model_no)) {

            $data['countries'] = Selector::GetCountries();
            $data['builds'] = Selector::GetBuilds();
            $data['services'] = Selector::GetServices();
            $data['availabilities'] = Selector::GetAvailabilities();
            $data['sub_pkgs'] = Selector::GetSubPkgs();
            $data['payment_methods'] = Selector::GetPaymentMethods();

            $data['model'] = Models::GetAllModels()->where('model_no', $model_no)->first();

            /** Get subscriptions of the model */
            $data['subs'] = Subscription::GetSubscriptions()->where('s_model_id', $data['model']->user_id);
            $data['subs1'] = Subscription::GetSubscriptions()->where('s_model_id', $data['model']->user_id)->first();
            $data['sub_payments'] = SubPayments::GetSubPayments()->where('s_model_id', $data['model']->user_id);
            $data['model_services'] = ModelServices::GetModelServices($data['model']->user_id);

           dd($data['model_services']);


            /** If model has an active/inactive subscription, no subscription shd be added again
             * Otherwise a renewal shd be done
             */
            if (count($data['subs']) > 0) {
                $data['sub_available'] = "Yes";
            } else {
                $data['sub_available'] = "No";
            }


            return view('models::details')->with($data);
        } else {
            abort(403, 'Invalid Request.');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('models::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('models::edit');
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
