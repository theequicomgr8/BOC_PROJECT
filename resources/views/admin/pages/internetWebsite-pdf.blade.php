<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Internet Website Application Receipt</title>
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
$intweb = isset($VendorDatapdf) ? $VendorDatapdf:'';
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
                        @php $AName =strtolower($intweb->{'Agency Name'}); @endphp
                        <td>{{ucwords($AName) ?? ''}}</td>
                        <td><strong>E-mail ID</strong></td>
                        <td width="10px"><strong>:</strong></td>
                        <td>{{@$intweb->{'E-Mail'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$intweb->{'Mobile'} ?? ''}}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        {{-- <td>{{@$intweb->{'Address 2'} ?? ''}}</td> --}}
                    </tr>

                    <tr>
                        <td><strong>Group Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$intweb->{'Group Name'} ?? ''}}</td>
                        <td><strong>Website URL</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$intweb->{'Website URL'} ?? ''}}</td>
                    </tr>

                    {{-- <tr>
                        <td><strong>Domain Registration Date</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$intweb->{'Domain Registration Date'} ?? ''}}</td>
                        <td><strong>Website Category</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$intweb->{'Website Category'} ?? ''}}</td>
                    </tr> --}}
                    {{-- <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @if($intweb > 0)
                              @foreach($intweb as $state)
                              @if(@$intweb->{'State'} == $state['Code'])
                              <td>{{$state['Description'] ?? ''}}</td>
                              @endif
                              @endforeach
                              @endif
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$intweb->{'District'} ?? ''}}</td>
                    </tr> --}}

                    <tr>
                        <th colspan="6"><hr /></th>
                    </tr>
                    <tr>
                        <td><strong>Account Holder Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $AccountHolderName =strtolower(@$intweb->{'A_C Holder Name'}); @endphp
                        <td colspan="4">{{ ucwords($AccountHolderName) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank account number for receiving payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$intweb->{'Account No_'} ?? ''}}</td>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $intweb->{'IFSC Code'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $BankName =strtolower(@$intweb->{'Bank Name'}); @endphp
                        <td>{{ ucwords($BankName) }}</td>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        @php $branch_name = strtolower(@$intweb->{'Branch Name'})@endphp
                        <td>{{ ucwords($branch_name) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$intweb->{'Account Address'}) }}</td>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$intweb->{'PAN'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$intweb->{'ESI A_C No_'} ?? ''}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$intweb->{'No_ Of Emp iun ESI'} >0){{@$intweb->{'No_ Of Emp iun ESI'} ?? ''}}@endif</td>
                    </tr>
                    <tr>
                        <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$intweb->{'EPF A_c No_'} ?? ''}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$intweb->{'No_ Of Emp in EPF'} > 0){{@$intweb->{'No_ Of Emp in EPF'} ?? ''}}@endif</td>
                    </tr>
                    <tr>
                        <th colspan="6" align="left"><h3>Uploaded Documents</h3></th>
                    </tr>
                        <tr>
                            <td width="35%"><strong>Report of average monthly unique user count for last 6 months certified by website auditor</strong></td>
                            <td width="3%"><strong>:</strong></td>
                            <td>{{$intweb->{'Auditor Report File Name'} != '' ? 'Yes' : 'No'}}</td>
                            <td><strong>Upload document for Pan Card</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $intweb->{'PAN Upload'} != '' ? 'Yes' : 'No'}}</td>
                        </tr>
                        <tr>
                            <td width="35%"><strong>Upload document for GST</strong></td>
                            <td width="3%"><strong>:</strong></td>
                            <td>{{$intweb->{'GST Upload'} != '' ? 'Yes' : 'No'}}</td>
                            <td width="35%"><strong>3PAS (party at server) certificate engagement with BOC</strong></td>
                            <td width="3%"><strong>:</strong></td>
                            <td>{{$intweb->{'3PAS Certificate File Name'} != '' ? 'Yes' : 'No'}}</td>
                        </tr>
                        <tr>
                            <td><strong>Certificate to insure that websites work owned and operated in india</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{  $intweb->{'OOIC File Name'} != '' ? 'Yes' : 'No'}}</td>
                            <td width="35%"><strong>Annexure-A for rates</strong></td>
                            <td width="3%"><strong>:</strong></td>
                            <td>{{@$intweb->{'Annexure A File Name'} != '' ? 'Yes' : 'No'}}</td>
                        </tr>
                        <tr>
                            <td><strong>Notarized certificate under name, signature and seal stating that information is correct</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ @$intweb->{'Notorized Cert_ File Name'} != '' ? 'Yes' : 'No'}}</td>
                            <td width="35%"><strong>Payment fee for Rs. 5000/- (INR)</strong></td>
                            <td width="3%"><strong>:</strong></td>
                            <td>{{$intweb->{'Fees Payment File Name'} != '' ? 'Yes' : 'No'}}</td>
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
