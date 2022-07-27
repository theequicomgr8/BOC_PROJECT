@extends('admin.layouts.layout')
<style>
  body {
    color: #6c757d !important;
  }
</style>
@php
$od_media_id=Request::segment(2);
$odMediaID=Session::put('odMediaID',$od_media_id);
if($filebase_url == "")
{
$disable='disabled';
}
else{
$disable='';
}
@endphp

@section('content')
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"> <i class="fa fa-edit" aria-hidden="true"></i> Outdoor Media Agreement</h6>
      <h2 class="text-right">
        {{-- <a href="{{ url('solefile-download')}}" download class="btn btn-primary btn-sm">Export to PDF</a>
      </h2> --}}
      @if($filebase_url == "")
      <a href="#" class="btn btn-primary btn-sm" id="checkfile" title="No file available">View PDF</a></h2>
      @else
      <a href="{{$filebase_url}}" download target="_blank" class="btn btn-primary btn-sm">View PDF</a></h2>
      @endif
    </div>
    <!-- /.end card-header -->
    <div class="card-body">
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
      <form action="{{ route('solefile.upload.post') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="publication">Upload Agreement file / अनुबंध फ़ाइल अपलोड करें<font color="red">*</font></label>
              <input type="file" name="file" class="form-control" accept="application/pdf">
            </div>
            <input type="hidden" name="od_media_id" value="{{ $od_media_id }}">
            <!-- /.form-group -->
            <button type="submit" class="btn btn-primary" {{ $disable }}>Upload</button>
          </div>
        </div>
        <!-- /.row -->
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.container-fluid -->
<!-- /.content-wrapper -->
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function() {
    $("#checkfile").click(function() {
      swal({
        text: "No file available!",
        icon: "warning",
        dangerMode: true,
      })
    });
  });
</script>
@endsection