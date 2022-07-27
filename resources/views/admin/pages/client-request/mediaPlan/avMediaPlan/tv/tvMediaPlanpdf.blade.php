<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Media Plan</title>
    <style>
      body{
    color: #6c757d !important;
    font-size:12px;
  }
  tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .tree {
            page-break-inside: avoid;
        }
        table, th, td {
        border:1px solid #dee2e6;
        border-collapse: collapse;
        }
    </style>
</head>
            @php
            $results = !empty($npLists) ? $npLists:[1];
            $mpdetail=!empty($mpdetails) ? $mpdetails:[1];
            @endphp
        <body>
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
    <table class="table table-striped table-bordered table-hover order-list" id="myTable" width="100%">
    <thead>
    <tr><th colspan="8" style="float: right;"><h4>MEDIA PLAN</h4> </th></tr>
    <tr>
        <td colspan="2"><b>Request No.</b></td>
        <td colspan="2">{{ $mpdetail->{'Client Request Code'} }}</td>
        <td colspan="2"><b>MP No.</b></td>
        <td colspan="2">{{ $mpdetail->{'MP No_'} }}</td>
        {{-- <td colspan="2"><b>Language Name</b></td>
        <td colspan="2">{{ @$LanguageName ? @$LanguageName:'N/A' }}</td> --}}
      </tr>
   <tr>
     <td colspan="2"><b>Ministry</b></td>
     <td colspan="2">{{ @$MinistryName ?? 'N/A'}}</td>
     <td colspan="2"><b>Ministry Head</b></td>
     <td colspan="2">{{ $mpdetail->{'Ministry Head'} ?? 'N/A'}}</td>
   </tr>
   <tr>
    <td colspan="2"><b>Plan Budget</b></td>
    <td colspan="2">{{ @$mpdetail->{'Planned Budget'} ? @number_format(@round(@$mpdetail->{'Planned Budget'})):'N/A' }} </td>
   <td colspan="2"><b>Client Name</b></td>
     <td colspan="2">{{ @$mpdetail->{'Client Name'} ? @$mpdetail->{'Client Name'}:'N/A'}}</td>
   </tr>
   <tr>
     <td colspan="2"><b>Actual Amount</b></td>
     <td colspan="2">{{@$npActualAmt }}</td>
   </tr>
</thead>
</table>
        <table class="table table-striped table-bordered table-hover order-list" id="myTable" width="100%">
            <thead>
            <tr>
                <th scope="col" >S.No</th>
                <th scope="col" >MP No.</th>
                <th scope="col" >Agency Code</th>
                <th scope="col" >Agency Name</th>
                <th scope="col" >Category</th>
                <th scope="col" >Amount</th>
            </tr>
            </thead>
                <tbody>
                @php
                $emptyArray = [];
                $emptyArrayone = [];
                $emptyArraytwo = [];
                $total =[];
                $totalone =[];
                $totaltwo =[];
                $totalper =[];
                $totaloneper =[];
                $totaltwoper =[];
                $budgate=@$mpdetail->{'Planned Budget'};
                @endphp
                @forelse($results as $key=>$result)
                    <tr>
                      <td>{{ $key+1  }}</td>
                      <td>{{ $mpdetail->{'MP No_'} }} </td>
                      <td>{{ @$result->{'Channel No_'}  }} </td>
                      <td>{{ @$result ->{'Channel Name'} }}</td>
                      @if(@$result->{'Media Category'}==1)
                       <td>{{ 'GEC'  }} </td>
                      @php
                      $emptyArrayone[] = $result->{'Media Category'};
                      $totalone[]=$result->{'Amount'};
                      $totaloneper[]=($result->{'Amount'}/$budgate)*100;
                      @endphp
                       @elseif(@$result->{'Media Category'}==2)
                       <td>{{ 'Non-GEC'  }} </td>
                       @php
                      $emptyArraytwo[] = $result->{'Media Category'};
                      $totaltwo[]=$result->{'Amount'};
                      $totaltwoper[]=($result->{'Amount'}/$budgate)*100;
                      @endphp
                      @else
                      <td>{{ 'NA'  }} </td>
                       @endif
                       <td>
                        @php
                        $budgate=@round(@$mpdetails->{'Planned Budget'});
                        $amount=@$result->{'Amount'};
                        $per=($amount/$budgate)*100;
                        @endphp
                         {{ @number_format(@$result->{'Amount'})  }} ( {{ @number_format($per,2).'%' }})
                        </td>
                    </tr>
                  @empty
                      <tr style="background:silver"><td colspan="7" ><strong style="padding-left: 279px;">No Data</strong></td></tr>
                  @endforelse
           </tbody>
     </table>
   <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%">
     <thead>
         {{-- <tr>
            <td clospan="4"><b>Agree/Return With Comment: </b></td>
            @if($mpdetail->{'Cl Approval Received'}==1)
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
        </tr> --}}
      </thead>
    </table>
    <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%" align="left">
     <thead>
     <tr>
           <th colspan="4"><h3>Summary</h3></th>
        </tr>
      <tr>
           <th>Category</th>
           <th>No. of Channel</th>
           <th>Amount</th>
           <th>Percentage(%)</th>
        </tr>
    </thead>
        <tr>
           <td>GEC</td>
           <td>{{count($emptyArrayone)}}</td>
           <td>{{ @number_format(array_sum($totalone))  }}</td>
           @php $perone = array_sum($totaloneper); @endphp
           <td>({{ @number_format($perone,2).'%' }})</td>
        </tr>
        <tr>
           <td>Non-GEC</td>
           <td>{{count($emptyArraytwo)}}</td>
           <td>{{ @number_format(array_sum($totaltwo))  }}</td>
           @php $pertwo = array_sum($totaltwoper); @endphp
           <td>({{ @number_format($pertwo,2).'%' }})</td>
        </tr>
    </table>
      </div>
    </div>
</body>
</html>
