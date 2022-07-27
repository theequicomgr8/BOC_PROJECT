@extends('admin.layouts.layout')
@section('content')
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Application Form for ABC Data Import</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            @if($message = Session::get('success'))
            <div align="center" class="alert alert-success">
                {{ $message }}
            </div>
            @endif
            @if($message = Session::get('fails'))
            <div align="center" class="alert alert-danger">
                {{ $message }}
            </div>
            @endif
            {!! Session::forget('fails') !!}
            {!! Session::forget('success') !!}
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="abc_file">ABC Data Import<font color="red">*</font></label>
                            <input type="file" name="file" class="form-control form-control-sm" id="abc_file" style="height: 37px;">
                            @if ($errors->has('file'))
                            <span class="text-danger">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <!-- <input type="file" name="file" class="form-control">
                <br> -->
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection