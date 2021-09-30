@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Rompy Pumpy | Dashboard</h1>
@stop

@section('content')
     <!-- =========================================================== -->
     <div class="row">
       <div class="col-md-3 col-sm-6 col-12">
         <div class="info-box bg-info">
           <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Active Models</span>
             <span class="info-box-number">{{ $active_models }}</span>

             <div class="progress">
               <div class="progress-bar" style="width: 70%"></div>
             </div>
             <span class="progress-description">
               Total active models
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-12">
         <div class="info-box bg-success">
           <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Inactive Models</span>
             <span class="info-box-number">{{ $active_models }}</span>

             <div class="progress">
               <div class="progress-bar" style="width: 70%"></div>
             </div>
             <span class="progress-description">
               Total inactive models
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-12">
         <div class="info-box bg-warning">
           <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Active Subs</span>
             <span class="info-box-number">{{ $active_subs }}</span>

             <div class="progress">
               <div class="progress-bar" style="width: 70%"></div>
             </div>
             <span class="progress-description">
               70% Increase in 30 Days
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-12">
         <div class="info-box bg-danger">
           <span class="info-box-icon"><i class="fas fa-comments"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Inactive Subs</span>
             <span class="info-box-number">{{ $active_subs }}</span>

             <div class="progress">
               <div class="progress-bar" style="width: 70%"></div>
             </div>
             <span class="progress-description">
               Total amount paid
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
     </div>

     <div class="row">
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-info">
            <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inactive Models</span>
              <span class="info-box-number">{{ $total_sub_amount }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                Total inactive models
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Number of Payments</span>
              <span class="info-box-number">{{ $total_no_payments }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                Number of payments made
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
     <!-- /.row -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
