@extends('admin.layouts.layout')

@section('content')
<?php
//Convert Indian formats
function moneyFormatIndia($num){
    $explrestunits = "" ;
    $num = preg_replace('/,+/', '', $num);
    $words = explode(".", $num);
    $des = "00";
    if(count($words)<=2){
        $num=$words[0];
        if(count($words)>=2){$des=$words[1];}
        if(strlen($des)<2){$des="$des";}else{$des=substr($des,0,2);}
    }
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return "$thecash"; // writes the final format where $currency is the currency symbol.

}
?>
<?php $user_id = Session::get('UserID'); ?>
<div class="content-inside p-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download" aria-hidden="true"></i> Generate Report</a> -->
    </div>


    <div class="row">
         @if(Session::get('UserType')==4)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('tam-data') }}">
            <div class="card c1 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c1-txt text-uppercase mb-1 module-name">Upload TAM Data</div>
                            <div class="text-xs font-weight-bold mb-1">
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        @endif

        @if(Session::get('UserType')==5)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('rob-adg-list') }}">
            <div class="card c1 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c1-txt  mb-1 module-name">RO's Pre Activity List</div>
                            <div class="text-xs font-weight-bold mb-1">
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        @endif



        @if(Session::get('UserType')==0)
        <div class="col-xl-4 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('client-submission-list') }}">
            <div class="card c1 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c1-txt text-uppercase mb-1 module-name">Client Request List</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('client-submission-list') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('client-submission-form') }}">
            <div class="card c2 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c2-txt text-uppercase mb-1 module-name">Add Client Request</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('client-submission-form') }}">Add Request <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('media-plan') }}">
            <div class="card c3 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c3-txt text-uppercase mb-1 module-name">Media Plan List</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('media-plan') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

        @endif

        @if(Session::get('UserType')==1)
        @if(Session::get('WingType')==3)
        <style>
        .table-bordered td, .table-bordered th{
            font-size:10px;
        }
        </style>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{url('/release-order-list')}}" class="text-gray-800">
                <div class="card c4 shadow h-100 py-2 ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c4-txt text mb-1 module-name" >ROs Released Today</div>
                                <div class="text-xs font-weight-bold mb-1">
                                    <!-- <a class="text-gray-800" href="{{ url('fresh-empanelment') }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover order-list" id="myTable">
                                        <thead>
                                            <tr>
                                            <th scope="col" >RO Code</th>
                                            <th scope="col" >Amount(in INR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($rolist as $key=>$result)
                                        
                                            <tr>
                                                <td>{{$result->RoCode}} </td>
                                                @php $number = round($result->Amount); @endphp
                                                <td>@if(round($result->Amount) && round($result->Amount)!=0) 
                                                {{moneyFormatIndia($number)}}
                                                @else
                                                N/A
                                                @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr style="text-align: center; color: red;"><td colspan="4" >No Data</td></tr>
                                        @endforelse
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-auto">
                                <!-- <a href="{{url('/release-order-list')}}"><i class="fa fa-print fa-2x text-gray-300"></i></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" class="text-gray-800">
                <div class="card c5 shadow h-100 py-2 ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c5-txt text mb-1 module-name" >Payment Released Today</div>
                                <div class="text-xs font-weight-bold mb-1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover order-list" id="myTable">
                                        <thead>
                                            <tr>
                                            <th scope="col" >RO Code</th>
                                            <th scope="col" >Amount(in INR)</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($payment_today as $key=>$pay)
                                        
                                            <tr>
                                                <td>{{$pay->RoCode}} </td>
                                                @php $number = round($pay->Amount); @endphp
                                                <td>@if(round($pay->Amount) && round($pay->Amount)!=0) 
                                                {{moneyFormatIndia($number)}}
                                                @else
                                                N/A
                                                @endif
                                           
                                            </tr>
                                        @empty
                                            <tr style="text-align: center; color: red;"><td colspan="4" >No Data</td></tr>
                                        @endforelse
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ url('/bills/0')}}" class="text-gray-800">
                <div class="card c6 shadow h-100 py-2 ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c6-txt text mb-1 module-name" >Bills to be Submitted Online</div>
                                <div class="text-xs font-weight-bold mb-1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover order-list" id="myTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" >Control No</th>
                                                <th scope="col" >RO Code</th>
                                                <th scope="col" >Published On</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($bill_online as $key=>$res)
                                        
                                            <tr>
                                                <td>{{$res->ReferenceNo !='' ? $res->ReferenceNo : 'NA'}} </td>
                                                <td>{{$res->{'RO No_'} }} </td>
                                                <td>{{date('d/m/Y', strtotime($res->{'Publishing Date'}))}}</td>
                                                
                                            </tr>
                                        @empty
                                            <tr style="text-align: center; color: red;"><td colspan="4" >No Data</td></tr>
                                        @endforelse
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ url('/bills/1')}}" class="text-gray-800">
                <div class="card c7 shadow h-100 py-2 ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c7-txt text mb-1 module-name" >Bills to be Submitted Physical</div>
                                <div class="text-xs font-weight-bold mb-1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover order-list" id="myTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" >Control No</th>
                                                <th scope="col" >RO Code</th>
                                                <th scope="col" >Published On</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($bill_physical as $key=>$bill)
                                        
                                            <tr>
                                                <td>{{$bill->ReferenceNo !='' ? $bill->ReferenceNo : 'NA'}} </td>
                                                <td>{{$bill->{'RO No_'} }} </td>
                                                <td>{{date('d/m/Y', strtotime($bill->{'Publishing Date'}))}}</td>
                                                
                                            </tr>
                                        @empty
                                            <tr style="text-align: center; color: red;"><td colspan="4" >No Data</td></tr>
                                        @endforelse
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
       
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{url('/dailycompliance')}}" class="text-gray-800">
                <div class="card c2 shadow h-100 py-2 ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c2-txt text mb-1 module-name" >Total Unpaid Bills</div>
                                <div class="text-xs font-weight-bold mb-1">
                                   <h5>Bills - {{ $unpaid_bills}}<h5>
                                   @php $amount = round($unpaid_bills_amount); @endphp
                                   <h5>@if(round($unpaid_bills_amount) && round($unpaid_bills_amount)!=0) 
                                    Amount - Rs. {{moneyFormatIndia($amount)}}
                                    @else
                                    N/A
                                    @endif
                                   <h5>
                                </div>
                                
                                
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{url('/account-detail')}}" class="text-gray-800">
                <div class="card c3 shadow h-100 py-2 ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c3-txt text mb-1 module-name" >Bank A/C Details</div>
                                <div class="text-xs font-weight-bold mb-1">
                                Bank Account No. - {{ @$account_detail['Bank Account No_'] !='' ? $account_detail['Bank Account No_'] : 'NA'}} <br/>
                                Account Holder Name - {{ @$account_detail['Account Holder Name'] !='' ? $account_detail['Account Holder Name'] : 'NA' }}<br/>
                                PAN Number - {{ @$account_detail['PAN'] !='' ? $account_detail['PAN'] : 'NA' }}<br/>
                                GST - {{ Session('Gst') != '' ? Session('Gst') : 'NA' }}<br/>
                                Email - {{ Session('email') ?? 'NA' }}<br/>
                                Mobile - {{ Session('Mobile') ?? 'NA'}}
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
    
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('fresh-empanelment') }}">
                <div class="card c4 shadow h-100 py-2 hvr-pop">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c4-txt text-uppercase mb-1 module-name" onclick="return noEmpanelment({{ Session::get('UserName') }})">Fresh Empanelment</div>
                                <div class="text-xs font-weight-bold mb-1">
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-print fa-2x text-gray-300" onclick="return noEmpanelment({{ Session::get('UserName') }})"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>  -->
        <!-- <div class="col-xl-3 col-md-6 mb-4 pt-4">
            <a class="text-gray-800" href="{{ url('print-renewal') }}">
                <div class="card c5 shadow h-100 py-2 hvr-pop">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c5-txt text-uppercase mb-1 module-name"> Renewal</div>
                                <div class="text-xs font-weight-bold mb-1">
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-print fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div> -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="#">
                <div class="card c4 shadow h-100 py-2 hvr-pop">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c4-txt text-uppercase mb-1 module-name">Total Pendency With BOC</div>
                                <div class="text-xs font-weight-bold mb-1"> {{$price}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-inr fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div> -->
        @elseif(Session::get('WingType')==1)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('personal-list') }}">
            <div class="card c6 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c6-txt text-uppercase mb-1 module-name"> Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('personal-list') }}"> <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('personal-renewal') }}">
            <div class="card c7 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c7-txt text-uppercase mb-1 module-name"> Renewal Personal Media</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('personal-renewal') }}"> <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
         @elseif(Session::get('WingType')==2)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('rate-settlement-private-media') }}">
            <div class="card c8 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c8-txt text-uppercase mb-1 module-name"> Private Media Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('rate-settlement-private-media') }}"><i class="fa fa-user-plus" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-tv fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
         @elseif(Session::get('WingType')==0)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('outdoor-media-list') }}">
            <div class="card c9 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c9-txt text-uppercase mb-1 module-name"> Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('outdoor-media-list') }}"><i class="fa fa-user-plus" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        @elseif(Session::get('WingType')==5)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('fm-radio-station') }}">
            <div class="card c10 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="text-gray-800" href="{{ url('fm-radio-station') }}">
                            <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name"> Private FM Fresh Empanelment</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </a>
        </div>
         @elseif(Session::get('WingType')==4)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('form-type') }}">
            <div class="card c25 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                             <a class="text-gray-800" href="{{ url('form-type') }}">
                            <div class="text-xs font-weight-bold c25-txt text-uppercase mb-1 module-name"> AV-TV Fresh Empanelment</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                         </a>
                    </div>
                </div>
            </div>
        </a>
        </div>
         @elseif(Session::get('WingType')==7)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('audio') }}">
            <div class="card c15 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="text-gray-800" href="{{ url('audio') }}">
                            <div class="text-xs font-weight-bold c15-txt text-uppercase mb-1 module-name"> AV Producer Fresh Empanelment</div>
                           </div>
                         <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
        </a>
        </div>

   <!--      <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('#') }}">
            <div class="card c18 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c18-txt text-uppercase mb-1 module-name"> AV Producers Billing</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <a class="text-gray-800" href="{{ url('#') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div> -->
        @elseif(Session::get('WingType')==8)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('digital-cinema') }}">
            <div class="card c17 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <a class="text-gray-800" href="{{ url('digital-cinema') }}">
                            <div class="text-xs font-weight-bold c25-txt text-uppercase mb-1 module-name"> Digital Cinema Fresh Empanelment</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                         </a>
                    </div>
                </div>
            </div>
        </a>
        </div>

        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('#') }}">
            <div class="card c18 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c18-txt text-uppercase mb-1 module-name"> Digital Cinema Billing</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <a class="text-gray-800" href="{{ url('#') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div> -->

        @elseif(Session::get('WingType')==9)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('internet-website') }}">
            <div class="card c17 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <a class="text-gray-800" href="{{ url('internet-website') }}">
                            <div class="text-xs font-weight-bold c25-txt text-uppercase mb-1 module-name"> Internet Website Fresh Empanelment</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                         </a>
                    </div>
                </div>
            </div>
        </a>
        </div>
