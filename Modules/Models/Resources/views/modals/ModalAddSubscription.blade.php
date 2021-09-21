<div class="modal fade" id="ModalAddSubscription_{{$model->user_id}}">
    <div class="modal-dialog modal-xl">
        <form class="" method="POST"
        action="{{ route('subscription.save') }}" role="form" autocomplete="off" enctype='multipart/form-data'>
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Subscription - #{{$model->model_no}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="card-body">
                <div class="row">
                    <input type="hidden" name="s_model_id" value="{{$model->user_id}}">
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Package</label>
                          <select class="form-control select2" name="sub_pkg_id" id="sub_pkg_id" required>
                              <option value="">Select subscription package</option>
                              @foreach ($sub_pkgs as $sub_pkg)
                              <option value="{{ $sub_pkg->sub_pkg_id }}">{{ $sub_pkg->sub_pkg_name }}
                              </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Payment Method</label>
                          <select class="form-control select2" name="payment_method_id" id="payment_method_id" required>
                              <option value="">Select payment method</option>
                              @foreach ($payment_methods as $payment_method)
                              <option value="{{ $payment_method->payment_method_id }}">{{ $payment_method->payment_method }}
                              </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Sub Pkg Amount</label>
                        {{Form::number('sub_amount','',['class'=>'form-control', 'id' => 'sub_amount', 'readonly','required'])}}
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Duration (Months)</label>
                          {{Form::number('sub_duration','',['class'=>'form-control', 'min' => '1', 'required', 'id' => 'sub_duration', 'placeholder' => 'Enter subscription duration'])}}
                        </div>
                      </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Payment Amount</label>
                        {{Form::number('paid_amount','',['class'=>'form-control', 'readonly', 'required', 'id' => 'paid_amount','placeholder' => 'Enter payment amount'])}}
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label>Balance</label>
                          {{Form::number('balance','',['class'=>'form-control', 'id' => 'balance', 'readonly', 'required'])}}
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Pkg Start Date</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" required id="sub_start_date" name="sub_start_date" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Pkg End Date</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" required id="sub_end_date" name="sub_end_date" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Transaction Code</label>
                          {{Form::text('sub_trans_code','',['class'=>'form-control', 'required', 'placeholder' => 'Enter transaction code'])}}
                        </div>
                      </div>
                  </div>
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-check"></i> Add Subscription</button>
        </div>
      </div>
    </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
