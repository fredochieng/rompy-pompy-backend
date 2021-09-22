@extends('adminlte::page')

@section('title', 'Model Details | Rompy Pompy')

@section('content_header')
    <h1>Rompy Pompy | Model No: #{{$model->model_no}}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
      <div class="card card-info card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="/{{$model->preview_image}}"
                 alt="User Picture">
          </div>

          <h3 class="profile-username text-center">{{$model->name}}</h3>

          <p class="text-muted text-center">Model ID: #{{$model->model_no}}</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Email</b> <h6 class="float-right">{{$model->email}}</h6>
            </li>
            <li class="list-group-item">
              <b>Phone No</b> <h6 class="float-right">{{$model->phone_no}}</h6>
            </li>
            <li class="list-group-item">
                <b>Real Phone No</b> <h6 class="float-right">{{$model->real_phone_no}}</h6>
              </li>
              <li class="list-group-item">
                <b>Gender</b> <h6 class="float-right">{{$model->gender}}</h6>
              </li>
              <li class="list-group-item">
                <b>Age</b> <h6 class="float-right">{{$model->age}} Years</h6>
              </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
<div class="col-md-6">
          <!-- About Me Box -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">About</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i> Services</strong>
              <p class="text-muted">
              @foreach ($model_services as $model_service)
              {{ $model_service->service }},
              @endforeach
              </p>
              <hr>
              <strong><i class="fas fa-book mr-1"></i> Availability</strong>
              <p class="text-muted">
              @foreach ($model_availabilities as $model_availability)
              {{ $model_availability->availability }},
              @endforeach
              </p>
              <hr>

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location & Ethnicity</strong>
              <p class="text-muted">{{$model->city_name}}, {{$model->country_name}}</p>
              <p class="text-muted">Ethinicity: {{$model->ethnicity}}</p>
              <hr>
              <strong><i class="far fa-file-alt mr-1"></i> About Model</strong>

              <p class="text-muted">{{$model->about}}</p>
            </div>
            <!-- /.card-body -->
          </div>
</div>
  </div>
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Subscriptions</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"></a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"></a></li>
              @if ($sub_available == "No")
              <button type="button" data-toggle="modal" data-target="#ModalAddSubscription_{{$model->user_id}}" class="btn btn-info"><i class="fas fa-solid fa-plus"></i> Add Subscription</button>
              @else
              <button type="button" data-toggle="modal" data-target="#ModalRenewSubscription_{{$model->user_id}}" class="btn btn-info"><i class="fas fa-solid fa-sync-alt"></i> Renew Subscription</button>
              @endif
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"></a></li>
              <li class="nav-item"><a class="nav-link" href="#payments" data-toggle="tab"><i class="fas fa-money-check-alt"></i> Payments</a></li>
            </ul>

          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                  <table id="example1" class="table table-striped table-bordered" style="font-size: 11px">
                      <thead>
                          <!-- start row -->
                          <tr>
                              <th>Sub No</th>
                              <th>Sub Package</th>
                              <th>Sub Amount</th>
                              <th>Amount Paid</th>
                              <th>Balance</th>
                              <th>Payment Method</th>
                              <th>Sub Start Date</th>
                              <th>Sub Duration</th>
                              <th>Sub End Date</th>
                          </tr> <!-- end row -->
                      </thead>
                      <tbody>
                          @foreach ($subs as $sub)
                      <tr>
                          <td>{{ $sub->sub_no }}</td>
                          <td>{{ $sub->sub_pkg_name }}</td>
                          <td>{{ $sub->sub_amount }}</td>
                          <td>{{ $sub->paid_amount }}</td>
                          <td>{{ $sub->balance }}</td>
                          <td>{{ $sub->payment_method }}</td>
                          <td>{{ $sub->sub_start_date }}</td>
                          <td>{{ $sub->sub_duration }}</td>
                          <td>{{ $sub->sub_end_date }}</td>
                      </tr>
                       @endforeach
                      </tbody>
                  </table>
              </div>
              <div class="tab-pane" id="payments">
                <table id="example1" class="table table-striped table-bordered" style="font-size: 11px">
                    <thead>
                        <!-- start row -->
                        <tr>
                            <th>Trans No</th>
                            <th>Sub Package</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Transaction Code</th>
                            <th>Pay Start Date</th>
                            <th>Pay End Date</th>
                            <th>Created At</th>
                        </tr> <!-- end row -->
                    </thead>
                    <tbody>
                        @foreach ($sub_payments as $sub_payment)
                    <tr>
                        <td>{{ $sub_payment->sp_tran_no }}</td>
                        <td>{{ $sub_payment->sub_pkg_name }}</td>
                        <td>{{ $sub_payment->sp_amount }}</td>
                        <td>{{ $sub_payment->payment_method }}</td>
                        <td>{{ $sub_payment->sp_trans_code }}</td>
                        <td>{{ $sub_payment->sp_sub_start_date }}</td>
                        <td>{{ $sub_payment->sp_sub_end_date }}</td>
                        <td>{{ $sub_payment->created_at }}</td>
                    </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
  </div>

  @if ($sub_available == "No")
  @include('models::modals.ModalAddSubscription')
  @else
  @include('models::modals.ModalRenewSubscription')
  @endif
@stop

@section('css')

@stop

@section('js')
<script src="/vendor/adminlte/inputmask/jquery.inputmask.min.js"></script>
<script src="/custom/js/selectors.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      //$('.select2').select2()
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()
    })
</script>
@stop
