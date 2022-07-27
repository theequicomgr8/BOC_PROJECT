@php
$lineone =[];
$media_cat = array('0' => 'Airport', '1' => 'Railways', '2' => 'Road', '3' => 'Transit Media', '4' => 'Others', '5' => 'Metro', '6' => 'Bus & Bus Station');
$read1='';
$pointer1 = '';
$OD_media_address_data = !empty($OD_media_address_data) ? $OD_media_address_data : [1];
if(!empty($OD_media_address_data) && count($OD_media_address_data) > 1 && @$pointer ==''){
$read1='readonly';
$pointer1 = 'none';
}
$url = request()->segments();
if($url[0] == 'outdoor-media-empanelment' || $url[0] == 'outdoor-media-other-empanelment'){
if(empty($vendor_data) || @$vendor_data[0]['Modification'] == '0'){
$modification = 0;
}else{
$modification = 1;
}
}elseif($url[0] == 'outdoor-media-renewal'){

$modification = !empty($vendor_data) ? $vendor_data[0]['Modification'] : '';

}elseif($url[0] == 'outdoor-media-view'){
if(!empty($vendor_data) && @$vendor_data[0]['Modification'] == '1'){
$modification = 1;
}else{
$modification = 0;
}
}
$catText = '';

@endphp
@php //dd($media_cat); @endphp
@if(@$vendor_data[0]['Notarized Copy File Name'] == '' || @$vendor_data[0]['Notarized Copy File Name'] == null )
<fieldset class="fieldset-border">
    <legend> Media Details / मीडिया विवरण</legend>
    <div class="row" style="display: {{@$show}};">
        <div class="col-md-6">
            <h6>Do you want to upload through Excel? 
                <!-- <a href="{{asset('uploads/Master.xlsx')}}" target="_blank">Download Master File</a> -->
            </h6>
        </div>
        <div class="col-md-3">
            <input type="radio" name="xls" id="xlxyes" value="1" class="xls"> Yes &nbsp;
            <input type="radio" name="xls" id="xlxno" value="0" class="xls" checked="checked"> No
        </div>
    </div><br>

    <div class="row" id="choose_category" style="display: none;">
        <div class="col-md-4">
            <div class="form-group">
                <label for="Name">State / राज्य<font color="red">*</font>
                </label>
                <select id="stateid" name="MAState" class="form-control form-control-sm">
                    <option value="">Select State</option>
                    @if(count($states) > 0)
                    @foreach($states as $statesData)
                    <option value="{{ $statesData['Code'] }}">
                        {{$statesData['Description']}}
                    </option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Media Category / मीडिया श्रेणी <font color="red">*</font></label>
                <select name="mediacategory" class="form-control form-control-sm downloadclass" style="width: 100%;" id="mediacategory" data-val="mediasubcategory">
                    <option value="">Select Category</option>
                    <option value="0">Airport </option>
                    <option value="1">Railways</option>
                    <option value="2">Road </option>
                    <option value="3">Transit Media</option>                
                    <option value="5">Metro</option>
                    <option value="6">Bus & Bus Station</option>
                    <option value="4">Others</option>
                </select>
            </div>
        </div>

        <div class="col-md-4" id="subcategory2">
            <div class="form-group">
                <label>Media Sub-Category / मीडिया उप-श्रेणी <font color="red">*</font>
                </label>
                <select name="mediasubcategory[]" class="form-control-sm form-control mediasub" id="mediasubcategory" multiple data-eid="mediasubcategory">
                </select>
            </div>
        </div>
        <div class="col-md-4" id="xls_show">
            <input type="file" name="media_import" id="media_address_import" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
        </div>
        <div class="col-md-4" id="addqty_model" style="display: none; margin-top: 7px;">
            <h6><a href="#" id="add_qty_model" data-toggle="modal" data-target="#myModal">Add Quantity</a></h6>
        </div>
        <div class="col-md-4" id="viewexcel" style="display: none; margin-top: 7px;">
            <h6><a href="" id="downloadexcel" download="">Click Here to Download Media Details</a></h6>
        </div>
    </div>
    <!-- add 20 Apr end -->

    <!-- modal for add quantity -->
    <div class="container">
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 140%;">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Quantity</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <h6 id="addQty" align="center" style="color:#4d9b5e; display:none">Quantity added Successfully!</h6>
                        <div class="row" id="model-addqty"></div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer" style="display: block !important;">
                        <button type="button" class="btn btn-danger btn-sm m-0" data-dismiss="modal" style="float: left;">Close</button>
                        <button type="button" class="btn btn-primary btn-sm m-0" id="save_qty" style="float: right;">Save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- modal for add quantity -->
    <div id="media_address">

        @foreach($OD_media_address_data as $key => $OD_media_address)
        @if(($key - 1) >= 0)
        <hr id="hrline_{{$key}}">
        @endif
        <div class="row" id="media_empty">
            @if(@$key == 0)
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Name">State / राज्य<font color="red">*</font>
                    </label>
                    <p>
                        <select id="state_id_{{$key}}" name="MA_State[]" class="form-control form-control-sm empty call_district" data="dist_id_{{$key}}" cityid="MA_City{{$key}}" tabindex="{{$key}}">
                            <option value="">Select State</option>
                            @if(count($states) > 0)
                            @foreach($states as $statesData)
                            <option value="{{ $statesData['Code'] }}" {{@$OD_media_address['State'] == $statesData['Code'] ? 'selected' : ''}}>
                                {{$statesData['Description']}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </p>
                </div>
            </div>
            @endif
            {{-- <div class="col-md-4">
                <div class="form-group">
                    <label for="Name">District / ज़िला<font color="red">*</font>
                    </label>
                    <p>
                        <select id="dist_id_{{$key}}" name="MA_District[]" class="form-control form-control-sm empty" tabindex="{{$key}}">
            <option value="">Select District</option>
            @if(@$OD_media_address['District'])
            <option selected="selected">
                {{$OD_media_address['District']}}
            </option>
            @endif
            </select>
            </p>
        </div>
    </div> --}}
    {{-- <div class="col-md-4">
                <div class="form-group">
                    <label for="Name">City / नगर<font color="red">*</font></label>
                    <p>
                        <select name="MA_City[]" id="MA_City{{$key}}" class="form-control form-control-sm" tabindex="{{$key}}">
    <option value="">Select City</option>
    @if(@$OD_media_address['City'] != '')
    <option selected="selected">
        {{ ucfirst(strtolower($OD_media_address['City'])) }}
    </option>
    @endif
    </select>
    </p>
    </div>
    </div> --}}
    <div class="col-md-4">
        <div class="form-group">
            <label>Media Category / मीडिया श्रेणी <font color="red">*</font></label>
            <p>
                <select name="Applying_For_OD_Media_Type[]" class="form-control form-control-sm empty mediaclass" style="width: 100%; pointer-events: {{@$pointer1}};" id="applying_media_{{$key}}" data-val="showcategory_{{$key}}" tabindex="{{$key}}" {{$read1}}>
                    <option value="">Select Category</option>
                    <option value="0" {{ @$OD_media_address['OD Media Type']=='0' ? 'selected' : '' }}>Airport </option>
                    <option value="1" {{ @$OD_media_address['OD Media Type']=='1' ? 'selected' : '' }}>Railways</option>
                    <option value="2" {{ @$OD_media_address['OD Media Type']=='2' ? 'selected' : '' }}>Road </option>
                    <option value="3" {{ @$OD_media_address['OD Media Type']=='3' ? 'selected' : '' }}>Transit Media </option>
                    <option value="5" {{ @$OD_media_address['OD Media Type']=='5' ? 'selected' : '' }}>Metro</option>
                    <option value="6" {{ @$OD_media_address['OD Media Type']=='6' ? 'selected' : '' }}>Bus & Bus Station</option>
                    <option value="4" {{ @$OD_media_address['OD Media Type']=='4' ? 'selected' : '' }}>Others</option>
                </select>
            </p>
        </div>
    </div>

    <div class="col-md-4" id="subcategory">
        <div class="form-group">
            <label>Media Sub-Category / मीडिया उप-श्रेणी <font color="red">*</font>
            </label>
            <p>
                <select name="od_media_type[]" class="form-control-sm form-control empty subcategory dynemicsub_cat{{$key}} " id="showcategory_{{$key}}" data-eid="showcategory_{{$key}}" tabindex="{{$key}}" style=" pointer-events: {{@$pointer1}};" {{$read1}}>
                    <option value="">Select Sub-Category</option>
                    @if(@$OD_media_address['OD Media Type']!='')
                    @foreach($getcat as $cat)
                    @php
                    if(!empty($OD_subcategory_data) && (!in_array($cat->media_uid, $OD_subcategory_data)))
                    {
                        $selected = '';
                        if($OD_media_address['OD Media ID'] == $cat->media_uid){
                        $selected = 'selected';
                        $catText= $cat->name;
                        array_push($OD_subcategory_data,$cat->media_uid);
                    }
                    @endphp
                    <option value="{{$cat->media_uid}}" {{@$selected}}>
                        {{$cat->name}}
                    </option>
                    @php
                    }
                    @endphp
                    @endforeach
                    @endif
                </select>
            </p>
        </div>
    </div>
    <?php
    $trainarrdata = "OD029,OD030,OD084,OD108";
    $findcategory = @$OD_media_address['OD Media ID'] ?? '';
    $show_train = 'none';
    if ($findcategory != '') {
        if (strpos($trainarrdata, @$OD_media_address['OD Media ID']) !== false) {
            $show_train = 'block';
        }
    }
    ?>
    <input type="hidden" name="trainArr" id="trainArr" value="{{$trainarrdata}}">
    {{--
    <div class="col-md-4 train_no_{{$key}}" style="display: {{$show_train}};">
    <div class="form-group">
        <label for="Train_No">Train Number/Name / गाड़ी संख्या/नाम<font color="red"></font></label>
        <p>
            <input type="text" name="Train_Data[]" placeholder="Search By Train Number/Name" class="form-control form-control-sm traindata" id="Train_Data_{{$key}}" value="{{ @$OD_media_address['Train Number'] != '' && $OD_media_address['Train Number'] != 0 ?$OD_media_address['Train Number'] .' - '. $OD_media_address['Train Name'] : ''}}" tabindex="{{$key}}">
        </p>
    </div>
    </div> --}}

    <?php
    // $arrdata = "OD006,OD013,OD072,OD073,OD110,OD122,OD086,OD087,OD123,OD127";
    // $findcat = @$OD_media_address['OD Media ID'] ?? '';
    // $show_no_of_spots = 'none';
    // if ($findcat != '') {
    //     if (strpos($arrdata, @$OD_media_address['OD Media ID']) !== false) {
    //         $show_no_of_spots = 'block';
    //     }
    // }
    ?>
    {{-- <input type="hidden" name="noOfSpotsArr" id="noOfSpotsArr" value="{{$arrdata}}">
    <div class="col-md-4 no_of_spots_{{$key}}" style="display: {{$show_no_of_spots}};">
        <div class="form-group">
            <label for="year">No. of Spots / स्पॉट की संख्या<font color="red"></font></label>
            <p>
                <input type="text" name="No_of_Spots[]" placeholder="Enter No. of Spots" class="form-control form-control-sm" id="No_of_Spots_{{$key}}" onkeypress="return onlyNumberKey(event)" value="{{ @$OD_media_address['No Of Spot'] ? round(@$OD_media_address['No Of Spot'],2) : ''}}" tabindex="{{$key}}">
            </p>
        </div>
    </div> --}}
    <div class="col-md-4">
        <div class="form-group">
            <label for="year">Quantity/No. of Location / मात्रा/स्थान की संख्या<font color="red">*</font></label>
            <p>
                <input type="text" name="quantity[]" placeholder="Enter Quantity/No. of Location" class="form-control form-control-sm empty lat_media" id="quantity_{{$key}}" maxlength="4" onkeypress="return onlyNumberKey(event)" value="{{ @$OD_media_address['Quantity'] ? round(@$OD_media_address['Quantity'],2) : ''}}" tabindex="{{$key}}" style=" pointer-events: {{@$pointer1}};" {{$read1}}>
            </p>
        </div>
    </div>

    <?php
    $litStr = "Bus Panel,Hoarding,Digital Display,Train Inside,Train Outside";
    // $litArr = explode(",", $litStr);
    // $catstr = $catText ?? '';
    // $show_lit = 'none';
    // if ($catstr != '') {
    //     foreach ($litArr as $val) {
    //         if (strpos($catstr, $val) === false && @$OD_media_address['Illumination Type'] == '1') {
    //             $show_lit = 'block';
    //             break;
    //         }
    //     }
    // }

    ?>
    <input type="hidden" name="litArr" id="litArr" value="{{$litStr}}">
    {{--
    <div class="col-md-4">
        <div class="form-group">
            <label for="illumination">Illumination / रोशनी</label>
            <p>
                <select name="Illumination_media[]" id="Illumination_media_{{$key}}" class="form-control form-control-sm illuminationType" tabindex="{{$key}}">
    <option value="">Select Illumination</option>
    <option value="1" {{@$OD_media_address['Illumination Type']=='1' ? 'selected' : '' }} style="display: {{$show_lit}};">Lit
    </option>
    <option value="2" {{@$OD_media_address['Illumination Type']=='2' ? 'selected' : '' }}>Non
        Lit</option>
    </select>
    </p>
    </div>
    </div> --}}

    {{-- <div class="col-md-4 lit_type_{{$key}}" style="display: {{$show_lit}};">
    <div class="form-group">
        <label for="year">Lit Type<font color="red"></font></label>
        <p>
            <select name="lit_type[]" id="lit_type_{{$key}}" class="form-control form-control-sm" tabindex="{{$key}}">
                <option value="">Please Select</option>
                <option value="1" {{@$OD_media_address['Lit Type']=='1' ? 'selected' : '' }}>Front Lit</option>
                <option value="2" {{@$OD_media_address['Lit Type']=='2' ? 'selected' : '' }}>Back Lit</option>
            </select>
        </p>
    </div>
    </div> --}}
    {{-- <div class="col-md-4">
        <div class="form-group">
            <label for="license_to">Length / लंबाई <font color="red"></font></label>
            <p>
                <input type="text" name="length[]" placeholder="Enter Length" class="form-control form-control-sm size_area size_len_digit" id="length_{{$key}}" value="{{ @$OD_media_address['Length'] ? round(@$OD_media_address['Length'],2) : ''}}" onkeypress="return onlyNumberKey(event)" tabindex="{{@$key}}">
    </p>
    </div>
    </div> --}}
    {{-- <div class="col-md-4">
        <div class="form-group">
            <label for="year">Width / चौड़ाई<font color="red"></font></label>
            <p>
                <input type="text" name="width[]" placeholder="Enter Width" class="form-control form-control-sm size_area size_width_digit" id="width_{{$key}}" onkeypress="return onlyNumberKey(event)" value="{{ @$OD_media_address['Width'] ? round(@$OD_media_address['Width'],2) : ''}}" tabindex="{{@$key}}">
    </p>
    </div>
    </div> --}}
    {{-- <div class="col-md-4">
        <div class="form-group">
            <label for="year">Total Area (sq. ft) / कुल क्षेत्रफल<font color="red"></font></label>
            <p>
                <input type="text" name="Total_Area[]" placeholder="Total Area" class="form-control form-control-sm" id="Total_Area_{{$key}}" onkeypress="return onlyNumberKey(event)" value="{{ @$OD_media_address['Total Area'] ? round(@$OD_media_address['Total Area'],2) : ''}}" tabindex="{{@$key}}" readonly>
    </p>
    </div>
    </div> --}}
    @if(@$OD_media_address['Sole Media ID'] !='')
    <div class="col-md-4 location_type_{{$key}}" style="margin-top: 30px;" id="edit_location_data_{{$key}}">
        <button type="button" indexkey="{{$key}}" class="location-modal btn btn-primary btn-sm m-0" id="" data-toggle="modal" data-target="#locationModal"><i class="fa fa-edit" aria-hidden="true"></i> Edit Location</button>
    </div>

    <div class="col-md-4" id="location_type_{{$key}}" style="display: none;margin-top: 30px;" id="add_location_data_{{$key}}">
        <button type="button" id="" tabindex="{{@$key}}" data-toggle="modal" data-target="#myLocationModal" class="btn btn-primary btn-sm m-0 add-location-modal"><i class="fa fa-edit" aria-hidden="true"></i>Add Location</a></h6>
    </div>
    @else
    <div class="col-md-4" id="location_type_{{$key}}" style="display: none;margin-top: 30px;">
        <button type="button" id="" tabindex="{{@$key}}" data-toggle="modal" data-target="#myLocationModal" class="btn btn-primary btn-sm m-0 add-location-modal"><i class="fa fa-edit" aria-hidden="true"></i>Add Location</button></h6>
    </div>
    <input type="hidden" name="location_data[]" id="location_data_{{$key}}">
    @endif
    <div class="col-md-10"></div>
    <div class="col-md-2" style="padding: 0% 0 0 7%; display: {{$key==0 ? 'none' :'block'}}"><button class="btn btn-danger btn-sm m-0 remove_row" data="{{$key}}" style="display: {{@$show}};font-size: 13px;"><i class="fa fa-minus"></i> Remove</button>
    </div>
    <input type="hidden" value="{{$OD_media_address['Line No_'] ?? ''}}" name="line_no_m[]" id="line_no_m{{$key}}">
    <input type="hidden" value="{{$OD_media_address['Sole Media ID'] ?? ''}}" name="odmedia_id_m" id="odmedia_id_m{{$key}}">
    <input type="hidden" value="" name="OD_media_asset_ID[]" id="OD_media_asset_ID_{{$key}}">
    </div>
    @endforeach
    </div>
    <!-- media_address id close -->
    <div class="row" style="float:right;padding: 6px 8px 6px 0px;">
        <input type="hidden" name="count_id" id="count_id" value="{{$key ?? 0}}">
        <a class="btn btn-primary btn-sm m-0" id="add_row_media_add" style="display: {{@$show}}; font-size: 13px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
    </div>
</fieldset>
@else
<fieldset class="fieldset-border">
    <legend> Media Address / मीडिया पता</legend>
    <div class="row">
        <div class="col-md-12 wrapScroll" id="media_address">
            <table class="table" style="border: 1px solid gainsboro;">
                <thead>
                    <tr>
                        <th scope="col">Sr.No.</th>
                        <th scope="col">State</th>
                        <th scope="col">District</th>
                        <th scope="col">City</th>
                        <th scope="col">Media Category</th>
                        <th scope="col">Media Sub-Category</th>
                        {{--<th scope="col">Train No.</th> --}}
                        {{--<th scope="col">Train Name</th> --}}
                        {{--<th scope="col">Spots</th> --}}
                        <th scope="col">Quantity</th>
                        {{--<th scope="col">Length </th> --}}
                        {{--<th scope="col">Width </th> --}}
                        {{--<th scope="col">Total Area</th> --}}
                        {{-- <th scope="col">Size Type </th> --}}
                        {{--<th scope="col">Illumination</th> --}}
                        {{--<th scope="col">Lit Type</th> --}}
                        <th scope="col">Location </th>
                    </tr>
                </thead>
                <tbody>

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
                        <td>{{$OD_media_address['District'] ? $OD_media_address['District'] : 'NA'}}</td>
                        <td>{{$OD_media_address['City'] ? ucfirst(strtolower(@$OD_media_address['City'])) : 'NA'}}</td>
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
                </tbody>
            </table>
        </div>
    </div>
</fieldset>
@endif

<!-- modal for update location Details-->
<div class="container">
    <div class="modal" id="locationModal">
        <div class="modal-dialog" style="margin-left: 10% !important;">
            <div class="modal-content" style="width: 220%;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title text-primary"> <i class="fa fa-edit" aria-hidden="true"></i> Location Details</h6> <span style="margin-left: 18%;">Sub Category : <b id="sub_cat_text"></b></span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h6 id="addLocation" class="addLocation" align="center" style="color:#4d9b5e; display:none"></h6>
                    <div class="row" id="model-location"></div>
                    <div class="row">
                        <div class="col-md-11"></div>
                        <div class="col-md-1" style="text-align: right;padding: 0;margin-left: inherit;"><a href="javascript:void(0);" class="btn btn-primary btn-sm m-0" id="addnewrow" style="font-size: 12px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a></div>
                    </div>
                </div>
                </form>
                <!-- Modal footer -->
                <div class="modal-footer" style="display: block !important;">
                    <button type="button" class="btn btn-danger btn-sm m-0" data-dismiss="modal" style="float: left;">Close</button>
                    <button type="button" class="btn btn-primary btn-sm m-0 save_location" id="save_location" style="float: right;">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal for add location Details-->
<div class="container">
    <div class="modal" id="myLocationModal">
        <div class="modal-dialog" style="margin-left: 10% !important;">
            <div class="modal-content" style="width: 220%;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title text-primary"> <i class="fa fa-edit" aria-hidden="true"></i> Add Location</h6> <span style="margin-left: 18%;">Sub Category : <b id="sub_cat_textt"></b></span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h6 id="addLocationmedia" class="addLocation" align="center" style="color:#4d9b5e; display:none"></h6>
                    <div class="row" id="media-model-location"></div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer" style="display: block !important;">
                    <button type="button" class="btn btn-danger btn-sm m-0" data-dismiss="modal" style="float: left;">Close</button>
                    <button type="button" class="btn btn-primary btn-sm m-0 add_location" id="add_location" tabindex="" style="float: right;">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal for view location Details-->
<div class="container">
    <div class="modal" id="viewLocationModal">
        <div class="modal-dialog" style="margin-left: 10% !important;">
            <div class="modal-content" style="width: 220%;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title text-primary">View Location Details</h6><span style="margin-left: 18%;">Sub Category : <b id="sub_cat_texttt"></b></span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row" id="view-model-location"></div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>