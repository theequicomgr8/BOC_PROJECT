@extends('admin.layouts.layout')
<style>
body{
    color: #6c757d !important;
}
</style>
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
           <!-- <h1>Vendor Empanelment Renewal</h1>-->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-default">
      <div class="card-header">
            <h3 class="card-title">Vendor Private Media Renewal</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.end card-header -->          
          <form method="post" action="{{url('get-all-privatevendorlist')}}" autocomplete="off">
          {{ csrf_field() }} 
          <div class="card-body">
            <div class="row">               
            <div class="col-md-2"></div>
              <div class="col-md-6">
                 @if(session()->has('status'))  
                    <div align="center" style="color:red">
                        {{ session()->get('message') }}
                    </div>
                  @endif
                <div class="form-group">
                  <label for="publication">BOC Code / डीए वी पी कोड <font color="red">*</font></label>
                  <input type="text" name="davp_code" placeholder="Enter BOC Code" class="form-control" id="davp_code" required>
                  @if ($errors->has('davp_code'))
                    <span class="text-danger">{{ $errors->first('davp_code') }}</span>
                  @endif
                </div>
                <!-- /.form-group -->
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>            
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->      
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
