@php
$dd_line =[];
$i=0;
$OD_work_dones = !empty($OD_work_dones_data) ? $OD_work_dones_data : [1];


   
//dd($OD_work_dones_data);
@endphp
<fieldset class="fieldset-border">
    <legend> Details of Work in Last Six Months, for the Applied Media Only, if
        any (As Per Format Given Below) <br>केवल आवेदन मीडिया के लिए पिछले छह महीनों में कार्य का विवरण, यदि कोई हो (नीचे दिए गए प्रारूप के अनुसार)</legend>
    <div class="row" >
        <div class="col-md-6">
            <!-- <h6 id="sample_file" style="display: none;">If You Want to upload <a href="{{asset('uploads/work_done_excel.xlsx')}}">Download Sample File</a></h6> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 tool_tip">
                <h6>Have you done any work in last 6 months? <i class="fa fa-info-circle"></i></h6>
                <span class="tooltip_text">Copies of all work orders (and bills pertaining to the same) for the media as well as locations for the past six (6) month at the time of application. <strong>The GST number of both the parties should be mentioned on the copy of bills generated. You should also certify that you have submitted all the orders for the past six months as per the Performa attached (Annexure D). </strong><br/>
                    You should also submit copy of GST paid for the same work order (s).
<br/><br/>
                    <strong>Note:</strong> In case of the media which has been installed afresh and in whose case work orders are not available, CBC may fix the rate on the basis of lowest rate available in the vicinity.
                    However, CBC may refuse to fix rate for a media/location if, in the opinion of CBC, media/locations is not commercially viable.
