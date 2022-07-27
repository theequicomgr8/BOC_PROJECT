@extends('admin.layouts.layout')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('arogi/css/rob_style.css')}}">

<style>
  body{
    color: #6c757d !important;
    p,
    label {
      font: 1rem 'Fira Sans', sans-serif;
    }

    input {
      margin: .4rem;
    }
  }
  .multiselect-search{
    width:100% !important;
    margin-right: 10px;
  }
  .dropdown-menu.show {
    display: block;
    width: 100% !important;
  }
  .multiselect-clear-filter{
    display: none !important;
  }
  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }
  a.disabled {
    pointer-events: none;
  }
  .ui-datepicker-trigger{
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
  .borderless table {
    border-top-style: none;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
}


// For Location

   /* Core CSS */

  .jls-address-preview--hidden,
  .jls-address-lookup--hidden,
  .jls-manual-address--hidden {
    display: none;
  }

  .jls-manual-address {
    border: 0;
    padding: 0;
    margin: 0;
  }
  .jls-field-wrapper textarea {
    width: 100%;
    padding: 20px;
    background-color: #fff;
    border-radius: 4px;
    border: 2px solid #ced6e0;
    box-shadow: 0 2px 4px rgba(0,0,0,.1);
    margin-top: 10px;
    margin-bottom: 10px;
  }

  /* Custom Google Popout CSS */
  .pac-container {
    margin-top: 10px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0,0,0,.2);
  }

  .pac-item {
    padding: 10px;
  }

  .pac-item:hover {
    background-color: #1e90ff;
    color: rgba(255,255,255,.7)
  }

  .pac-item:hover .pac-item-query {
    color: #fff;
  }

  .pac-icon-marker {
    display: none;
  }

  .pac-item:first-child {
    border-top: 0;
  }

  .pac-logo:after {
    background-color: #f7f7f7;
      padding: 10px;
      height: 40px;
      background-position: calc(100% - 10px);
    border-top: solid 1px rgba(0,0,0,.1);
  }

  .blink_me {
  animation: blinker 3s linear infinite;
  color: red;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}



</style>
<style type="text/css">
  .multiselect-container>li>a>label {
  padding: 4px 20px 3px 20px;
}
</style>
@section('content')
<!-- !empty(@$data->document_type) -->
<!-- if(trim(@$data->document_type) !='') -->
<!-- if(@$rob_documents[0]->event_date!='') -->
@php

//dd(@$data);
if(@$data->status=='1' || @$data->status=='2')
{
  $block='readonly';
  $non='none';
  $tab='-1';
  $click='preventLeftClick';
}
else
{
  $block='';
  $non='';
  $tab='';
  $click='';
}
$mouse='';

$user_ype=Session::get('UserType');
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> TTP Information</h6>
      <h6 class="m-0 text-primary" style="display:{{$download_display;}}"><a href="{{url('pre-form-pdf/'.@$data->Pk_id)}}"><i class="fa fa-edit"></i> TTP receipt download</a></h6>
    </div>
    <!-- Card Body -->
    <div class="row">
        <div class="col-xl-12">
          <h6 class="alert alert-success" style="width: 100%;display: none; text-align: center;" id="msg"></h6>
        </div>
      </div>
    <div class="card-body">

     <div  style ="display: none;"align="center" class="alert alert-success"></div>
     <div style ="display: none;" align="center" class="alert alert-danger"></div>
     <form method="POST" class="client_request"  id="rob_request" enctype="multipart/form-data" >
      @csrf

      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item active show" data-target="#logins-part">
          <a class="nav-link " aria-controls="logins-part" id="logins-part-trigger">Activity / Program</a>
        </li>
      </ul>

      <div class="tab-content">
        <div id="logins-part" class="tab-pane active show">
          <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
            @include('rob.include.pre_form')
          @if(@$data->sop_theme=='')
          <input type="hidden" name="get_id" id="get_id" value="0">
          @else
          <input type="hidden" name="url_id" value="{{@$data->Pk_id ?? ''}}">
          <input type="hidden" name="get_id" id="get_id" value="1">
          @endif
          <div class="row">
            <div class="col-sm-12 text-right">
               <input type="hidden" id="next_tab_1">
               @if(@$data->status=='1' || @$data->status=='2')
               {{-- <a class="btn btn-primary client-next-button btn-sm m-0" >Save <i class="fa fa-caret-right"></i></a> --}}
               @else
               <a class="btn btn-primary client-next-button btn-sm m-0" id="tab_1">Save <i class="fa fa-caret-right"></i></a>
               @endif


              <!-- <input type="hidden" name="fetch_id" value="{{@$data->Pk_id}}"> -->
              <!-- <a class="btn btn-primary client-next-button btn-sm m-0"   id="tab_1">Next1 <i class="fa fa-caret-right"></i></a> -->

            </div>
          </div>
        </div>  <!-- tab-pane close -->



       </div> <!-- tab-content close -->
     </form>
   </div>  <!-- card-body close -->
 </div>  <!-- card shadow close -->
