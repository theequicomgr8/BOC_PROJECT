@extends('admin.layouts.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- /.end card-header -->
  <div class="content-inside p-3">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-normal text-primary">Vendor Renewal For Personal Outdoor</h6>
      </div>
      <!-- /.end card-header -->
      <form method="post" action="{{url('personal-renewal')}}" autocomplete="off">
        {{ csrf_field() }}
        <div class="tab-content">
          <div class="content pt-3 tab-pane active show" role="tabpanel">
            <div class="row" style="margin:0">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                @if(session()->has('status'))
                <div align="center" style="color:red">
                  {{ session()->get('message') }}
                </div>
                @endif
                <div class="form-group">
                  <label for="publication">BOC Code / बीओसी कोड*</label>
                  <input type="text" name="boc_code" placeholder="Enter BOC Code" class="form-control form-control-sm" id="boc_code">
                  @if ($errors->has('boc_code'))
                  <span class="text-danger">{{ $errors->first('boc_code') }}</span>
                  @endif
                </div>
              </div>
              <div class="col-md-4"></div>
              <button type="submit" class="btn btn-primary" style="margin: auto;margin-bottom: 15px;">Submit</button>
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.card-body -->
      </form>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.content-inside -->
</div>
<!-- /.content-wrapper -->
@endsection