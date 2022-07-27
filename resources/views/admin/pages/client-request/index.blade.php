@extends('admin.layouts.layout')
<style>
  body{
    color: #6c757d !important;
  }
  .ui-datepicker-trigger{
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
  .table-bordered td, .table-bordered th {
    font-size: 12px !important;
    padding: 10px 7px !important;
  }
</style>

@section('content')
@php 
$results=isset($response)? $response:'';
//Convert Indian formats
function IND_money_format($num){
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
      
        if($i==0)
        {
            $explrestunits .= (int)$expunit[$i].","; 
        }else{
            $explrestunits .= $expunit[$i].",";
        }
    }
    $thecash = $explrestunits.$lastthree;
} else {
    $thecash = $num;
}
return "$thecash";

}


@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
      <h6 class="m-0">
        <i class="fa fa-user"></i>  Media Request
      </h6> <br>
      <!--  <a href="{{url('clientRequestPDF/'.Session::get('UserID') )}}" class="m-0 font-weight-normal text-primary"> <i class="fa fa-download"></i> Download Media Request</a><br> -->
      <a style="font-size: 14px;" class="m-0 text-primary" href="{{route('client-submission-form')}}"  id="addnew" /> 
      <i class="fa fa-user-plus"></i> Add New Request </a>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="card-body p-2">
        <form name ="wingsTypesearch" id="wingsTypesearch" method="GET" enctype="multipart/form-data" action="{{Route('client-submission-list')}}" >
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label">Media Category</label>
                <select name="wingType" id="wingType" class="form-control form-control-sm">
                  <!-- <option value=""> Select Wing Type</option> -->
                  <option value="1" {{ @$wingType == "1" ? "selected" :""}}>Print</option>
                  <option value="2" {{ @$wingType == "2" ? "selected" :""}}>Outdoor</option>
                  <option value="3" {{ @$wingType == "3" ? "selected" :""}}>AV-TV</option>
                  <option value="4" {{ @$wingType == "4" ? "selected" :""}}>AV-Radio</option>
                  
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="form-control-label">From Date</label>
                <input  type="text" value="{{@$fromdate && @$fromdate!='01/01/1970' ? @$fromdate: ''}}" class="form-control form-control-sm"
                name="from_date" id="from_date" placeholder="DD/MM/YYYY" autocomplete="off">          
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-control-label">To Date</label>
                <input  type="text" value="{{@$todate && @$todate!='01/01/1970' ? @$todate:''}}"  class="form-control form-control-sm" name="to_date" id="to_date" placeholder="DD/MM/YYYY" autocomplete="off">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label">Media Plan Status</label>
                <select name="mpstatus" id="mpstatus" class="form-control form-control-sm">
                  <option value="" selected>All</option>
                  <option value="0" {{ @$mpstatus == "0" ? "selected" :""}}>Media Plan Pending</option>
                  <option value="1" {{ @$mpstatus == "1" ? "selected" :""}}>Under Approval</option>
                  <option value="2" {{ @$mpstatus == "2" ? "selected" :""}}>Approved</option>
                  <option value="3" {{ @$mpstatus == "3" ? "selected" :""}}>Rejected</option> 
                  <option value="4" {{ @$mpstatus == "4" ? "selected" :""}}>Forwarded</option> 
                  <option value="5" {{ @$mpstatus == "5" ? "selected" :""}}>RO Created</option>
                  <option value="6" {{ @$mpstatus == "6" ? "selected" :""}}>Rolled Back</option> 

                  <option value="7" {{ @$mpstatus == "7" ? "selected" :""}}>At Nodal Officer</option> 
                  <option value="8" {{ @$mpstatus == "8" ? "selected" :""}}>At Media Plan</option> 
                  <option value="9" {{ @$mpstatus == "9" ? "selected" :""}}>Plan Created</option> 
                  <option value="10" {{ @$mpstatus == "10" ? "selected" :""}}>Plan Selected</option>
                  <option value="11" {{ @$mpstatus == "11" ? "selected" :""}}>Client Request Pending</option> 
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="form-control-label">&nbsp;</label>
                <input type="submit" value="Search" class="btn btn-block btn-primary btn-sm" >
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="form-control-label">&nbsp;</label>
                <!-- <button class="btn btn-primary" id="reset" onclick="resetFunction()">Reset</button> -->
                <input name="submitreset"  id="submitreset" type="submit" value="Reset" class="btn btn-block btn-primary btn-sm" >
              </div>
            </div>

          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover order-list" id="myTable">   
            <thead>
              <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Creative</th>
                <th scope="col">Media Request</th>
                @if($wingType_text=='Print')
                <th scope="col">Color Type</th>
               
                @endif
                 <th scope="col">Budget</th>
                <th scope="col">From Date</th>
                <th scope="col">To Date</th>
                <th scope="col">Status</th>
                <th scope="col">Display Key</th>
                <th scope="col">Media Plan Generated</th>  
              </tr>
            </thead>
            <tbody>
              @forelse($results as $key=>$result) 
              <tr>
                <td>{{$results->firstItem() + $key}}</td>
                <td><a class="m-0 font-weight-normal text-primary" href="{{ url('/uploads') }}/client-request/{{ @$result->creativefname }}" target="_blank"  class="editMember" title="Media Creative View" ><img src="{{ url('/uploads') }}/client-request/{{ @$result->creativefname }}" width="50px" height="50px"></a></a></td>

                <td><a class="m-0 font-weight-normal text-primary" href="{{url('clientview/'.$result->CRHID)}}"  class="editMember" title="Media Request View" >{{ @$result->ClientRequestNo? @$result->ClientRequestNo:'NA' }}</a></td>
                @if($wingType_text=='Print')
                <td>{{$result->colorType ? $result->colorType:'NA'}}</td>
                
                @endif
                <td>{{$result->budgetAmount? IND_money_format($result->budgetAmount) :0}}</td>
                <td>{{ date('d/m/Y', strtotime($result->FromDate))? date('d/m/Y', strtotime($result->FromDate)):'NA' }} </td>
                <td>{{ date('d/m/Y', strtotime($result->ToDate)) ? date('d/m/Y', strtotime($result->ToDate)):'NA' }} </td>
                @if($result->MPStatus =="0" && @$mpstatus<="6")
                <td> {{ 'Media Plan Pending' }} </td>
                @elseif($result->MPStatus =="1" && @$mpstatus<="6")
                <td> {{ 'Under Approval' }}  </td>
                @elseif($result->MPStatus =="2" && @$mpstatus<="6")
                <td> {{ 'Approved By CBC' }} </td>
                @elseif($result->MPStatus =="3" && @$mpstatus<="6")
                <td> {{ 'Rejected' }} </td>
                @elseif($result->MPStatus =="4" && @$mpstatus<="6")
                <td> {{ 'Forwarded' }} </td>
                @elseif($result->MPStatus =="5" && @$mpstatus<="6")
                <td> {{ 'RO Created' }} </td>
                @elseif($result->MPStatus =="6" && @$mpstatus<="6")
                <td> {{ 'Rolled Back' }} </td>
                @elseif(@$result->CLStatus=="0" && @$mpstatus>"6" )
                <td> {{ 'Client Request Pending' }} </td>
                @elseif(@$result->CLStatus =="1" && @$mpstatus>"6")
                <td> {{ 'At NO' }} </td>
                @elseif(@$result->CLStatus =="2" && @$mpstatus>"6")
                <td> {{ 'At MP' }} </td>
                @elseif(@$result->CLStatus =="3" && @$mpstatus>"6")
                <td> {{ 'Plan Created' }} </td>
                @elseif(@$result->CLStatus =="4" && @$mpstatus>"6")
                <td> {{ 'Plan Selected' }} </td>
                @else
                <td> {{ 'NA' }} </td>
                @endif


                <td>{{@$result->MPNO ? @$result->MPNO:'NA' }}  </td>
                @if($wingType==1 && @isset($result->MPNO))
                <td><a class="m-0 font-weight-normal text-primary" href="{{url('media-plan-view/'.$result->MPNO.'/'.$result->{'MPVersion'}  )}}"  style="font-size:15px;"   class="editMember" ><img src="{{asset('img/view22X22.png')}}" title="MP View" border="0" /></a> </td>
                @elseif($wingType=="2" &&  @isset($result->MPNO))
                <td><a class="m-0 font-weight-normal text-primary" href="{{route('ODMediaPlan.show', $result->MPNO )}}"  style="font-size:15px;"   class="editMember" ><img src="{{asset('img/view22X22.png')}}" title="MP View" border="0" /></a> </td>
                @elseif($wingType=="3" && @isset($result->MPNO))
                <td><a class="m-0 font-weight-normal text-primary" href="{{route('tvMediaPlan.show', $result->{'MPNO'} )}}"  style="font-size:15px;"   class="editMember" ><img src="{{asset('img/view22X22.png')}}" title="MP View" border="0" /></a> </td>
                @elseif($wingType=="4"&&  @isset($result->MPNO))
                <td><a class="m-0 font-weight-normal text-primary" href="{{route('radioMediaPlan.show', str_replace("FM/","FM",$result->{'MPNO'}) )}}"  style="font-size:15px;"   class="editMember" ><img src="{{asset('img/view22X22.png')}}" title="MP View" border="0" /></a> </td>
                @else
                <td>NA</td>
                @endif

              </tr>
              @empty
              <tr style="text-align: center; color: red;"><td colspan="15" >No Data</td></tr>
              @endforelse

            </tbody>
          </table>
        </div>
        <div class="d-block" style="width:100%; float: left;">
          <span class="float-right"> 
            {{$results->withQueryString()->links('pagination::bootstrap-4')}}
          </span> 
        </div>
      </div>
    </div>
  </div>

  @endsection
  @section('custom_js')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
      $( "#from_date" ).datepicker( "option", $.datepicker.regional[ 'fr' ] );
      $( "#to_date" ).datepicker( "option", $.datepicker.regional[ 'fr' ] );
      var CURL = {!! json_encode(url('/')) !!};
      var dateFormat = "dd/mm/yy",
      from = $( "#from_date" )
      .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      //inline: true,
      //showOtherMonths: true,
     dateFormat: 'dd/mm/yy',
      //dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

    })
      .on( "change", function() {
        to.datepicker( "option", "minDate", getDate( this ) );
      }),
      to = $( "#to_date" ).datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd/mm/yy',

    })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });

      

      function getDate(element) {
        var date = null;

        try {
          date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
          date = null;
        }

        return date;
      }

      function onSelect(dateText, inst) {
        var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#from_date").val());
        var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#to_date").val());
        var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

        if (!date1 || date2) {
          $("#from_date").val(dateText);
          $("#to_date").val("");
          $(this).datepicker();
        } else if (selectedDate < date1) {
          $("#to_date").val($("#from_date").val());
          $("#from_date").val(dateText);
          $(this).datepicker();
        } else {
          $("#to_date").val(dateText);
          $(this).datepicker();
        }
      }

      $('#from_date').click(function() {
        $('#from_date').datepicker("show");
      });
      $('#to_date').click(function() {
        $('#to_date').datepicker("show");
      });
    } );
  </script>

  @endsection