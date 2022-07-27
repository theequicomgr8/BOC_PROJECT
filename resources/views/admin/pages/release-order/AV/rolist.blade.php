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
</style>
@php
    if(Session::get('WingType')==4)
        {
          $wing_name = 'AV-TV';
        }
        else if(Session::get('WingType')==5)
        {
            $wing_name = 'AV-Radio';
        }
        else if(Session::get('WingType')==7)
        {
          $wing_name = 'AV-Producers';
        }
@endphp
@section('content')
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-normal text-primary"><i class="fa fa-edit" aria-hidden="true"></i>{{$wing_name}} RO cum Bill</h6>
      <div class="col-sm">
            @if(Session::has('UserID'))
                @if(Session::get('WingType') == 4)
                    <a href="{{ url('avPDF/'.Session::get('UserName')) }}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download AV TV</a>
                @endif
                @if(Session::get('WingType') == 5)
                <a href="{{ url('avPDF/'.Session::get('UserName')) }}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download AV Radio</a>
                @endif
                @if(Session::get('WingType') == 7)
                <a href="{{ url('avPDF/'.Session::get('UserName')) }}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download AV Producer</a>
                @endif
            @endif
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
       <div class="card-body p-2">
          <form name ="rosearch" id="rosearch" method="GET" enctype="multipart/form-data" action="{{Route('AVRO.index')}}" >
            <div class="row">
              @if(Session::has('UserName') && Session('UserName') == '')
            <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label">Agency Code</label>
                    <input  type="text" class="form-control form-control-sm"
                   name="agency_code" id="agency_code" placeholder="" >
                </div>
              </div>
              @endif
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label">Published From</label>
                    <input  type="text" class="form-control form-control-sm"
                   name="from_date" id="from_date" placeholder="DD/MM/YYYY" >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label">Published To</label>
                  <input  type="text"  class="form-control form-control-sm" name="to_date" id="to_date" placeholder="DD/MM/YYYY">
                </div>
              </div>
               <div class="col-md-2">
                <div class="form-group">
                  <label class="form-control-label">&nbsp;</label>
                  <input type="submit" class="btn btn-block btn-primary btn-sm" >
                </div>
              </div>
            </div>
         </form>
     </div>
   <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover order-list" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col">Creative Image</th>
          <th scope="col">Agency Code</th>
          <th scope="col">RO Code</th>
          <th scope="col">Display Key</th>
          <th scope="col">Publish On</th>
          <th scope="col">Not After</th>
          <th scope="col" style="width: 90px;">Action</th>
        </tr>
      </thead>
      <tbody>
      @forelse($response as $key=>$result)
       <tr>
        <td>{{$response->firstItem() + $key}}</td>
        <td>
          @if($result->{'Creative File Name'} == "")
            NA
          @else
            <a href="{{asset('uploads/client-request/'.$result->{'Creative File Name'})}}" download title="Please click on the image to download"><img src="{{asset('uploads/client-request/'.$result->{'Creative File Name'})}}" width="50px" height="50px"></a>
          @endif
          </td>
        <td>{{$result->agencyCode}}</td>
        <td>{{$result->RoCode}} </td>
        <td>{{$result->RoCode}} </td>
        <td>{{ date('d/m/Y', strtotime($result->PublishDate)) }} </td>
        <td>{{ date('d/m/Y', strtotime($result->PublishDate)) }} </td>
        <?php
              $current_url = url()->current();
              if(strpos($current_url,"192.168.10"))
              {
                $filebase_url = "http://192.168.10.60/BOC_FTP/RO/";
              }
              else
              {
                $filebase_url = "http://104.211.206.19/BOC_FTP/RO/";
              }
                $pdfFileName = $result->{'Pdf File Name'};
                $exp_pdf_path = explode("RO",$pdfFileName);
              if(count($exp_pdf_path) > 1)
              {
                $Ro_pdf_file = $filebase_url. ltrim($exp_pdf_path[1],'"\"');
              }
              else
              {
                $Ro_pdf_file = "";
              }
          ?>
          @if(!empty($Ro_pdf_file))
            <td align="center">
                  <a class="m-0 font-weight-normal text-primary" href="{{$Ro_pdf_file}}" target="_blank"  class="editMember" >
                  <img src="{{asset('img/view22X22.png')}}" border="0" /></a>
            </td>
          @else
            <td align="center">
                  <a class="m-0 font-weight-normal text-primary" href="{{$Ro_pdf_file}}" class="editMember" >
                  <img src="{{asset('img/view22X22.png')}}" border="0" /></a>
            </td>
          @endif
        </tr>
        @empty
              <tr style="text-align: center; color: red;"><td colspan="9" >No Data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-block" style="width:100%; float: left;">
    <span class="float-right">
      {{ count($response)> 0 ? $response->links('pagination::bootstrap-4') :''}}
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
    var CURL = {!! json_encode(url('/')) !!};
    var dateFormat = "mm/dd/yy",
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

    })
    .on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
    });

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    }
  } );
</script>
@endsection