</div>   <!-- content-inside close -->
@endsection
@section('custom_js')
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/arogi/js') }}/pre_rob_form.js"></script>
<script src="{{asset('arogi/js/pre_custom.js')}}" type="text/javascript"></script>
<script src="{{ url('/arogi/js') }}/location.js"></script>
<script src="{{asset('arogi/js/multiple_selection.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/common.js')}}" type="text/javascript"></script>


<script>

$(document).ready(function(){
    var i=1;
    $("#Button1").click(function(e){
        e.preventDefault();
        i++;
        $("#FileUploadContainer").append('<tr id="row'+i+'"><td>File : <input type="file"  name="document_name[]" id="pic" class="form-control form-control-sm" style="width: 336px;"></td><td> Caption Name: <input type="text" name="caption_name[]" id="caption_name" class="form-control form-control-sm" style="width: 334px;margin-left: -10px;"></td><td><br><input type="checkbox" name="show_website[]" id="show_website" value="1"> Show On Website</td><td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td></tr>'+"<br><br>");
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });

    //for day count
      $("#txt_to").blur(function() {
        var start = $("#txt_from").val();
        var end = $("#txt_to").val();
        var days = (Date.parse(end) - Date.parse(start)) / 86400000+1;
        $("#txt_tot_prog_day").attr('value', days);
      });

      $("#txt_from").blur(function(){
        $("#txt_tot_prog_day").attr("value",'');

        var $el = $('#txt_to');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();

      });
});



$(document).ready(function(){
    var i=1;
    $("#press").click(function(e){
        e.preventDefault();
        i++;
        $("#PressUploadContainer").append('<tr id="row'+i+'"><td>File : <input type="file"  name="press_document_name[]" id="press_pic" class="form-control form-control-sm" style="width: 336px;"></td><td> Caption Name: <input type="text" name="press_caption_name[]" id="press_caption_name" class="form-control form-control-sm" style="width: 334px;margin-left: -10px;"></td><td><br><input type="checkbox" name="press_show_website[]" id="press_show_website" value="1"> Show On Website</td><td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td></tr>'+"<br><br>");
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });

    //for day count
      // $("#txt_to").blur(function() {
      //   var start = $("#txt_from").val();
      //   var end = $("#txt_to").val();
      //   var days = (Date.parse(end) - Date.parse(start)) / 86400000+1;
      //   $("#txt_tot_prog_day").attr('value', days);
      // });

      // $("#txt_from").blur(function(){
      //   $("#txt_tot_prog_day").attr("value",'');

      //   var $el = $('#txt_to');
      //   $el.wrap('<form>').closest('form').get(0).reset();
      //   $el.unwrap();

      // });
});




function nextSaveData(tab='') {
    // console.log(tab);
   // e.preventDefault();
   if(tab=='next_tab_1'){
    $('#next_tab_1').val(tab);

  }
  if(tab =='submit_btn')
  {
      /*var value=$('#multi_langauge_select').val();
      console.log('value',value);
      return false;*/

      $('#next_tab_2').val(tab);

    }



  }







</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
function nextSaveData(id){

}
nextSaveData();

</script>
<style type="text/css">
  .multiselect-container {
    overflow-x:scroll;
    height: 400px;
  }
  .multiselect-container>li>a>label {
    height: auto;
  }
</style>
<script type="text/javascript">
  function alphadash(event) {
    var inputValue = event.charCode;
    if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0) && (inputValue!=45)){
      event.preventDefault();
    }
  }


  $(document).ready(function() {
        $('.preventLeftClick').on('click', function(e) {
            e.preventDefault();
            return false;
        });
    });
</script>
@endsection
