@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
<style>
    .error {
        color: red;
        font-size: 14px;
    }

    input[type=radio] {
        width: 20px;
        height: 20px;
    }

    .table thead th {
        font-size: 13px;
        color: #444 !important;
    }

    .table td,
    .table th {
        padding: 0.45rem !important;
        font-size: 14px;
    }

    .select2-container .select2-selection--single {
        height: 31px !important;
    }

    .select2-search--dropdown .select2-search__field {
        padding: 0rem !important;
    }

    .select2-search--dropdown .select2-search__field {
        padding: 1px !important;
    }
    .fieldset-border {
    margin: 0 10px 15px 0px !important;
    }
</style> 
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@section('content')
@php
$branchcheckyes = '';
$branchcheckno = 'checked';
$branchdisplayform = 'none';
$show="none";

if(!empty($branch_data) && $branch_data[0]['BO E-mail'] !=''){
$branchcheckyes = 'checked';
$branchcheckno = '';
$branchdisplayform = 'block';
$show="";
}

@endphp
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Company Details</h6>
        </div>
        <input type="hidden" name="ODGSTID" id="ODGSTID" value="{{Session('ODGSTID')}}">
        <input type="hidden" name="IFSCCODE" id="IFSCCODE" value="{{Session('IFSCCODE')}}">
        @if((Session::has('ODGSTID') && Session::get('ODGSTID') !='') && (Session::get('IFSCCODE') ==''))
        <div class="alert alert-warning">
             Please Complete Your Account Details !! Click Here for Account Details <a href="/account-details" style="color: red;">Click</a>
        </div>
        @endif
        <!-- Card Body -->
        <div class="card-body">
            @if(Session::has('success'))
            <div align="center" class="alert alert-success" id="show_msg2" style="display: none;">
                {{ Session('success') }}
            </div>
            @endif
            <div align="center" class="alert alert-danger" style="display: none;"></div>
            <form method="post" action="/company-detail-save" enctype="multipart/form-data" id="company_detail_form" autocomplete="off">
                @csrf
                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
                        @include('admin.pages.outdoor-media.company-detail.common.owner-detail')
                        @include('admin.pages.outdoor-media.company-detail.common.gst-detail')
                        @include('admin.pages.outdoor-media.company-detail.common.head-office-detail')
                        @include('admin.pages.outdoor-media.company-detail.common.branch-office-detail')
                        @include('admin.pages.outdoor-media.company-detail.common.authorized-detail')
                        <fieldset class="fieldset-border">
                            <legend> Upload Document / दस्तावेज़ अपलोड करें</legend>
                            <strong><font color="red">All documents should be in PDF format and should not exceed with 2MB size.</font></strong>
                            <div class="row">
                                @if(@$vendor_data[0]['Legal Doc File Name']=="")
                                <div class="col-md-6">
                                    <div class="form-group tool_tip">
                                        <label for="exampleInputFile">Document of Legal Status of Company
                                            / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <i class="fa fa-info-circle"></i><font color="red">*</font></label>
                                            <span class="tooltip_text">Details of Authorized Signatory with documentary proof thereof.</span>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="Legal_Doc_File_Name" class="custom-file-input" id="Legal_Doc_File_Name" accept="application/pdf">
                                                <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">
                                                    Choose file
                                                </label>
                                            </div>
                                            @if(@$vendor_data[0]['Legal Doc File Name'] != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="{{ url('/uploads') }}/sole-right-media/{{ $vendor_data[0]['Legal Doc File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a>
                                                </span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="Legal_Doc_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="Legal_Doc_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload Document of Legal Status of Company 
                                            / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="Legal_Doc_File_Name_modify" class="custom-file-input" id="Legal_Doc_File_Name" accept="application/pdf">
                                                <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">
                                                    {{@$vendor_data[0]['Legal Doc File Name'] ?? 'Choose file' }}
                                                </label>
                                            </div>
                                            @if(@$vendor_data[0]['Legal Doc File Name'] != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Legal Doc File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a>
                                                </span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="Legal_Doc_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="Legal_Doc_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                @endif
                                @if(@$vendor_data[0]['PAN File Name']=="")
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Pan Card / पण कार्ड <font color="red">*</font></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name" class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name" accept="application/pdf">
                                                <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">Choose
                                                    file</label>
                                            </div>
                                            @if(@$vendor_data[0]['PAN File Name'] != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['PAN File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a></span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Pan Card / पण कार्ड <font color="red">*</font></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name_modify" class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name" accept="application/pdf">
                                                <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">{{@$vendor_data[0]['PAN File Name'] ?? 'Choose file' }}</label>
                                            </div>
                                            @if(@$vendor_data[0]['PAN File Name'] != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['PAN File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a></span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                @endif
                                @if(@$vendor_data[0]['GST File Name']=="")
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">GST Registration Certificate / जीएसटी
                                            पंजीकरण प्रमाणपत्र <font color="red">*</font></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="GST_File_Name" class="custom-file-input" id="GST_File_Name" accept="application/pdf">
                                                <label class="custom-file-label" id="GST_File_Name2" for="GST_File_Name">Choose file</label>
                                            </div>
                                            @if(@$vendor_data[0]['GST File Name'] != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['GST File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a></span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="GST_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="GST_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">GST Registration Certificate / जीएसटी
                                            पंजीकरण प्रमाणपत्र <font color="red">*</font></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="GST_File_Name_modify" class="custom-file-input" id="GST_File_Name_modify" accept="application/pdf">
                                                <label class="custom-file-label" id="GST_File_Name_modify2" for="GST_File_Name_modify">{{@$vendor_data[0]['GST File Name'] ?? 'Choose file' }}</label>
                                            </div>
                                            @if(@$vendor_data[0]['GST File Name'] != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['GST File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a></span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="GST_File_Name_modify3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="GST_File_Name_modify1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                @endif
                                <input type="hidden" name="odmedia_id" id="odmedia_id" value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                                <input type="hidden" name="doc[]" id="doc_data">
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary submit-button btn-sm m-0" id="company_detail" style="float: right;"><i class="fa fa-save"></i> {{ !Session('ODGSTID') ? 'Submit' : 'Update' }}</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
@section('custom_js')
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/js/outdoorMediaJs') }}/company-detail-validation.js"></script>
<script src="{{ url('/js/outdoorMediaJs') }}/sole-right-comman.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    //add more for branch 9-feb
    $(document).ready(function() {
        $("#add_branch").click(function() {
            var i = $("#count_branch_id").val();
            i++;
            var append = '<hr id="hrline_radio_' + i + '"><div class="row" id="row' + i + '"><div class="col-md-4"><div class="form-group"><label for="BO_Email">E-mail ID / ई-मेल आईडी <font color="red">*</font></label><p><input type="text" name="BO_Email[]" placeholder="Enter E-mail ID" class="form-control form-control-sm" id="BO_Email' + i + '" maxlength="30"></p></div></div><div class="col-md-4"><div class="form-group"><label for="BO_Mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label><p><input type="text" name="BO_Mobile[]" placeholder="Enter Mobile No." class="form-control form-control-sm" id="BO_Mobile' + i + '" onkeypress="return onlyNumberKey(event)" maxlength="10"></p></div></div><div class="col-md-4"><div class="form-group"><label for="BO_state">State / राज्य<font color="red">*</font></label><p><select id="BO_state' + i + '" name="BO_state[]" class="form-control form-control-sm"><option value="">Select State</option>@if(count($states) > 0)@foreach($states as $statesData)<option value="{{ $statesData['Code'] }}">{{$statesData['Description']}}</option>@endforeach @endif </select></p></div></div><div class="col-md-4"><div class="form-group"><label for="BO_Address">Address / पता <font color="red">*</font></label><p><textarea  type="text" name="BO_Address[]" id="BO_Address' + i + '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea></p></div></div><div class="col-md-4"><div class="form-group"><label for="BO_Landline_No">Landline No. / लैंडलाइन नंबर <font color="red"></font></label><p><input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="BO_Landline_No' + i + '" maxlength="14" onkeypress="return onlyNumberKey(event)"></p></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding: 0% 0 0 7%;"><button class="btn btn-danger btn-sm m-0 remove_branch_row" id="' + i + '" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>';
            $("#radio").append(append);
            $("#count_branch_id").val(i);
        });
        $(document).on('click', '.remove_branch_row', function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var line_no = $("#br_line_no_" + id).val();
            var odmedia_id = $("#br_odmedia_id_" + id).val();
            if (line_no != '' && odmedia_id != '') {
                if (confirm("Are you sure you want to delete this?")) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                        },
                        type: 'post',
                        url: '/remove-branchoffice-data',
                        data: {
                            line_no: line_no,
                            od_media_id: odmedia_id
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == true) {
                                $("#row" + id).remove(); //for hide after delete
                            }
                        }
                    });
                } else {
                    return false;
                }
            }
            $(this).parent().parent().remove();
            $("#hrline_radio_" + id).remove();
            var add_count = $("#count_branch_id").val();
            $("#count_branch_id").val(add_count - 1);
        });
    });
</script>

@endsection