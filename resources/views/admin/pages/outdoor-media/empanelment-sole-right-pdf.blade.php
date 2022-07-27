<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Category-A Application Receipt</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }
        body{
            font-size:13px;
        }
        table, th, td {
  border:1px solid #dee2e6;
  border-collapse: collapse;
}

    </style>
</head>

<body>
    @php //dd($vendor_data[0]['Modification']);
    $media_cat = array('0' => 'Airport', '1' => 'Railways', '2' => 'Road', '3' => 'Transit Media', '4' => 'Others', '5' => 'Metro', '6' => 'Bus & Bus Station');
    @endphp
    <table width="100%" border="1" style="border-collapse: collapse;" cellspacing="0" cellpadding="5" class="tree">
        <tr>
            <td align="center"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                <p><strong>GOVERNMENT OF INDIA <br />
                        CENTRAL BUREAU OF  COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Profile Photo</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">
                            <div style="width:100px; height:100px; border:solid 1px #000;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><h3>Owner Details <h3></td>
                    </tr>
                    <tr>
                        <td><strong>Owner Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$owner_data[0]['Owner Name'] ?@$owner_data[0]['Owner Name'] :'N/A' }}</td>
                        <td><strong>E-mail ID(Owner)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$owner_data[0]['Email ID'] ?@$owner_data[0]['Email ID'] :'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$owner_data[0]['Mobile No_'] ?@$owner_data[0]['Mobile No_'] :'N/A' }}</td>
                        <td><strong>Address </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$owner_data[0]['Address 1'] ?@$owner_data[0]['Address 1'] :'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @foreach(@$states as $st)
                        @if($st['Code'] == $owner_data[0]['State'])
                        <td>{{ $st['Description'] }}</td>
                        @endif
                        @endforeach
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $owner_data[0]['District'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $owner_data[0]['City'] ?$owner_data[0]['City'] :'N/A'}}</td>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $owner_data[0]['Phone No_'] ?$owner_data[0]['Phone No_'] :'N/A'}}</td>
                    </tr>
                    <tr>
                        
                        <td colspan="6"><h3>Vendor Details <h3></td>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>GST No</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['GST No_'] ?@$vendor_data[0]['GST No_'] :'N/A' }}</td>
                        <td><strong>Agency Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $agency =strtolower($vendor_data[0]['PM Agency Name']); @endphp
                        <td>{{ @$vendor_data[0]['PM Agency Name'] ?ucwords($agency) :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>TIN/TAN No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['TIN_TAN_VAT No_'] ?$vendor_data[0]['TIN_TAN_VAT No_'] :'N/A' }}</td>
                        <td><strong>Any Other Relevant Information </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['Other Relevant Information'] ?$vendor_data[0]['Other Relevant Information'] :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['HO Address'] ?$vendor_data[0]['HO Address'] :'N/A' }}</td>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['HO Landline No_'] ?$vendor_data[0]['HO Landline No_'] :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Id</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['HO E-Mail'] ?$vendor_data[0]['HO E-Mail'] :'N/A' }}</td>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['HO Mobile No_'] ?$vendor_data[0]['HO Mobile No_'] :'N/A' }}</td>
                    </tr>
               
      
          @if(@$authorize_data > 0)
                    <tr>
                        <td colspan="6"><h3> Authorized Representative Details <h3></td>
                    </tr>
            @foreach(@$authorize_data as $authorized)
                    <tr>
                        <td><strong>Name </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$authorized['AR Name'] ?@$authorized['AR Name'] :'N/A' }}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$authorized['AR Address'] ?@$authorized['AR Address'] :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$authorized['AR Phone No_'] ?@$authorized['AR Phone No_'] :'N/A'}}</td>
                        <td><strong>Email Id</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$authorized['AR Email'] ? @$authorized['AR Email'] :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$authorized['AR Mobile'] ?@$authorized['AR Mobile'] :'N/A' }}</td>
                        <td><strong>Alternate Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$authorized['Alternate Mobile No_'] ?@$authorized['Alternate Mobile No_'] :'N/A' }}</td>
                    </tr>
                  
                    @endforeach
                    @endif
                   
                    <tr>
                        <td colspan="6"><h3> Authority Details <h3></td>
                    </tr>
                    <tr>
                        <td><strong>Authority Which Granted Media With Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['Authority Which granted Media'] ?? '' }}</td>
                        <td><strong>Contract No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['Contract No_'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>License Fee</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['License Fees'] ? round(@$vendor_data[0]['License Fees'],2) : ''}}</td>
                        <td><strong>License start date </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['License From'] ? date('d/m/Y', strtotime(@$vendor_data[0]['License From'])) : 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>License end date </strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{ @$vendor_data[0]['License To'] ? date('d/m/Y', strtotime(@$vendor_data[0]['License To'])) : 'N/A'}}</td>
                    </tr>
                    @php //dd($OD_media_address_data);@endphp
                    @if($OD_media_address_data > 0)
                    <tr>
                        <td colspan="6"><h3>Media Address Details<h3></td>
                    </tr>
                     @foreach($OD_media_address_data as $mediaaddress)
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @if($states > 0)
                        @foreach($states as $st)
                        @if($st['Code'] == $mediaaddress['State'])
                        <td>{{$st['Description'] ? $st['Description'] :'N/A'}}</td>
                        @endif
                        @endforeach
                        @endif
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $mediaaddress['District'] ?$mediaaddress['District']: 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$mediaaddress['City'] ?$mediaaddress['City'] :'N/A'}}</td>
                        @php
                        $odmediatype =''; 
                        if($mediaaddress['OD Media Type'] == 0){
                            $odmediatype ='Airport';
                        }elseif($mediaaddress['OD Media Type'] == 1){
                            $odmediatype ='Railways';
                        }elseif($mediaaddress['OD Media Type'] ==2){
                            $odmediatype ='Road';
                        }elseif($mediaaddress['OD Media Type'] ==3){
                            $odmediatype ='Transit Media';
                        }elseif($mediaaddress['OD Media Type'] ==4){
                            $odmediatype ='Others';
                        }elseif($mediaaddress['OD Media Type'] ==5){
                            $odmediatype ='Metro';
                        }
                        elseif($mediaaddress['OD Media Type'] ==6){
                            $odmediatype ='Bus & Station';
                        }
                        else{
                            $odmediatype ='';
                        }
                        echo $odmediatype;
                        @endphp

                        <td><strong>Media Category </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $odmediatype ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>Media Sub-Category</strong></td>
                        <td><strong>:</strong></td>
                        @if(@$mediaaddress['OD Media Type']!='')
                                                @foreach($getcat as $cat)
                                                @if(@$mediaaddress['OD Media ID']==$cat->media_uid)
                                                    
                                                    <td>{{$cat->name ?? ''}}</td>
                                                    @endif
                                                @endforeach
                                                @endif
                        <td><strong> Quantity/No. of location </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ !empty($mediaaddress) ? round(@$mediaaddress['Quantity'],2) : 'N/A'}}</td>
                    </tr>
                    <tr>
                    <td><strong>Train Number/Name</strong></td>
                        <td><strong>:</strong></td>
                      <td>{{ @$mediaaddress['Train Number'] != '' && $mediaaddress['Train Number'] != 0 ?$mediaaddress['Train Number'] .' - '. $mediaaddress['Train Name'] : 'N/A'}}</td>
                        <td><strong> No. of Spots </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$mediaaddress['No Of Spot'] ? round(@$mediaaddress['No Of Spot'],2) : 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Quantity</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$OD_media_address['Quantity'] ? round(@$OD_media_address['Quantity'],2) : 'N/A'}}</td>
                        @php 
                    $illum ='';
                    if($mediaaddress['Illumination Type'] == 1){
                        $illum ='Lit';
                    }elseif($mediaaddress['Illumination Type'] == 2){
                        $illum ='Non lit';
                    }else{
                        $illum ='N/A';
                    }

                    @endphp
                        <td><strong>Illumination</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$illum ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Lit Type </strong></td>
                        <td><strong>:</strong></td>
                        @if(@$OD_media_address['Lit Type']=='1') 
                        <td colspan="4">Front Lit</td>
                        @elseif(@$OD_media_address['Lit Type']=='2')
                        <td colspan="4">Back Lit</td>
                        @else
                        <td colspan="4">N/A</td>
                        @endif
                    </tr>
                    @foreach ($OD_media_address_data as $key => $OD_media_address)
                    <tr>
                        <td scope="row">{{ $key +1 }}</td>
                        <td>
                            @if(count($states) > 0)
                            @foreach($states as $statesData)
                            {{ @$OD_media_address['State'] == @$statesData['Code'] ? $statesData['Description'] : ''}}
                            @endforeach
                            @endif
                        </td>
                        <td>{{$OD_media_address['District'] ?? ''}}</td>
                        <td>{{ucfirst(strtolower(@$OD_media_address['City'])) ?? ''}}</td>
                        <td>
                            @foreach($media_cat as $k => $cat_val)
                            {{ @$OD_media_address['OD Media Type'] == $k ? $cat_val : ''}}
                            @endforeach
                        </td>
                        <td>
                            @if(@$OD_media_address['OD Media Type']!='')
                            @php
                            $subcatname = '';
                            @endphp
                            @foreach($getcat as $cat)
                            @php
                            if(@$OD_media_address['OD Media ID']==$cat->media_uid){
                            $subcatname = $cat->name;
                            echo $cat->name;
                            }
                            @endphp
                            @endforeach
                            @endif
                        </td>
                        {{-- <td>{{ !empty($OD_media_address['Train Number']) ? $OD_media_address['Train Number'] : 'NA'}}</td> --}}
                        {{-- <td>{{ !empty($OD_media_address['Train Name']) ? $OD_media_address['Train Name'] : 'NA'}}</td> --}}
                        {{-- <td>{{ !empty($OD_media_address['No Of Spot']) ? round(@$OD_media_address['No Of Spot'],2) : 'NA'}}</td> --}}
                        <td>{{ !empty($OD_media_address['Quantity']) ? round(@$OD_media_address['Quantity'],2) : 'NA'}}</td>
                        {{-- <td>{{ $OD_media_address['Length'] !=0 ? round(@$OD_media_address['Length'],2) : 'NA'}}</td> --}}
                        {{-- <td>{{ $OD_media_address['Width'] != 0 ? round(@$OD_media_address['Width'],2) : 'NA'}}</td> --}}
                        {{-- <td>{{ ($OD_media_address['Length'] !=0) && ($OD_media_address['Width'] !=0) ? round((@$OD_media_address['Length'] * @$OD_media_address['Width']),2) : 'NA'}}</td> --}}
                        {{-- <td> @if($OD_media_address['Size Type'] !=0) {{ $OD_media_address['Size Type'] =='1' ? 'CM' : 'FT'}} @else NA @endif</td> --}}
                        {{-- <td>{{ @$OD_media_address['Illumination Type']=='1' ? 'Lit' : 'Non Lit'}}</td> --}}
                        {{-- <td> @if(@$OD_media_address['Illumination Type']=='1') {{$OD_media_address['Lit Type'] =='1' ? 'Front Lit' : 'Back Lit'}} @else NA @endif</td> --}}
                        <td><a href="#" indexk="{{$key}}" class="view-location-modal" odmedia_id="{{@$OD_media_address['Sole Media ID']}}" subcatdata="{{@$OD_media_address['OD Media ID']}}" id="" catval="{{ @$OD_media_address['OD Media Type'] }}" subcattxt="{{@$subcatname }}" data-toggle="modal" data-target="#viewLocationModal">View</a></td>
                    </tr>
                    @endforeach    @foreach ($OD_media_address_data as $key => $OD_media_address)
                    <tr>
                        <td scope="row">{{ $key +1 }}</td>
                        <td>
                            @if(count($states) > 0)
                            @foreach($states as $statesData)
                            {{ @$OD_media_address['State'] == @$statesData['Code'] ? $statesData['Description'] : ''}}
                            @endforeach
                            @endif
                        </td>
                        <td>{{$OD_media_address['District'] ?? ''}}</td>
                        <td>{{ucfirst(strtolower(@$OD_media_address['City'])) ?? ''}}</td>
                        <td>
                            @foreach($media_cat as $k => $cat_val)
                            {{ @$OD_media_address['OD Media Type'] == $k ? $cat_val : ''}}
                            @endforeach
                        </td>
                        <td>
                            @if(@$OD_media_address['OD Media Type']!='')
                            @php
                            $subcatname = '';
                            @endphp
                            @foreach($getcat as $cat)
                            @php
                            if(@$OD_media_address['OD Media ID']==$cat->media_uid){
                            $subcatname = $cat->name;
                            echo $cat->name;
                            }
                            @endphp
                            @endforeach
                            @endif
                        </td>
                        {{-- <td>{{ !empty($OD_media_address['Train Number']) ? $OD_media_address['Train Number'] : 'NA'}}</td> --}}
                        {{-- <td>{{ !empty($OD_media_address['Train Name']) ? $OD_media_address['Train Name'] : 'NA'}}</td> --}}
                        {{-- <td>{{ !empty($OD_media_address['No Of Spot']) ? round(@$OD_media_address['No Of Spot'],2) : 'NA'}}</td> --}}
                        <td>{{ !empty($OD_media_address['Quantity']) ? round(@$OD_media_address['Quantity'],2) : 'NA'}}</td>
                        {{-- <td>{{ $OD_media_address['Length'] !=0 ? round(@$OD_media_address['Length'],2) : 'NA'}}</td> --}}
                        {{-- <td>{{ $OD_media_address['Width'] != 0 ? round(@$OD_media_address['Width'],2) : 'NA'}}</td> --}}
                        {{-- <td>{{ ($OD_media_address['Length'] !=0) && ($OD_media_address['Width'] !=0) ? round((@$OD_media_address['Length'] * @$OD_media_address['Width']),2) : 'NA'}}</td> --}}
                        {{-- <td> @if($OD_media_address['Size Type'] !=0) {{ $OD_media_address['Size Type'] =='1' ? 'CM' : 'FT'}} @else NA @endif</td> --}}
                        {{-- <td>{{ @$OD_media_address['Illumination Type']=='1' ? 'Lit' : 'Non Lit'}}</td> --}}
                        {{-- <td> @if(@$OD_media_address['Illumination Type']=='1') {{$OD_media_address['Lit Type'] =='1' ? 'Front Lit' : 'Back Lit'}} @else NA @endif</td> --}}
                        <td><a href="#" indexk="{{$key}}" class="view-location-modal" odmedia_id="{{@$OD_media_address['Sole Media ID']}}" subcatdata="{{@$OD_media_address['OD Media ID']}}" id="" catval="{{ @$OD_media_address['OD Media Type'] }}" subcattxt="{{@$subcatname }}" data-toggle="modal" data-target="#viewLocationModal">View</a></td>
                    </tr>
                    @endforeach
                    @endforeach
                    @endif
                    @if($branch_data > 0)
                    <tr>
                        <td colspan="6"><h3>Branch Details<h3></td>
                    </tr>
                    @foreach($branch_data as $branches)
                    <tr>
                    <td><strong>Email Id </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $branches['BO E-mail'] ?? '' }}</td>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $branches['BO Mobile No_'] ?? '' }}</td>
                    </tr>
                    
                    <tr>
                    <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @foreach($states as $getmul) 
                        @if($getmul['Code'] == $branches['State'])
                        <td>{{ $getmul['Description']}}</td>
                        @endif
                        @endforeach
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $branches['BO Landline No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{ $branches['BO Address'] ?? '' }}</td>
                    </tr>
                    <tr>
                        
                    </tr>
                  
                </table>
                    @endforeach 
                    @endif
                    @if(@$OD_work_dones_data[0]['Work Done Status'] == 1)
                    <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    
                    <tr>
                        <td colspan="6"><p>
                        I hereby certify that the above table contains details of <strong>ALL</strong> work undertaken by M/s  @php $agency =strtolower($vendor_data[0]['PM Agency Name']); @endphp
                        <u> {{ @$vendor_data[0]['PM Agency Name'] ?ucwords($agency) :'N/A' }} </u> pertaining to the media applied for, over the last six months from the date of submission of online application no. under Category A or C media.
                        </p></td>
                    </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>GST Receipts (GSTR1) </strong></td>
                        <td width="8"><strong>:</strong></td>
                        <td>{{@$OD_work_dones_data[0]['GST Receipts File Name'] != '' ?'Yes' : 'No'}}</td>
                        <td><strong>PO/Commercial Work Invoices</strong></td>
                        <td width="8"><strong>:</strong></td>
                        <td>{{ @$OD_work_dones_data[0]['GST Receipts File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                <tr>
                        <td colspan="6"><h3>Upload Annexure D<h3></td>
                    </tr>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Client Name</th>
                                                <th>Invoice No.</th>
                                                <th>GST No. Party 1</th>
                                                <th>GST No. Party 2</th>
                                                <th>Proof of GST submitted <br>against the invoice</th>
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
                                    </table>
                                            @endif
                      @if(@$OD_work_dones_data[0]['Work Done Status'] == 0)
                      <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                    <tr>
                    <td colspan="6"><h4>Details of Work in Last Six Months</h4></td>
                    </tr>
                        <td colspan="6"><p>I hereby certify that the agency M/s  @php $agency =strtolower($vendor_data[0]['PM Agency Name']); @endphp
                        <u> {{ @$vendor_data[0]['PM Agency Name'] ?ucwords($agency) :'N/A' }} </u> has <strong>NOT</strong> received any work from any source pertaining to the media applied for, over the last six months from the date of submission of online application no. under Category A or C media. I further understand that in such a case , CBC may fix the rate on the basis of lowest rate available in the vicinity or refuse to fix any rate for the media/locations if, in the opinion of CBC, media/locations are not commercially viable.</p></td>
                    </tr> 
                    <tr>
                    <td colspan="4"><strong>Reasons of non-receipt of any work over the last six months</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$OD_work_dones_data[0]['Non receipt file name'] !='' ?'Yes':'No' }}</td>
                    </tr>
                </table>
                    @endif 
                    <table width="100%" border="0" cellspacing="0" cellpadding="4">
                          <tr>
                        <td colspan="6"><h3>Account Details<h3></td>
                    </tr>
                <tr>
                        <td width="28%"><strong>PAN No.</strong></td>
                        <td width="8"><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['PAN'] }}</td>
                        <td><strong>IFSC Code</strong></td>
                        <td  width="8"><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['IFSC Code'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['Bank Name'] }}</td>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['Bank Branch'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Account No. </strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{ @$vendor_data[0]['Account No_'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="6"><h3>Uploaded Document<h3></td>
                    </tr>
                    <tr>
                        <td><strong>Upload document of legal status of company</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['Legal Doc File Name'] != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Attach copy of Pan Number and authorization of Bank for NEFT payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['PAN File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Submit an affidavit on stamp paper stating on oath that the details submitted by you on performa are true and correct.Mention the application no. in affidavit </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['Affidavit File Name'] != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>GST registration Certificate</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['GST File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Notarized Copy of Agreement </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['Notarized Copy File Name'] != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Affidavit of Oath</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['Affidavit File Name'] != '' ?'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Latest License Fees Paid </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['Last License Fee Paid File'] != '' ?'Yes' : 'No'}}</td>
                        <td><strong>Justification of Rate Offered to CBC</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['Rate Offered to BOC File'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                    <td><strong>Certified Media Lis</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{'No'}}</td>
                        <td><strong>Self declaration</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['Self-declaration'] == 1 ? 'Yes' : 'No' }}</td>
                    </tr>
                </table>
                @if(count($OD_lat_data) > 0)                                 

            <table width="100%" border="0" cellspacing="0" cellpadding="4">

                    <tr>
                        <td colspan="6"><h3>Location Details<h3></td>
                    </tr>
                                      
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Location Name</th>
                                                <th scope="col">Long Image</th>
                                                <th scope="col">Close Image</th>
                                                <th scope="col">Latitude</th>
                                                <th scope="col">Longitude</th>
                                            </tr>
                                        
                                            @if(count($OD_lat_data) > 0)
                                                @foreach($OD_lat_data as $key=>$latlongData)
                                                    <tr>
                                                        <td scope="row">{{ $key +1 }}</td>
                                                        <td>{{$latlongData['Location Name']}}</td>
                                                        <td>
                                                            {{$latlongData['Far Image File Name'] !='' ?'Yes' :'No'}}
                                                        </td>
                                                        <td>
                                                        {{$latlongData['Image File Name'] !='' ?'Yes' :'No'}}
                                                        </td>
                                                        <td>{{$latlongData['Latitude']}}</td>
                                                        <td>{{$latlongData['Longitude']}}</td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">No Location Found</td>
                                                </tr>
                                            @endif
        </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr style="border:none !important;">
                        <td  colspan="6" height="80px">
                        <h3 align="left">I confirm that all the information given by me is true and nothing has been concealed.</h3>
                        <p align="right" style="margin-top:100px">Authorized Signatory / Signature</p></td>
                    </tr>
  </table>
@endif
</body>

</html>