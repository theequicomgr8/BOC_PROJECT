<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bulk sms Application Receipt</title>
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

                  $Bluksms=$Bluksms ?? [1];
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
                        @php $AName =strtolower($Bluksms->{'Agency Name'}); @endphp
                        <td>{{ucwords($AName) ?? ''}}</td>
                        <td><strong>E-mail ID</strong></td>
                        <td width="10px"><strong>:</strong></td>
                        <td>{{@$Bluksms->{'E-Mail'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Bluksms->{'Mobile'} ?? ''}}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Bluksms->{'Address 1'} ?? ''}}</td>
                    </tr>
                    
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @if($result > 0)
                              @foreach($result as $state)
                              @if(@$Bluksms->{'State'} == $state['Code']) 
                              <td>{{$state['Description'] ?? ''}}</td>
                              @endif
                              @endforeach
                              @endif
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Bluksms->{'District'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Bluksms->{'City'} ?? 'N/A'}}</td>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Bluksms->{'Phone'} ? @$Bluksms->{'Phone'} : 'N/A'}}</td>
                    </tr>
                  
                        <tr>
                        <th colspan="6"><hr /></th>
                    </tr>
                    <tr>
                        <td><strong>Account Holder
                                Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $AccountHolderName =strtolower(@$Bluksms->{'A_C Holder Name'}); @endphp
                        <td colspan="4">{{ ucwords($AccountHolderName) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Account Number for Receiving Payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Bluksms->{'Account No_'} ?? ''}}</td>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Bluksms->{'IFSC Code'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $BankName =strtolower(@$Bluksms->{'Bank Name'}); @endphp
                        <td>{{ ucwords($BankName) }}</td>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        @php $branch_name = strtolower(@$Bluksms->{'Branch Name'})@endphp
                        <td>{{ ucwords($branch_name) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$Bluksms->{'Account Address'}) }}</td>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$Bluksms->{'PAN'} }}</< /td>
                    </tr>
                    <tr><td colspan="6">ESI Account Details</td></tr>
                    <tr>
                        <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$Bluksms->{'ESI A_C No_'} ? @$Bluksms->{'ESI A_C No_'} : 'N/A'}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$Bluksms->{'No_ Of Emp in ESI'} >0){{@$Bluksms->{'No_ Of Emp in ESI'} }}@else N/A @endif</td>
                    </tr>
                    <tr><td colspan="6">EPF Account Details</td></tr>
                    <tr>
                        <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Bluksms->{'EPF A_c No_'} ? @$Bluksms->{'EPF A_c No_'} :'N/A'}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$Bluksms->{'No_ Of Emp in EPF'} > 0){{@$Bluksms->{'No_ Of Emp in EPF'} }}@else N/A @endif</td>
                    </tr>
                <tr>
                    <th colspan="6" align="left"><h3>Uploaded Documents</h3></th>
                </tr>
                    <tr>
                        <td width="35%"><strong>Upload TRAI registration certificate</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{$Bluksms->{'TRAI RC File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Copy of job order with any ministry, public sector etc. In past 2 years</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Bluksms->{'JOC File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td width="35%"><strong>Throughput per second for empanelment under bulk sms service</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{$Bluksms->{'Throughput File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Documentary proof having commercial experience of delivering at least ten (10) crore bulk in a single month for empanelment </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Bluksms->{'Bulk SDP File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td width="35%"><strong>Document issued by the operator/service provider for the capacity of ten (10) lakh calls per day for empanelment under obd services</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{$Bluksms->{'10L OBD Call File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Documentary proof for having commercial experience of
                making fifty
                (50) lakh calls in a month for empanelment under OBD services </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{  $Bluksms->{'50L OBD Cal File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td width="35%"><strong>An affidavit to the effect that the agency / operator
                has not been temporarily suspended or permanently de-empanelment</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{@$Bluksms->{'Affidavit For NS File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>An affidavit that the proprietor or Director or
                promoter of the
                agency has not been implicated by a court of law and no proceeding are pending in a court of law and that the agency/ operator with comply all laws in land </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$Bluksms->{'Affidavit For Dir File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td width="35%"><strong>It should have the database of mobile numbers of their
                own for dissemination of information. It should provide the necessary proof in this regard </strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{$Bluksms->{'Mobile number ODB File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Certificate of incorporation in India</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$Bluksms->{'Incorporation Cert File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td width="35%"><strong>Upload document for GST</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td colspan="4">{{@$Bluksms->{'PAN Upload File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
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