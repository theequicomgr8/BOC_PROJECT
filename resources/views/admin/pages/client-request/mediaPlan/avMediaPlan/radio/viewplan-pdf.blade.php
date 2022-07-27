<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Media Request Application Receipt</title>
    <style>
      body{
    color: #6c757d !important;
    font-size:12px;
  }
  tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .tree{
            page-break-inside: avoid;
        }
        table, th, td {
        border:1px solid #dee2e6;
        border-collapse: collapse;
        }
    </style>
</head>
@php 
            $results=isset($npLists)? $npLists:'';
            $mpdetail='';
            $mpdetail=isset($mpdetails)? $mpdetails:''; 
            if(@$mpdetail->{'Cl Approval Received'}==1){
            $disabled='disabled';
            }else{
            $disabled='';
          }
          //dd($mpdetail);
            @endphp
<body>
    <div class="card-body">
     <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
     <thead>
      <tr>
          <td align="center" colspan="8"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                <p><strong>GOVERNMENT OF INDIA <br />
                        CENTRAL BUREAU OF  COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
          </td>
        </tr>
    </thead>
    </table>
    <table class="table table-striped table-bordered table-hover order-list" id="myTable" width="100%"> 
    <thead>
    <tr><th colspan="8" style="float: right;"><h4>MEDIA PLAN</h4>  </th></tr>
    <tr>
     <td colspan="2"><b>Request No.</b></td>
     <td colspan="2">{{ @$mpdetails->{'Client Request Code'} ? @$mpdetails->{'Client Request Code'} :'N/A' }}</td>
     <td colspan="2"><b>MP No.</b></td>
     <td colspan="2">{{@$mpdetails->{'MP No_'} ? @$mpdetails->{'MP No_'} :'N/A' }}</td>
   </tr>
   <tr>
     <td colspan="2"><b>Ministry</b></td>
     <td colspan="2">{{ @$MinistryName ? @$MinistryName :'N/A'}}</td> 
     <td colspan="2"><b>Ministry Head</b></td>
   <td colspan="2">{{ @$mpdetail->{'Ministry Head'} ? @$mpdetail->{'Ministry Head'} :'N/A'}}</td>         
   </tr>
   <tr>
   <td colspan="2"><b>Client Name</b></td>
     <td colspan="2">{{ @$mpdetail->{'Client Name'} ? @$mpdetail->{'Client Name'}:'N/A'}}</td>
     <td colspan="2"><b>Target Area</b></td>
     @if(@$mpdetails->{'Target Area'} ==0)
     <td colspan="2">Pan India</td>
     @elseif(@$mpdetails->{'Target Area'} ==1)
     <td colspan="2">Specific Regional</td>
     @elseif(@$mpdetails->{'Target Area'} ==2)
     <td colspan="2">Group Regional</td>
     @else
      <td colspan="2">Group Regional</td>
     @endif
   </tr>
   <tr>
     <td colspan="2"><b>Plan Budget</b></td>
     <td colspan="2">{{ @$mpdetails->{'Planned Budget'} ? @round(@$mpdetails->{'Planned Budget'}):'N/A' }}
     </td>
     <td colspan="2"><b>Actual Amount</b></td>
     <td colspan="2">{{ @$npActualAmt  }} </td> 
   </tr>
</thead>
</table>
<table class="table table-striped table-bordered table-hover" id="myTable" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>MP No.</th>
                  <th>Channel Code</th>
                  <th colspan="2">Channel Name</th>
                  <th colspan="2">Amount</th> 
                </tr>
                </thead>
                 <tbody>
                  @forelse($results as $key=>$result)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{  $result->{'Document No_'}  }} </td>
                      <td>{{  $result->{'FM No_'}  }} </td>
                      <td colspan="2">{{$result ->{'FM Name'} }}</td>
                       <td colspan="2">
                        @php
                        $budgate=@$mpdetails->{'Planned Budget'}; 
                        $amount=@$result->{'Amount'};
                        $per=($amount/$budgate)*100;
                        @endphp
                         {{ @number_format(@$result->{'Amount'})  }} ( {{ @number_format($per,2).'%' }})    
                        </td>  
                    </tr>
                  @empty
                      <tr style="background:silver"><td colspan="8" ><strong style="padding-left: 279px;">No Data</strong></td></tr>
                  @endforelse
                </tbody>  
              </table>
   <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
     <thead>
      <tr>
            <td clospan="4"><b>Agree/Return With Comment:</b></td>
            @if(@$mpdetail->{'Cl Approval Received'}==1)
            @if(@$mpdetail->{'Client Consent'}==0)
            <td clospan="4">Agree</td>
            @elseif(@$mpdetail->{'Client Consent'}==1)
            <td clospan="4">Return With Comment</td>  
            @else 
            <td clospan="4">N/A</td>
            @endif  
            @else  
            <td clospan="4">N/A</td>
            @endif 
        </tr>
    </thead>
    </table>
      </div>
    </div>

</body>

</html>