<x-app-dashboard title="{{ __('Dashboard') }}">

    <!-- Info boxes -->
    <div class="row">
     <div class="col-12 col-md-4">
       <div class="info-box">
         <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-tie"></i></span>
 
         <div class="info-box-content">
           <span class="info-box-text"> {{ __('User Positions') }}</span>
           <span class="info-box-number">
             {{ $positions->count() }}
           </span>
         </div>
         <!-- /.info-box-content -->
       </div>
       <!-- /.info-box -->
     </div>
     <!-- /.col -->
     <div class="col-12 col-md-4">
       <div class="info-box mb-3">
         <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
 
         <div class="info-box-content">
           <span class="info-box-text">{{ __('Users') }}</span>
           <span class="info-box-number">{{ $users->count() }}</span>
         </div>
         <!-- /.info-box-content -->
       </div>
       <!-- /.info-box -->
     </div>
     <!-- /.col -->
 
     <!-- fix for small devices only -->
     <div class="clearfix hidden-md-up"></div>
 
     <div class="col-12 col-md-4">
       <div class="info-box mb-3">
         <span class="info-box-icon bg-success elevation-1"><i class="fas fa-pen-alt"></i></span>
 
         <div class="info-box-content">
           <span class="info-box-text">{{ __('User Attendance') }}</span>
           <span class="info-box-number">{{ $absences->count() }}</span>
         </div>
         <!-- /.info-box-content -->
       </div>
       <!-- /.info-box -->
     </div>
     <!-- /.col -->
   </div>
   <!-- /.row -->
 
 </x-app-dashboard>
 