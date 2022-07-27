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

        .tree {
            page-break-inside: avoid;
        }
.text-size{
  text-size:10px;
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
if($mpdetail->{'Cl Approval Received'}==1){
$disabled='disabled';
}else{
$disabled='';
}
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
    <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
    
     <thead>
         <tr><th colspan="8" style="float: right;"><h4>MEDIA PLAN - {{$mpdetail->{'MP No_'} }}</h4>  </th></tr>
      <tr>
          <td colspan="2"><b>Request No.</b></td>
          <td colspan="2">{{ $mpdetail->{'Client Request Code'} }}</td>
          <td colspan="2"><b>Language List</b></td>
          <td colspan="2">{{ @$LanguageName ? @$LanguageName:'N/A' }}</td> 
        </tr>
        <tr>
          <td colspan="2"><b>MP No.</b></td>
          <td colspan="2">{{ $mpdetail->{'MP No_'} }}</td>
          <td colspan="2"><b>Language</b></td>
          @if(@$mpdetail->{'Language'} ==0)      
                        <td colspan="2">{{ 'Single' }} </td>
                      @elseif(@$mpdetail->{'Language'} ==1)
                        <td colspan="2"> {{ 'Multiple' }} </td>
                      @elseif(@$mpdetail->{'Language'} ==2)
                        <td colspan="2"> {{ 'Hindi & English' }} </td>
                      @elseif(@$mpdetail->{'Language'} ==3) 
                        <td colspan="2"> {{ 'State Language Preference' }} </td>
                        @else
                        <td colspan="2"></td>
                      @endif
        </tr>
        <tr>
          <td colspan="2"><b>Ministry</b></td>
          <td colspan="2">{{ @$MinistryName ?? 'N/A'}}</td>
          <td colspan="2"><b>Print Size</b></td>
          @php  $printsize = ''; @endphp
          @if(@$mpdetail->{'Print Size Selection'} ==0)      
                      <td colspan="2">Custom Size</td>
                      @elseif(@$mpdetail->{'Print Size Selection'} ==1)
                      <td colspan="2">Half Page Horizontal</td>
                      @elseif(@$mpdetail->{'Print Size Selection'} ==2)
                      <td colspan="2">Full Page</td>
                      @elseif(@$mpdetail->{'Print Size Selection'} ==3)
                      <td colspan="2">Half Page Vertical</td>
                      @elseif(@$mpdetail->{'Print Size Selection'} ==4)
                      <td colspan="2">Quarter Page</td>
                      @else <td colspan="2">N/A</td>
                      @endif
                     
        </tr>
        <tr>
                    <td colspan="2"><b>Ministry Head</b></td>
                    <td colspan="2">{{ $mpdetail->{'Ministry Head'} ?? 'N/A'}}</td>
                    <td colspan="2"><b>Advt. Area(Sq cm)</b></td>
                    <td colspan="2"> {{ $mpdetail->{'Advt_ Area(Sq cm)'}? @round($mpdetail->{'Advt_ Area(Sq cm)'}):'NA' }} </td>  
      </tr>
        <tr>
          <td colspan="2"><b>Adv. length</b></td>
            <td colspan="2">{{ @round($mpdetail->{'Adv_ Length'}) }} </td>
        <td colspan="2"><b>Advt. Breadth</b></td>
             <td colspan="2">{{ $mpdetail->{'Adv_ Breadth'}? @round($mpdetail->{'Adv_ Breadth'}):'N/A' }} 
             </td>
        </tr>
        <tr>
          <td colspan="2"><b>Client Name</b></td>
          <td colspan="2">{{ @$mpdetail->{'Client Name'} ?@$mpdetail->{'Client Name'}:'N/A'}}</td>
          <td colspan="2"><b>Advertisement Type</b></td>
          @if($mpdetail->Color == 0)      
                        <td colspan="2">{{ 'Color' }} </td>
                      @elseif($mpdetail->Color == 1) 
                        <td colspan="2"> {{ 'B/W' }} </td>
                        @else 
                        <td colspan="2">N/A</td>
                      @endif 
        </tr>
        <tr>
          <td colspan="2"><b>Target Area</b></td>
          @if(@$mpdetail->{'Target Area'} ==0)      
                        <td colspan="6">{{ 'Pan India' }} </td>
                      @elseif(@$mpdetail->{'Target Area'} ==1)
                        <td colspan="6"> {{ 'Individual State' }} </td>
                      @elseif(@$mpdetail->{'Target Area'} ==2)
                        <td colspan="6"> {{ 'Group of States' }} </td>
                      @elseif(@$mpdetail->{'Target Area'} ==3) 
                        <td colspan="6"> {{ 'Cities' }} </td>
                        @else
                        <td colspan="6">N/A</td>
                      @endif 
        </tr>
       
       
        <tr>
          <td colspan="2"><b>Plan Budget</b></td>
          <td colspan="2">{{ @$mpdetail->{'Plan Budget'} ? @number_format(@round(@$mpdetail->{'Plan Budget'})):'N/A'}}</td>
          <td colspan="2"><b>Utilize Amount</b></td>
          @php
                     $amt=array();
                     foreach($results as $res){
                     $amt[]=$res->Amount;}
                    @endphp
          <td colspan="2">{{ @$npActualAmt }}</td> 
        </tr>
        </thead>
    </table>
    <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%">   
    <thead>
        <tr>
                  <th scope="col" >S.No</th>
                  <th scope="col" >NP Code</th>
                  <th scope="col" >NP Name</th>
                  <th scope="col" >Language</th>
                  <th scope="col" >State Name</th>
                  <th scope="col" >City</th>
                  <th scope="col" >Category</th>
                  <th scope="col" >Periodicity Name</th>
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
        $budgate=$mpdetail->{'Plan Budget'}; 
        @endphp
        @forelse($results as $key=>$result)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ @$result->{'NP Code'} }} </td>
                      <td>{{ @$result->{'NP Name'}  }} </td> 
                      <td>{{ @$result->{'Language'}  }} </td> 
                      <td>{{ @$result->{'State Name'}  }} </td>
                      <td>{{ @$result->{'City'}  }} </td>
                      @if(@$result->{'Category'}==0)
                      <td>{{ 'BIG'}} </td>
                      @php $emptyArray[] = $result->{'Category'};
                      $total[]=$result->{'Amount'};
                      $totalper[]=($result->{'Amount'}/$budgate)*100;
                      @endphp
                      @elseif(@$result->{'Category'}==1)
                       <td>{{ 'MEDIUM'  }} </td>
                       @php 
                      $emptyArrayone[] = $result->{'Category'};
                      $totalone[]=$result->{'Amount'};
                      $totaloneper[]=($result->{'Amount'}/$budgate)*100;
                      @endphp
                       @elseif(@$result->{'Category'}==2)
                       <td>{{ 'SMALL'  }} </td>
                       
                      @php 
                      $emptyArraytwo[] = $result->{'Category'};
                      $totaltwo[]=$result->{'Amount'};
                      $totaltwoper[]=($result->{'Amount'}/$budgate)*100;
                      @endphp
                       @endif
                       <td>{{@$result->{'Periodicity Name'} ? @$result->{'Periodicity Name'} :'N/A' }} </td>  
                       <td> @php
                        $amount=@$result->{'Amount'};
                        $per=($amount/$budgate)*100;
                        @endphp
                       
                         {{ @number_format(@$result->{'Amount'})  }} ( {{ @number_format($per,2).'%' }})    </td> 
                         
                    </tr>
                  @empty
                      <tr style="background:silver"><td colspan="7" ><strong style="padding-left: 279px;">No Data</strong></td></tr>
                  @endforelse
          </tbody>
        </table>
        <br />
        <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
     <thead>
      <tr>
            <td clospan="4"><b>Agree/Return With Comment:</b></td>
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
            
        </tr>
    </thead>
    </table>

<table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%" align="center">  
     <thead>
     <tr>
           <th colspan="4"><h3>Summary</h3></th>
          
        </tr>
      <tr>
           <th>Category</th>
           <th>No. of Papers</th>
           <th>Amount</th>
           <th>Percentage(%)</th>
        </tr>
    </thead>
    <tr>
           <td>BIG</td>
           <td>{{count($emptyArray)}}</td>
           <td>{{ @number_format(array_sum($total))  }}</td>
           @php $per = array_sum($totalper);  @endphp
           <td>({{ @number_format($per,2).'%' }})</td>
        </tr>
        <tr>
           <td>MEDIUM</td>
           <td>{{count($emptyArrayone)}}</td>
           <td>{{ @number_format(array_sum($totalone))  }}</td>
           @php $perone = array_sum($totaloneper); @endphp
           <td>({{ @number_format($perone,2).'%' }})</td>
        </tr>
        <tr>
           <td>SMALL</td>
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