<!--
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('#') }}">
            <div class="card c18 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c18-txt text-uppercase mb-1 module-name"> Internet Website Billing</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <a class="text-gray-800" href="{{ url('#') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div> -->

        @elseif(Session::get('WingType') == 10)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('bulk-sms') }}">
            <div class="card c17 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <a class="text-gray-800" href="{{ url('bulk-sms') }}">
                            <div class="text-xs font-weight-bold c25-txt text-uppercase mb-1 module-name"> Bulk SMS Fresh Empanelment</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                         </a>
                    </div>
                </div>
            </div>
        </a>
        </div>

        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('#') }}">
            <div class="card c18 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c18-txt text-uppercase mb-1 module-name"> Bulk SmS Billing</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <a class="text-gray-800" href="{{ url('#') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div> -->
        @endif
        @endif
        
        <!-- ROB START -->
        @if(Session::get('UserType')==2)

                    <!-- FORM TYPE Section -->
                    <!-- rob-form-one -->
                    <!-- <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('rob-form-type') }}">
                        <div class="card c11 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">Add ROB's Activity</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div> -->

                    <!--  FOR ROB PRE LIST -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('preroblist') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">ROB TTP Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                           
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <!-- ROB POST ACTIVITY LIST ON ROB DASHBOARD-->
                    <!-- <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('roblist') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">ROB Post Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div> -->
                    
                    <!--  FOB POST ACTIVITY LIST ON ROB DASHBOARD -->
                    <!-- <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('rob-fob-list') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB Post Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div> -->


                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('rob-show-fob-pre-data') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB TTP Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>


                    

                <!-- <iframe width="1100" height="612" src="https://app.powerbi.com/view?r=eyJrIjoiYzVjODAwYmMtMzU3Ny00ZTU0LTk0ZjEtMWE5NzllZmJkNTQyIiwidCI6Ijg5OTIxMGU2LTlmNTYtNDkyMS1hNTIxLWJiZjhlNzlmOWM5ZCJ9&pageName=ReportSection72cf48f87b9072510c20" frameborder="0" allowFullScreen="true"></iframe> -->
                    @endif


                    @if(Session::get('UserType')==3)
                    <!-- FOB POST FORM LIST -->
                    <!-- <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('fob-list') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB's Post Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div> -->


                    <!--  FOR FOB PRE LIST -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('preroblist') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB's TTP Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    
                    <!-- POST FORM LINK ON DASHBOARD -->
                    <!--  rob-form-type -->
                    <!-- <div class="col-xl-3 col-md-6 mb-4"> 
                        <a class="text-gray-800" href="{{ url('rob-form-one') }}">
                        <div class="card c11 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c11-txt text-uppercase mb-1 module-name">Add FOB's Activity</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                  </div> -->
                  <!--  rob-form-type -->
                  <!-- <div class="col-xl-3 col-md-6 mb-4"> 
                        <a class="text-gray-800" href="{{ url('rob-form-type') }}">
                        <div class="card c11 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c11-txt text-uppercase mb-1 module-name">Add FOB's Activity</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                  </div> -->
                @endif



                @if(Session::get('UserType')==7)
                <div class="col-xl-3 col-md-6 mb-4">
                    <a class="text-gray-800" href="{{ url('all-ro-list') }}">
                    <div class="card c1 shadow h-100 py-2 hvr-pop">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold c1-txt  mb-1 module-name">RO's  List</div>
                                    <div class="text-xs font-weight-bold mb-1">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                @endif
        

    </div><!-- end row-->

    @endsection
   @section('custom_js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function noEmpanelment(val) {
            if (val) {
                swal(" ", "You Have Already Empaneled!", "info");
                return false;
            }
        }

        
    </script>
    @endsection
