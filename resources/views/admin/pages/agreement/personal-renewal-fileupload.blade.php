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
              <h5 class="card-title font-weight-normal  text-primary">Personal Renewal Agreement</h5>
              <h2 class="text-right" style="margin-top: -45px;">
                {{-- <a href="{{ url('sole-renewalfile-download')}}" download class="btn btn-primary btn-sm">Export to PDF</a></h2> --}}
                @if($filebase_url == "")
                  <a href="#" class="btn btn-primary btn-sm" title="No file available">View PDF</a></h2>
                @else
                  <a href="{{$filebase_url}}" download target="_blank" class="btn btn-primary btn-sm">View PDF</a></h2>
                @endif
        </div>
          <!-- /.end card-header -->  
          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('failed'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            {!! Session::forget('success') !!}
            {!! Session::forget('failed') !!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>Only upload pdf file.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif    
            
          <form action="{{ route('personalrenewalAgreementupload') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
            <div class="col-md-2"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="publication">Upload Agreement file /  अनुबंध फ़ाइल अपलोड करें<font color="red">*</font></label>
                  <input type="file" name="file" class="form-control" accept="application/pdf">
                </div>
                <!-- /.form-group -->
                <button type="submit" class="btn btn-primary">Upload</button>
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