</span>
        </div>
         <div class="col-md-3">
            <input type="radio" name="xls2" id="xlxyes2" value="1" class="xls2" {{@$OD_work_dones_data[0]['Work Done Status'] == 1 ? 'checked' : ''}}> Yes &nbsp;
            <input type="radio" name="xls2" id="xlxno2" value="0" class="xls2" {{@$OD_work_dones_data[0]['Work Done Status'] == 0 ? 'checked' : ''}}> No
        </div>
            
    </div>

    <div class="row" id="xls_show2" style="display: none;">
        <div class="col-md-12">
            <p>I hereby certify that the attached document contains details of <strong>ALL</strong> work undertaken by M/s <input type="text" name="applicant_name" id="applicant_name" required value="{{ @$agency_name }}" style="border-top: none;border-left: none;border-right: none;" readonly="readonly"> pertaining to the media applied for, over the last six months from the date of submission of online application no. under Category A or C media.</p>
        </div>
        <div class="col-md-12">
            <strong>
                <font color="red">GST Receipts (GSTR1) and PO/Commercial Work Invoices documents should be in PDF format with 2MB size.</font><br>
            </strong>    
        </div>
        
        <div class="col-md-4">
            <label>Upload Annexure D (<a href="{{asset('uploads/work_done_excel.xlsx')}}"><i class="fa fa-download" aria-hidden="true"></i> Sample File</a>)</label>
            <input type="file" name="media_import2" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
        </div>
        <div class="col-md-4">
            <label>GST Receipts (GSTR1) </label>
            <input type="file" name="media1" class="form-control form-control-sm" accept="application/pdf">
        </div>
        <div class="col-md-4">
            <label>PO/Commercial Work Invoices </label>
            <input type="file" name="media2" class="form-control form-control-sm" accept="application/pdf">
        </div>
    </div>
  @if(@$OD_work_dones_data[0]['Work Done Status'] == 1)
    <div class="row" id="xls_show_view">
        <div class="col-md-12">
            <p>I hereby certify that the above table contains details of <strong>ALL</strong> work undertaken by M/s <input type="text" name="applicant_name" id="applicant_name" required value="{{ @$agency_name }}" style="border-top: none;border-left: none;border-right: none;" readonly="readonly"> pertaining to the media applied for, over the last six months from the date of submission of online application no. under Category A or C media.</p>
        </div>
        <div class="col-md-12">
            <strong>
                <font color="red">GST Receipts (GSTR1) and PO/Commercial Work Invoices documents should be in PDF format with 2MB size.</font><br>
            </strong>    
        </div>
        
        <div class="col-md-4">
            <label>Upload Annexure D (<a href="{{asset('uploads/work_done_excel.xlsx')}}"><i class="fa fa-download" aria-hidden="true"></i> Sample File</a>)</label>
            <input type="file" name="media_import2" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
        </div>
        <div class="col-md-4">
            <label>GST Receipts (GSTR1) </label>
            <!-- <input type="file" name="media1" class="form-control form-control-sm" accept="application/pdf"> -->
            @if(@$OD_work_dones_data[0]['GST Receipts File Name'] != '')  
                <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$OD_work_dones_data[0]['GST Receipts File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;"></i>View File</a></span>
            @endif
        </div>
        <div class="col-md-4">
            <label>PO/Commercial Work Invoices </label>
            <!-- <input type="file" name="media2" class="form-control form-control-sm" accept="application/pdf"> -->
            @if(@$OD_work_dones_data[0]['GST Receipts File Name'] != '')  
                <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$OD_work_dones_data[0]['GST Invoices File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;"></i>View File</a></span>
            @endif
        </div>

        <div class="col-md-12">
        <table class="table" style="border: 1px solid gainsboro;margin-top: 10px;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr.No.</th>
                                                <th scope="col">Client Name</th>
                                                <th scope="col">Invoice No.</th>
                                                <th scope="col">GST No. Party 1</th>
                                                <th scope="col">GST No. Party 2</th>
                                                <th scope="col">Proof of GST submitted <br>against the invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($OD_work_dones_data) > 0)
                                                @foreach($OD_work_dones_data as $key=>$ODWorkDone)

                                                
                                                    <tr>
                                                        <td scope="row">{{ $key +1 }}</td>
                                                        <td>{{$ODWorkDone['Client Name']}}</td>
                                                        <td>{{$ODWorkDone['Invoice Number']}}</td>
                                                        <td>{{$ODWorkDone['GST Party 1']}}</td>
                                                        <td>{{$ODWorkDone['GST Party 2']}}</td>
                                                        <td class="text-center">
                                                            @if($ODWorkDone['Proof GST Submitted'] == 0)
                                                                No
                                                            @else
                                                                Yes
                                                            @endif
                                                        </td>
                                                      
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center">No Location Found</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
 
    </div>

@endif
@if(@$OD_work_dones_data[0]['Work Done Status'] == 0)
<div class="row" id="xls_show3" >
    <div class="col-md-12"> 
        <p>I hereby certify that the agency M/s <input type="text" name="applicant_name" id="applicant_name" required style="border-top: none;border-left: none;border-right: none;" value="{{ @$agency_name }}"  readonly="readonly"> has <strong>NOT</strong> received any work from any source pertaining to the media applied for, over the last six months from the date of submission of online application no. under Category A or C media. I further understand that in such a case , CBC may fix the rate on the basis of lowest rate available in the vicinity or refuse to fix any rate for the media/locations if, in the opinion of CBC, media/locations are not commercially viable.</p>

    </div>
    @if(@$OD_work_dones_data[0]['Non receipt file name'] == '')
        <div class="col-md-6">
            <label for="media_import3">Reasons of non-receipt of any work over the last six months <br/>(Only PDF-2MB)</label>
            <input type="file" name="media_import3" class="form-control form-control-sm" accept="application/pdf">
        </div>
    @else
        <div class="col-md-6">
            <label for="media_import3">Reasons of non-receipt of any work over the last six months <br/>(Only PDF-2MB)</label>
            <!-- <input type="file" name="media_import3" class="form-control form-control-sm" accept="application/pdf"> -->
            <span class="input-group-text">{{ @$OD_work_dones_data[0]['Non receipt file name'] }} <a href="{{ url('/uploads') }}/sole-right-media/{{ @$OD_work_dones_data[0]['Non receipt file name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;margin-left: 225px;"></i></a></span>
        </div>
    @endif
</div>
@endif
    <br>
   

   
  
</fieldset>