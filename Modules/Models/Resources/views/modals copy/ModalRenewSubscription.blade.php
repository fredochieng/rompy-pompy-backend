<div class="modal fade" id="ModalRenewSubscription_{{$model->user_id}}">
    <div class="modal-dialog modal-xl">
        <form class="" method="POST"
        action="{{ route('subscription.renew') }}" role="form" autocomplete="off" enctype='multipart/form-data'>
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Renew Subscription - #{{$subs1->sub_no}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="card-body">
                <div class="row">
                    <input type="hidden" name="s_model_id" value="{{$subs1->user_id}}">
                    <input type="hidden" name="sub_id" value="{{$subs1->sub_id}}">
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Pkg Name</label>
                          {{Form::text('sub_pkg_name',$subs1->sub_pkg_name,['class'=>'form-control', 'id' => 'sub_pkg_name', 'readonly', 'required'])}}
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Current Sub Pkg Start Date</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{$subs1->sub_start_date}}" readonly id="sub_start_dat" name="sub_start_dat" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Current Sub Pkg End Date</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{$subs1->sub_end_date}}" readonly id="sub_end_dat" name="sub_end_dat" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Pkg Amount</label>
                          {{Form::number('sub_amount1',$subs1->sub_amount,['class'=>'form-control', 'id' => 'sub_amount1', 'readonly','required'])}}
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
                          <label>Renewal Duration (Months)</label>
                          {{Form::number('sub_duration1','',['class'=>'form-control', 'required', 'id' => 'sub_duration1', 'placeholder' => 'Enter renewal duration'])}}
                        </div>
                      </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Sub Renewal Amount</label>
                        {{Form::number('paid_amount1','',['class'=>'form-control', 'required', 'readonly', 'id' => 'paid_amount1','placeholder' => 'Enter renewal amount'])}}
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Renewal Balance</label>
                          {{Form::number('balance1','',['class'=>'form-control', 'id' => 'balance1', 'readonly', 'required'])}}
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Pkg Renewal Start Date</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{$subs1->sub_end_date}}" id="sub_start_date1" name="sub_start_date1" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Pkg Renewal End Date</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="sub_end_date1" name="sub_end_date1" data-inputmask-alias="datetime" readonly data-inputmask-inputformat="yyyy-mm-dd" data-mask>
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
          <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-sync"></i> Renew Subscription</button>
        </div>
      </div>
    </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
