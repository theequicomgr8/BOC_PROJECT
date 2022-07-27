@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Account Detail</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            @if(session()->has('status') == true) 
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

            <form method="POST" action="{{Route('account-detail-save')}}" autocomplete="off" id="account_detail_form">
                {{ csrf_field() }}
                <div class="tab-content">
                    <div class="content pt-3 tab-pane active show" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4"><br>
                                <div class="form-group">
                                    <label for="account_type">Account Type / खाते का प्रकार<font color="red">*</font></label>
                                    <select class="form-control  form-control-sm" name="account_type" id="account_type">
                                        <option value="">Please Select</option>
                                        <option value="0" {{ (@$account_detail['Account Type'] == 0 && @$account_detail['Account Type'] != "" ? 'selected' : '') }}>Saving</option>
                                        <option value="1" {{ (@$account_detail['Account Type'] == 1 ? 'selected' : '') }}>Corporate</option>
                                    </select>
                                    @error('account_type')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_account_no">Bank Account Number for Payments/ भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
                                    <input type="text" class="form-control  form-control-sm" name="bank_account_no" maxlength="20" id="bank_account_no" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" value="{{ $account_detail['Bank Account No_'] ?? old('bank_account_no') }}">
                                    @error('bank_account_no')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group divmargin">
                                    <label for="account_holder_name">Account Holder Name / खाता धारक का नाम<font color="red">*</font></label>
                                    <input type="text" class="form-control  form-control-sm" name="account_holder_name" maxlength="70" id="account_holder_name" placeholder="Enter Account Holder Name" onkeypress="return onlyAlphabets(event,this)" value="{{ $account_detail['Account Holder Name'] ?? old('account_holder_name') }}">
                                    @error('account_holder_name')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code / आईएफएससी कोड<font color="red">*</font></label>
                                    <input type="text" class="form-control  form-control-sm" name="ifsc_code" id="ifsc_code" maxlength="11" placeholder="Enter IFSC Code" value="{{ $account_detail['IFSC Code'] ?? old('ifsc_code') }}" onkeypress="return isAlphaNumeric(event,this);" onchange="validateIfscCode(this),checksum(this);">
                                    <span id="alert_ifsc_code" style="color:red;display: none;"></span>
                                    @error('ifsc_code')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                                    <input type="text" class="form-control  form-control-sm" name="bank_name" id="bank_name" maxlength="50" placeholder="Enter Bank Name" value="{{ $account_detail['Bank Name'] ?? old('bank_name') }}">
                                    @error('bank_name')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_name">Branch / शाखा<font color="red">*</font></label>
                                    <input type="text" class="form-control  form-control-sm" name="branch_name" id="branch_name" maxlength="40" placeholder="Enter Branch" value="{{ $account_detail['Branch'] ?? old('branch_name') }}">
                                    @error('branch_name')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_of_account">Address of Account / खाते का पता<font color="red">*</font></label>
                                    <textarea class="form-control  form-control-sm" placeholder="Enter Address of Account" maxlength="220" name="address_of_account" id="address_of_account">{{ $account_detail['Account Address'] ?? old('address_of_account') }}</textarea>
                                    @error('address_of_account')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_card">PAN Card No. / पैन कार्ड नंबर<font color="red">*</font></label>
                                    <input type="text" name="pan_card" id="pan_card" class="form-control form-control-sm" maxlength="10" placeholder="Enter PAN Card No." value="{{ $account_detail['PAN'] ?? old('pan_card') }}" onkeypress="javascript:return isAlphaNumeric(event,this.value);" onchange="validatePanNumber(this)">
                                    <span id="alert_pan_card" style="color:red;display: none;"></span>
                                    @error('pan_card')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <fieldset class="fieldset-border">
                                <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ESI_account_no">Account No. / खाता नंबर</label>
                                            <input type="text" name="ESI_account_no" id="ESI_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No." onkeypress="return onlyNumberKey(event)" value="{{ $account_detail['ESI Account No'] ?? '' }}">
                                            <span id="alert_address_of_account" style="color:red;display: none;"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ESI_no_employees">No. of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
                                            <input type="text" name="ESI_no_employees" id="ESI_no_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No. of Employees Covered" onkeypress="return onlyNumberKey(event)" value="{{ ((@$account_detail['No_of Employees covered'] && @$account_detail['No_of Employees covered'] !=0) ? @$account_detail['No_of Employees covered'] : '' ) }}">
                                            <span id="alert_ESI_no_employees" style="color:red;display: none;"></span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="fieldset-border">
                                <legend>EPF Account Details / ईपीएफ खाता विवरण</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Name">Account No. / खाता नंबर</label>
                                            <input type="text" name="EPF_account_no" id="EPF_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No." onkeypress="return onlyNumberKey(event)" value="{{ $account_detail['EPF Account No_'] ?? '' }}">
                                        </div>
                                        <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Name">No. of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
                                            <input type="text" name="EPF_no_of_employees" id="EPF_no_of_employees" maxlength="6" class="form-control form-control-sm" placeholder="Enter No. of Employees Covered" onkeypress="return onlyNumberKey(event)" value="{{ ((@$account_detail['No_ of EPF Employees covered'] && @$account_detail['No_ of EPF Employees covered'] !=0) ? @$account_detail['No_ of EPF Employees covered'] : '' ) }}">
                                            <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary submit-button btn-sm m-0 " {{ (!session()->has('UserName') || empty($account_detail)) ? 'disabled':'' }}><i class="fa fa-save"></i> Update</button>
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
<script src="{{ url('/js/vendorPrintJs') }}/fresh-em-validation_accountdetails.js"></script>
@endsection