<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Digital Cinema Application Receipt</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }
        body{
            font-size:12px;
        }
        table, th, td {
       border:1px solid #dee2e6;
       border-collapse: collapse;
        }
    </style>
</head>
<body>
@php
$vendorData =$vendorData ?? '1';
$DigitalScreen_dTA=@$DigitalScreen ?? [1]; 
@endphp
<div class="card-body">
     <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
                <thead>
                <tr>
                        <td align="center" colspan="7"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                            <p><strong>GOVERNMENT OF INDIA <br />
                                    CENTRAL BUREAU OF  COMMUNICATION<br />
                                    Ministry of Information & Broadcasting</strong><br />
                                Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" colspan="7">
                           <b> Application No. : {{$vendorData->{'Agency Code'} ?? ''}}</b> 
                        </td>
                    </tr>
                </thead>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="150px"><strong>Profile Photo</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">
                            <div style="width:100px; height:100px; border:solid 1px #000;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Agency Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $AName =strtolower($vendorData->{'Agency Name'}); @endphp
                        <td>{{ucwords($AName) ?? ''}}</td>
                        <td><strong>E-mail ID</strong></td>
                        <td width="10px"><strong>:</strong></td>
                        <td>{{@$vendorData->{'E-Mail'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Mobile'} ?? ''}}</td>
                        <td><strong>Secondary Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Owner Secondary mobile no'} >0  ? @$vendorData->{'Owner Secondary mobile no'} :''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Address 1'} ?? ''}}</td>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @if($states > 0)
                              @foreach($states as $state)
                              @if(@$vendorData->{'State'} == $state['Code']) 
                              <td>{{$state['Description'] ?? ''}}</td>
                              @endif
                              @endforeach
                              @endif
                    </tr>
                    <tr> 
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'District'} ?? ''}}</td>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'City'} ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                    <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Phone'} ? @$vendorData->{'Phone'} : 'N/A'}}</td>
                        <td><strong>Pin Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Owner Post Code'} ? @$vendorData->{'Owner Post Code'} : 'N/A'}}</td>
                    </tr>
                    <tr>
                        <th colspan="6"><hr /></th>
                    </tr>
                    <tr>
                    <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'HO contact name'} ? @$vendorData->{'HO contact name'} : 'N/A'}}</td>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                         @if($states > 0)
                              @foreach($states as $state)
	                            @if(@$vendorData->{'HO State'} == $state['Code'])
                                <td>{{@$state['Description'] ?? ''}}</td>
                                @endif
                              @endforeach
                              @endif
                    </tr>
                    <tr>
                    <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'HO District'} ? @$vendorData->{'HO District'} : 'N/A'}}</td>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>@php $hoCity =strtolower(@$vendorData->{'HO City'}); @endphp
                                {{ucwords($hoCity) ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'HO Address 1'} ? @$vendorData->{'HO Address 1'} : 'N/A'}}</td>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'HO Designation'} ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'HO Phone'} ? @$vendorData->{'HO Phone'} : 'N/A'}}</td>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'HO Mobile'} ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{@$vendorData->{'HO E-Mail'} ? @$vendorData->{'HO E-Mail'} : 'N/A'}}</td>
                    </tr>
                    <tr>
                        <th colspan="6"><hr /></th>
                    </tr>
                    <tr>
                    <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'LOC contact name'} ? @$vendorData->{'LOC contact name'} : 'N/A'}}</td>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @if($states > 0)
                              @foreach($states as $state)
	                            @if(@$vendorData->{'LOC State'} == $state['Code']) 
                                <td> {{$state['Description'] ?? ''}}</td>
                                @endif
                              @endforeach
                              @endif
                    </tr>
                    <tr>
                    <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'LOC District'} ? @$vendorData->{'LOC District'} : 'N/A'}}</td>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>@php $LOCCity =strtolower(@$vendorData->{'LOC City'}); @endphp
                         {{ucwords($LOCCity) ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'LOC Address 1'} ? @$vendorData->{'LOC Address 1'} : 'N/A'}}</td>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'LOC Designation'} ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'LOC Phone'} ? @$vendorData->{'LOC Phone'} : 'N/A'}}</td>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'LOC Mobile'} ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{@$vendorData->{'LOC E-Mail'} ? @$vendorData->{'LOC E-Mail'} : 'N/A'}}</td>
                    </tr>
                    <tr>
                        <th colspan="6"><hr /> @php //dd($DigitalScreen_dTA[0]->{'Pin code'}); @endphp</th>
                    </tr>   
                    @if(count($DigitalScreen_dTA) > 0)
                    @foreach($DigitalScreen_dTA as $key => $DigitalSc)
                    @if($key > 0)
                    <tr>
                        <td colspan="6"><strong><hr /></strong></td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Company Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'Company Name'} ?? ''}}</td>
                        <td><strong>Agency Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'Agency Name'} ?? ''}}</td>
                      
                    </tr>
                    <tr>
                        <td><strong>Theatre Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'Theatre Name'} ?? ''}}</td>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @if($states > 0)
                              @foreach($states as $state)
                              @if(@$DigitalSc->{'State'} == $state['Code']) 
                              <td>{{$state['Description'] ?? ''}}</td>
                              @endif
                              @endforeach
                              @endif
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'District'} ?? ''}}</td>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        @php $multiCity =strtolower(@$DigitalSc->{'City'}); @endphp    
                        <td>{{ucwords($multiCity) ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'Address'} ?? ''}}</td>
                        <td><strong>Pin Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'Pin code'} ?@$DigitalSc->{'Pin code'} :'N/A'}}</td>
                    </tr>
                    <tr>
                    <td><strong>Seating Capacity</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'No_ Of Seats'} ?? ''}}</td>
                        <td><strong>Type of Screen</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'Screen Type'} == 0 ? 'Single':'Multiplex'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Web code</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{@$DigitalSc->{'Screen Unique Code'} ?? ''}}</td>
                    </tr>
                   
                    @endforeach
                        @endif
                        <tr>
                        <th colspan="6"><hr /></th>
                    </tr>
                    <tr>
                        <td><strong>Account Holder
                                Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $AccountHolderName =strtolower(@$vendorData->{'A_C Holder Name'}); @endphp
                        <td colspan="4">{{ ucwords($AccountHolderName) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Account Number for Receiving Payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Account No_'} ?? ''}}</td>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendorData->{'IFSC Code'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $BankName =strtolower(@$vendorData->{'Bank Name'}); @endphp
                        <td>{{ ucwords($BankName) }}</td>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        @php $branch_name = strtolower(@$vendorData->{'Branch Name'})@endphp
                        <td>{{ ucwords($branch_name) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$vendorData->{'Account Address'}) }}</td>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendorData->{'PAN'} }}</< /td>
                    </tr>
                    <tr><td colspan="6">ESI Account Details</td></tr>
                    <tr>
                        <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if( @$vendorData->{'ESI A_C No_'}){{ @$vendorData->{'ESI A_C No_'} }} @else  
                            N/A @endif</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$vendorData->{'No_ Of Emp in ESI'} >0){{@$vendorData->{'No_ Of Emp in ESI'} ?? 'N/A'}}@else  N/A @endif</td>
                    </tr>
                    <tr><td colspan="6">EPF Account Details</td></tr>
                    <tr>
                        <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$vendorData->{'EPF A_c No_'}){{@$vendorData->{'EPF A_c No_'} }} @else N/A @endif</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$vendorData->{'No_ Of Emp in EPF'} > 0){{@$vendorData->{'No_ Of Emp in EPF'} ?? 'N/A'}} @else N/A @endif</td>
                    </tr>
                <tr>
                    <th colspan="6" align="left"><h3>Uploaded Documents</h3></th>
                </tr>
                    <tr>
                        <td width="35%"><strong>Agreement between parties (Owner & Agencies)</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ @$vendorData->{'Agreement File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td width="35%"><strong>Balance sheet/ Auditor Financial Statement of past 3 years.</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ @$vendorData->{'BS_AF File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                       
                        <td><strong>Certificate of Incorporation</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Incorporation Cert File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Self Declaration</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendorData->{'Self Declaration'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                  
                    <!-- <tr style="margin-top:50px;border:none;">
                        <td colspan="6" align="left" height="0px" style="font-size:16px">I confirm that all the information given by me is true and nothing has been concealed.</td>
                    </tr> -->
                    <tr style="border:none !important;">
                        <td  colspan="6" height="80px">
                        <h3 align="left">I confirm that all the information given by me is true and nothing has been concealed.</h3>    
                        <p align="right" style="margin-top:100px">Authorized Signatory / Signature</p></td>
                    </tr>
                </table>
                </div>
                </div>
</body>

</html>