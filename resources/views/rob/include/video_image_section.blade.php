<div class="row">
                <input type="hidden" name="rob_form_id" value="{{@$data->Pk_id ?? ''}}">
                <?php 
                // <div class="col-xl-4">
                //   <label for="">Document Type : <span style="color: red;">*</span>{{@$rob_documents[0]->document_type}}</label>
                //   <select name="document_type"  id="ddl_doc_categ"  class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                //     <option  value="">--Select--</option>
                //     <option value="PIC" {{@$data->document_type=='PIC' ? 'selected' : ''}}>Photographs of Event</option>
                //     <option value="VID" {{@$data->document_type=='VID' ? 'selected' : ''}}>Video Clips of Event</option>
                //     <option value="NEW" {{@$data->document_type=='NEW' ? 'selected' : ''}}>Newspaper cutting</option>
                //   </select>
                //   <span id="document_type_err" style="display: none;color: red;"></span>
                //   <span id="detail_report_err" style="color: red;">
                //       @error('document_type')
                //         {{$message}}
                //       @enderror
                //     </span>
                  
                // </div>
                ?>

                <?php 
                // <div class="col-xl-4">
                //   <label for="">Date of Event : <span style="color: red;">*</span></label>
                //   <input name="event_date" type="date" value="{{@$data->event_date ?? ''}}"  maxlength="10" id="txt_date_event" class="calendar1 form-control form-control-sm" {{$block}}  /> <!-- max="{{$today}}" -->
                //   <span id="event_date_err" style="display: none;color: red;"></span>
                //   <span id="detail_report_err" style="color: red;">
                //       @error('event_date')
                //       {{$message}}
                //       @enderror
                //     </span>
                  
                // </div>
                ?>
                @php
                $post_events=explode(",",@$data->village_name);
                @endphp
                <?php 
                // <div class="col-xl-4">
                //   <label for="">Venue of Event : <span style="color: red;">*</span></label>
                //   <!-- <input name="venue_event" type="text" value="{{@$data->venue_event ?? ''}}"  maxlength="50" id="txt_venue_event1" class="form-control form-control-sm" {{$block}}/> -->
                //   <select class="form-control form-control-sm" name="post_venue" style="pointer-events:{{$non}};" {{$block}}>
                //     <option value="">Select venue event</option>
                //     @foreach($post_events as $post)
                //     <option {{  @$post == @$data->post_venue ? 'selected': '' }} >{{@$post}}</option>
                //     @endforeach
                //   </select>
                //   <span id="venue_event_err" style="display: none;color: red;"></span>
                //     <span id="detail_report_err" style="color: red;">
                //       @error('post_venue')
                //       {{$message}}
                //       @enderror
                //     </span>
                // </div>
                ?>
                <br>
                

                @if(@$data->status=='0' || @$data->status=='1')
                <div class="col-xl-12" >
                  <h5 style="color: blue;"><u>Video upload section :</u> </h5>
                </div>
                @endif
                <!-- if(@$data->video=='' && @$data->video==null) -->
                @php
                if(Request::segment(2)!='')
                {
                  $status='1';
                }
                else
                {
                  $status='0';
                }
                @endphp
                


                <div class="col-xl-12">
                  @if(@$data->status=='0' || @$data->status=='1')
                  <table class="table borderless" id="VideoUploadContainer" style="margin-left:-10px;">
                    <tr>
                      <td>Date :<input type="date" name="video_date[]" min="{{@$data->duration_activity_from_date}}" max="{{@$data->duration_activity_to_date}}" class="form-control form-control-sm" value="{{@$data->duration_activity_from_date ?? ''}}"></td>
                      <td>
                        Venue : 
                        <select class="form-control form-control-sm" name="venue_address[]">
                          <option value="">Select venue event</option>
                          @foreach($post_events as $post)
                          <option {{  @$post == @$data->post_venue ? 'selected': '' }} >{{@$post}}</option>
                          @endforeach
                        </select>
                      </td>
                      <td>
                        Video Uppload :<input type="file" name="video[]" id="video" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*" style="width: 267px;margin-left: -12px;">
                      <span id="video_err" style="color: red;display: none;"></span>
                      </td>
                      <td>
                        Caption :
                        <input type="text" name="video_caption[]" id="video_caption" class="form-control form-control-sm">
                      <span id="video_caption_err" style="color: red;display: none;"></span>
                      </td>
                      @if(Session::get('UserType')!='3')
                      <td style="width: 178px;">
                        <br>
                      <input type="checkbox" name="video_show_website[]" id="show_website" value="1" style="margin-left: 0px;"> Show on Website
                      </td>
                      @endif
                      <td>
                        <br>
                      <span class="btn btn-info" id="video_add" style="margin-left: -17px;">Add</span>
                      </td>
                    </tr>
                  </table>
                  @endif
                </div>








                
                @if(@$data->status=='1')
                <div class="col-xl-12" >
                  <h5 style="color: blue;"><u>Photograph section :</u> </h5>
                </div>
                @endif
                <div class="col-xl-12">
                  <!-- @$rob_documents[0]->event_date =='' -->
                  @if(@$data->status=='0' || @$data->status=='1')
                  <table class="table borderless" id="FileUploadContainer" style="margin-left:-10px;">
                    <tr>
                      <td>
                          Date : <input type="date" name="venue_date[]" min="{{$data->duration_activity_from_date}}" max="{{@$data->duration_activity_to_date}}" class="form-control form-control-sm" value="{{@$data->duration_activity_from_date ?? ''}}">
                        </td>
                        <td>
                          Venue : <span style="color: red;">*</span>
                          <select class="form-control form-control-sm" name="venue_address[]" required>
                            <option value="">Select venue event</option>
                            @foreach($post_events as $post)
                            <option {{  @$post == @$data->post_venue ? 'selected': '' }} >{{@$post}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          Photograph : <span style="color: red;">*</span> <input type="file" name="document_name[]" id="pic" class="form-control form-control-sm" accept="image/png, image/gif, image/jpeg" style="" required>
                        </td>
                        <td><span style="margin-left: 0px;">Caption Name:</span> <span style="color: red;">*</span> <input type="text" name="caption_name[]" id="caption_name1"  class="form-control form-control-sm" style="margin-left: 0px;" required>
                        </td>
                        @if(Session::get('UserType')!='3')
                        <td style="width: 178px;">
                          <br><input type="checkbox" name="show_website[]" id="show_website" value="1"> Show on Website
                        </td>                        
                        @endif
                        <!-- @$rob_documents[0]->event_date -->
                        @if(@$data->status=='0' || @$data->status=='1') <!-- when form is readable then add button not show -->
                        <td><br>
                          <!-- <button class="btn btn-info" id="Button1">Add More</button> -->
                          <span class="btn btn-info" id="photobtn">Add</span>
                        </td>
                        @endif
                    </tr>
                    <tr>
                      <td>
                        <span id="document_name_err" style="color: red;display: none;"></span>
                    </td>
                    <td>
                        <span id="caption_name1_err" style="color: red;display: none1;"></span>
                    </td>
                    </tr>

                  </table>
                  @endif
                </div>



                <!-- Press image -->
                @if(@$data->status=='1')
                <div class="col-xl-12" >
                  <h5 style="color: blue;"><u>Press Release File :</u> </h5>
                </div>
                @endif
                <div class="col-xl-12">
                  <!-- @$rob_documents[0]->event_date =='' -->
                  @if(@$data->status=='0' || @$data->status=='1')
                  <table class="table borderless" id="PressUploadContainer" style="margin-left:0px;">
                    <tr>
                        <td>
                          Date : <input type="date" name="venue_date_pr[]" min="{{$data->duration_activity_from_date}}" max="{{@$data->duration_activity_to_date}}" class="form-control form-control-sm" value="{{@$data->duration_activity_from_date ?? ''}}">
                        </td>
                        <td>
                          Venue <span style="color: red;">*</span>
                          <select class="form-control form-control-sm" name="venue_address_pr[]" required>
                            <option value="">Select venue event</option>
                            @foreach($post_events as $post)
                            <option {{  @$post == @$data->post_venue ? 'selected': '' }} >{{@$post}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          Press Release File : <span style="color: red;">*</span> <input type="file" name="press_document_name[]" id="pic2" class="form-control form-control-sm" accept="image/png, image/gif, image/jpeg" style="" required>
                        </td>
                        <td> Caption Name: <span style="color: red;">*</span><input type="text" name="press_caption_name[]" id="press_caption_name"  class="form-control form-control-sm" style="margin-left: 0px;" required></td>
                        @if(Session::get('UserType')!='3')
                        <td style="width: 178px;">
                          <br><input type="checkbox" name="press_show_website[]" id="press_show_website" value="1"> Show on Website
                        </td>
                        @endif                      
                        
                        <!-- @$rob_documents[0]->event_date=='' -->
                        @if(@$data->status=='1' || $status=='0') <!-- when form is readable then add button not show -->
                          <td><br><button class="btn btn-info" id="press">Add</button></td>
                        @endif
                    </tr>
                    <tr>
                      <td>
                        <span id="press_document_name_err" style="color: red;display: none;"></span>                     
                    </td>
                    </tr>
                  </table>
                  @endif
                </div>
                <!-- press image end -->

                <!-- @$rob_documents[0]->event_date!='' -->

                @if(@$data->status=='2')
                  <h4>Video Section : </h4>
                  <table class="table table-bordered" style="margin-top:10px;">
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 10%;">Date</th>
                      <th style="width: 10%;">Venue</th>
                      <th style="width: 15%;">File</th>
                      <th style="width: 15%;">Caption Name</th>
                      <th style="width: 15%;">Show on Website</th>
                    </tr>
                    @foreach(@$video as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td> 
                      <td>{{@$rob_document->venue_date}}</td>
                      <td>{{@$rob_document->venue_address}}</td>
                      <td>
                        <video controls width="150" height="100">
                        <source src="{{asset('rob/'.@$rob_document->document_name)}}">
                        </video>
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                      </td>
                      @php
                      if(@$rob_document->show_website=='1' && Session::get('UserType')=='3')
                      {
                        $check='checked';
                        $disabled='disabled';
                      }
                      elseif(Session::get('UserType')=='2' || Session::get('UserType')=='5')
                      {
                        if(@$rob_document->show_website=='1')
                        {
                          $check='checked';
                        }
                        else
                        {
                          $check='';
                        }
                        $disabled='';
                      }
                      else
                      {
                        $check='';
                        $disabled='';
                      }
                      @endphp
                      @if(Session::get('UserType')!='3')
                      <td>
                        <input type="checkbox" name="video_show_website" class="video_check" data-pk="{{@$rob_document->pk_document_id ?? ''}}" data-id="{{@$rob_document->rob_form_id ?? ''}}"value="1" {{$check}} {{$disabled}}>
                      </td>
                      @endif
                    </tr>
                    @endforeach
                  </table>
                @endif



                @if(@$data->status=='2')
                  <h4>Photograph Section : </h4>
                   <table class="table table-bordered" style="margin-top:10px;">
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 10%;">Date</th>
                      <th style="width: 10%;">Venue</th>
                      <th style="width: 15%;">File</th>
                      <th style="width: 15%;">Caption Name</th>
                      <th style="width: 15%;">Show on Website</th>
                    </tr>
                    @foreach(@$rob_documents as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{@$rob_document->venue_date}}</td>
                      <td>{{@$rob_document->venue_address}}</td>
                      <td>
                        <a target="_blank" href="{{asset('rob/'.$rob_document->document_name)}}">
                          <img style="width: 50px;height: 50px;" src="{{asset('rob/'.$rob_document->document_name)}}">
                        </a>
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                      </td>
                      @php
                      if(@$rob_document->show_website=='1' && Session::get('UserType')=='3')
                      {
                        $check='checked';
                        $disabled='disabled';
                      }
                      elseif(Session::get('UserType')=='2' || Session::get('UserType')=='5')
                      {
                        if(@$rob_document->show_website=='1')
                        {
                          $check='checked';
                        }
                        else
                        {
                          $check='';
                        }
                        $disabled='';
                      }
                      else
                      {
                        $check='';
                        $disabled='';
                      }
                      @endphp
                      @if(Session::get('UserType')!='3')
                      <td>
                        <input type="checkbox" name="show_website" class="video_check" data-pk="{{@$rob_document->pk_document_id ?? ''}}" data-id="{{@$rob_document->rob_form_id ?? ''}}" value="1" {{$check}} {{$disabled}}>
                      </td>
                      @endif
                    </tr>
                    @endforeach
                  </table>
                  @endif


                  <!-- press section -->
                  <!-- @$press[0]->event_date!='' -->
                  @if(@$data->status=='2')
                  <h4>Press Release : </h4>
                   <table class="table table-bordered" style="margin-top:10px;">
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 10%;">Date</th>
                      <th style="width: 10%;">Venue</th>
                      <th style="width: 15%;">File</th>
                      <th style="width: 15%;">Caption Name</th>
                      <th style="width: 15%;">Show on Website</th>
                    </tr>
                    @foreach(@$press as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{@$rob_document->venue_date}}</td>
                      <td>{{@$rob_document->venue_address}}</td>
                      <td>
                        <a target="_blank" href="{{asset('rob/'.$rob_document->document_name)}}">
                          <img style="width: 50px;height: 50px;" src="{{asset('rob/'.$rob_document->document_name)}}">
                        </a>
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                      </td>
                      @php
                      if(@$rob_document->show_website=='1' && Session::get('UserType')=='3')
                      {
                        $check='checked';
                        $disabled='disabled';
                      }
                      elseif(Session::get('UserType')=='2' || Session::get('UserType')=='5')
                      {
                        if(@$rob_document->show_website=='1')
                        {
                          $check='checked';
                        }
                        else
                        {
                          $check='';
                        }
                        $disabled='';
                      }
                      else
                      {
                        $check='';
                        $disabled='';
                      }
                      @endphp
                      @if(Session::get('UserType')!='3')
                      <td><input type="checkbox" name="show_website" class="video_check" data-pk="{{@$rob_document->pk_document_id ?? ''}}" data-id="{{@$rob_document->rob_form_id ?? ''}}"value="1" {{$check}} {{$disabled}}></td>
                      @endif
                    </tr>
                    @endforeach
                  </table>
                  
                  @endif


              </div> <!-- row close -->