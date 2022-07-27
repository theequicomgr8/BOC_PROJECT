@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Account Details</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <input type="hidden" name="ODGSTID" id="ODGSTID" value="{{Session('ODGSTID')}}">
            @if(!Session('ODGSTID'))
            <div class="alert alert-warning">
                 Please Complete Your Company Details !! Click Here for Company Details <a href="/company-details" style="color: red;">Click</a>
            </div>
            @endif
            @if(session('status') === true)
            <div align="center" class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @else
            @if(session()->get('message'))
            <div align="center" class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
            @endif
            @endif
            <form method="POST" action="{{Route('update_account_detail')}}" autocomplete="off" id="account_detail_form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="tab-content">
                    <div class="content pt-3 tab-pane active show" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_card">PAN No. / पैन नंबर<font color="red">*</font>
                                    </label>
                                    <input type="text" name="pan_card" id="pan_card" class="form-control form-control-sm inputUC" placeholder="Enter PAN No." maxlength="10" value="{{ old('pan_card',@$data->{'PAN'}) ?? ''}}" onkeypress="javascript:return isAlphaNumeric(event,this.value);" onchange="validatePanNumber(this)">
                                    <span id="alert_pan_card" style="color:red;display: none;"></span>
                                    @error('pan_card')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font>
                                    </label>
                                    <input type="text" name="ifsc_code" id="ifsc_code" class="form-control form-control-sm inputUC" placeholder="Enter IFSC Code" maxlength="11" value="{{old('ifsc_code',@$data->{'IFSC Code'}) ?? ''}}" onkeypress="return isAlphaNumeric(event,this);" onchange="validateIfscCode(this)">
                                    <span id="alert_ifsc_code" style="color:red;display: none;"></span>
                                    @error('ifsc_code')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" name="Bank_Name" id="bank_name" class="form-control form-control-sm" placeholder="Enter Bank Name" maxlength="30" onkeypress="return onlyAlphabets(event)" value="{{old('Bank_Name',@$data->{'Bank Name'}) ?? ''}}">
                                    @error('Bank_Name')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch / शाखा<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Bank_Branch" id="branch_name" class="form-control form-control-sm" placeholder="Enter branch" maxlength="30" value="{{old('Bank_Branch',@$data->{'Bank Branch'}) ?? ''}}">
                                    @error('Bank_Branch')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account no / खाता नंबर<font color="red">*</font></label>
                                    <input type="text" name="Account_No" id="account_no" class="form-control form-control-sm" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="20" value="{{old('Account_No',@$data->{'Account No_'}) ?? ''}}">
                                    @error('Account_No')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                @if(@$data->{'Cancelled Cheque File Name'}=="")
                                <div class="form-group">
                                    <label for="exampleInputFile">Cancelled Cheque (Only PDF-2MB)/ रद्द चेक
                                        <font color="red">*</font>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="cancelled_cheque_file" class="custom-file-input" id="cancelled_cheque_file"  accept="application/pdf">
                                            <label class="custom-file-label" id="cancelled_cheque_file2" for="cancelled_cheque_file">Choose file</label>
                                        </div>
                                        @if(@$data->{'Cancelled Cheque File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$data->{'Cancelled Cheque File Name'} }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="cancelled_cheque_file3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="cancelled_cheque_file1" class="error invalid-feedback"></span>
                                    @error('cancelled_cheque_file')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="exampleInputFile">Cancelled Cheque (Only PDF-2MB)/ रद्द चेक (केवल पीडीएफ-2MB) <font color="red">*</font></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="cancelled_cheque_file_modify" class="custom-file-input" id="cancelled_cheque_file_modify"  accept="application/pdf">
                                            <label class="custom-file-label" id="cancelled_cheque_file_modify2" for="cancelled_cheque_file_modify">{{@$data->{'Cancelled Cheque File Name'}  ?? 'Choose file' }}</label>
                                        </div>
                                        @if(@$data->{'Cancelled Cheque File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$data->{'Cancelled Cheque File Name'} }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="cancelled_cheque_file_modify3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="cancelled_cheque_file_modify1" class="error invalid-feedback"></span>
                                </div>
                                @endif
                            </div>
                            <input type="hidden" name="doc[]" id="doc_data">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary submit-button btn-sm m-0" style="float: right;" {{ empty(@$data) ? 'disabled' : '' }} id="account_detail_save"><i class="fa fa-save"></i> {{ !Session('IFSCCODE') ? 'Submit' : 'Update' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.content-->
@endsection
@section('custom_js')
<script src="{{ url('/js/outdoorMediaJs') }}/sole-right-comman.js"></script>
<script>
    $(document).ready(function() {

        if ($("#ODGSTID").val() == '') {
            // read only all form true
            $('form *').prop('disabled', true);
            $(".m-0").css("pointer-events", "none");
        } else {
            // read only all form false
            $('form *').prop('disabled', false);
            $(".m-0").css("pointer-events", "visible");
        }
    });

    $(document).ready(function () {
    if ($('.alert-success').text() != '') {
        $('.alert-success').fadeIn();
        setTimeout(function () {
            $('.alert-success').fadeOut("slow");
             location.href = "outdoor-media-list";
        }, 7000);
    }
    if ($('.alert-danger').text() != '') {
        $('.alert-danger').fadeIn();
        setTimeout(function () {
            $('.alert-danger').fadeOut("slow");
            // window.location.reload();
        }, 7000);
    }
});
$(document).ready(function () {

$("#account_detail_save").click(function () {
    var form = $("#account_detail_form");
    form.validate({
        rules: {
            pan_card: {
                required: true,
            },
            ifsc_code: {
                required: true,
            },
            Bank_Name: {
                required: true,
            },
            Bank_Branch: {
                required: true,
            },
            Account_No: {
                required: true,
            },
            cancelled_cheque_file: {
                required: true,
            },
        },
        messages: {
            pan_card: {
                required: "Please Fill required Field!",
            },
            ifsc_code: {
                required: "Please Fill required Field!",
            },
            Bank_Name: {
                required: "Please Fill required Field!",
            },
            Bank_Branch: {
                required: "Please Fill required Field!",
            },
            Account_No: {
                required: "Please Fill required Field!",
            },
            cancelled_cheque_file: {
                required: "Please Fill required Field!",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }

    });
    if (form.valid() === false) {
        return false;
    }
});
});
</script>
@endsection