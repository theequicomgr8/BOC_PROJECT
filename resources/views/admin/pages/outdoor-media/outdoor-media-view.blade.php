@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
<style>
    .error {
        color: red;
        font-size: 14px;
    }

    input[type=radio] {
        width: 20px;
        height: 20px;
    }

    .table thead th {
        font-size: 13px;
        color: #444 !important;
    }

    .table td,
    .table th {
        padding: 0.45rem !important;
        font-size: 14px;
    }

    .fieldset-border {
        margin: 0 10px 15px 0px !important;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('content')
@php //dd(@$vendor_data[0]['Modification']); @endphp
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="text-primary"> Outdoor Media View</h6>
            
            <p><a href="{{url('solerightPDF/'.@$vendor_data[0]['OD Media ID'])}}" class="font-weight-normal text-primary"> <i class="fa fa-download"></i> Outdoor Application Receipt</a></p>
           
        </div>
      
        <!-- Card Body -->
        <div class="card-body">
            <div class="alert alert-success" id="show_msg" style="display: none;">
                <div align="center" class="alert alert-success text-primary" id="show_msg2"></div>
            </div>
            <div align="center" class="alert alert-danger" style="display: none;"></div>
            <!--  here form-->

            <div class="tab-content">
                <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
                    <!-- your steps content here -->
                    <div id="details_of_owner">
                        <input type="hidden" name="vendorcheck" value="{{@$vendorcheck}}">
                        @include('admin.pages.outdoor-media.common.media-address')
                        <form enctype="multipart/form-data" id="outdoor_media_form" autocomplete="off">
                            @csrf
                            @include('admin.pages.outdoor-media.common.authority-details')
                            @include('admin.pages.outdoor-media.common.work-done')
                            <fieldset class="fieldset-border">
                                <legend> Upload Document / दस्तावेज़ अपलोड करें</legend>
                                <div class="row">
                                @include('admin.pages.outdoor-media.common.upload-doc')
                                </div>
                            </fieldset>
                            <!--  file upload end -->

                            <!--  App section start -->
                            <fieldset class="fieldset-border">
                                
                                <legend> Submit Location Data</legend>
                                <div class="text-center">
                                    <table class="table" style="border: 1px solid gainsboro;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr.No.</th>
                                                <th scope="col">Location Name</th>
                                                <th scope="col">Long Image</th>
                                                <th scope="col">Close Image</th>
                                                <th scope="col">Latitude</th>
                                                <th scope="col">Longitude</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($OD_lat_data) > 0)
                                                @foreach($OD_lat_data as $key=>$latlongData)
                                                    <tr>
                                                        <td scope="row">{{ $key +1 }}</td>
                                                        <td>{{$latlongData['Location Name']}}</td>
                                                        <td>
                                                            @if($latlongData['Far Image File Name'] == '')
                                                                <span class="text-center">NA</span>
                                                            @else
                                                                <a href="https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/{{$latlongData['Far Image File Name']}}">
                                                                    <img src="https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/{{$latlongData['Far Image File Name']}}" style="width:50px;height: 50px;">
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($latlongData['Far Image File Name'] == '')
                                                                <span class="text-center">NA</span>
                                                            @else
                                                                <a href="https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/{{$latlongData['Image File Name']}}">
                                                                    <img src="https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/{{$latlongData['Image File Name']}}" style="width:50px;height: 50px;">
                                                                </a>
                                                            @endif
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
                                        </tbody>
                                    </table>
                                </div>
                            
                            </fieldset>
                            <!-- App section end -->
                        </form>
                    </div>
                </div>

                <input type="hidden" value="{{ @$vendor_data[0]['OD Media ID'] }}" name="EMP_OD_Media_ID">
                <a class="btn btn-primary btn-sm" style="float: right;" href="/outdoor-media-list"><i class="fa fa-caret-left"></i> Back </a>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
@endsection
@section('custom_js')
<script src="{{ url('/js/outdoorMediaJs') }}/location-validation.js"></script>
<script>
    $(document).on("click", ".view-location-modal", function() {
        var odmedia_id = $(this).attr("odmedia_id");
        var subcat = $(this).attr("subcatdata");
        var subcattxt = $(this).attr("subcattxt");
        var catval = $(this).attr("catval");
        $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'post',
      url: '/view-location-data',
      data: { subcat: subcat, odmedia_id: odmedia_id, subcattxt: subcattxt, cat: catval},
      success: function (location_data) {
        console.log(location_data);
        $("#view-model-location").html(location_data);
        $("#sub_cat_texttt").text(subcattxt);
      }
    });
    });
    $(document).ready(function() {
        // read only all form true
        $('form *').prop('disabled', true);
        $(".m-0").css("display", "none");
    });
    //view location details ajax call
</script>
@endsection