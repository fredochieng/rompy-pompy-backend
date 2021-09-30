@extends('adminlte::page')

@section('title', 'Add New Model')

@section('content_header')
    <h1>Rompy Pumpy | New Model</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Create New Model</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('model.save') }}" autocomplete="off"
                            enctype='multipart/form-data'>
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Name</label>
                                            {{ Form::text('name', '', ['class' => 'form-control', 'required', 'placeholder' => 'Enter model name']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            {{ Form::email('email', '', ['class' => 'form-control', 'required', 'placeholder' => 'Enter email address']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            {{ Form::text('phone_no', '', ['class' => 'form-control', 'required', 'placeholder' => 'Enter phone number']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Real Phone Number</label>
                                            {{ Form::text('real_phone_no', '', ['class' => 'form-control', 'required', 'placeholder' => 'Enter real phone number']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control select2" name="gender" required>
                                                <option value="">Select gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="dob"
                                                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd"
                                                    data-mask>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="form-control select2" name="country_id" id="country_id" required>
                                                <option value="">Select country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->country_id }}">
                                                        {{ $country->country_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control select2" name="city_id" id="city_id" required>
                                                <option value="">Select country first</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Ethnicity</label>
                                            <select class="form-control select2" name="ethnicity_id" id="ethnicity_id"
                                                required>
                                                <option value=''>Select country first</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Build</label>
                                            <select class="form-control select2" name="build_id" required required>
                                                <option value="">Select build</option>
                                                @foreach ($builds as $build)
                                                    <option value="{{ $build->build_id }}">{{ $build->build }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Preview Image</label>
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" required class="custom-file-input" name="preview_image" accept="image/*" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Services</label>
                                            <select class="form-control select2" name="service_id[]" multiple="multiple"
                                                required>
                                                <option>Select service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->service_id }}">{{ $service->service }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Availability</label>
                                            <select class="form-control select2" name="availability_id[]"
                                                multiple="multiple" required>
                                                @foreach ($availabilities as $availability)
                                                    <option value="{{ $availability->availability_id }}">
                                                        {{ $availability->availability }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>About Model</label>
                                            {{ Form::textarea('about', '', ['class' => 'form-control', 'required', 'placeholder' => 'Enter some information about the model...', 'rows' => '10', 'cols' => '200']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Add New Model</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('css')

@stop

@section('js')
    <!-- jQuery -->
    {{-- <script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script> --}}

    <script src="/vendor/adminlte/inputmask/jquery.inputmask.min.js"></script>
    <script src="/custom/js/selectors.js"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()
        })
    </script>

    <script>
        // $(function () {
        //   $.validator.setDefaults({
        //     submitHandler: function () {
        //       alert( "Form successful submitted!" );
        //     }
        //   });
        //   $('#quickForm').validate({
        //     rules: {
        //       email: {
        //         required: true,
        //         email: true,
        //       },
        //       password: {
        //         required: true,
        //         minlength: 5
        //       },
        //       terms: {
        //         required: true
        //       },
        //     },
        //     messages: {
        //       email: {
        //         required: "Please enter a email address",
        //         email: "Please enter a valid email address"
        //       },
        //       password: {
        //         required: "Please provide a password",
        //         minlength: "Your password must be at least 5 characters long"
        //       },
        //       terms: "Please accept our terms"
        //     },
        //     errorElement: 'span',
        //     errorPlacement: function (error, element) {
        //       error.addClass('invalid-feedback');
        //       element.closest('.form-group').append(error);
        //     },
        //     highlight: function (element, errorClass, validClass) {
        //       $(element).addClass('is-invalid');
        //     },
        //     unhighlight: function (element, errorClass, validClass) {
        //       $(element).removeClass('is-invalid');
        //     }
        //   });
        // });
    </script>
@stop
