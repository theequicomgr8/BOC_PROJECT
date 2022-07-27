<div class="row">
                <input type="hidden" name="rob_form_id" value="{{@$data->Pk_id ?? ''}}">
                <div class="col-xl-4">
                  <label for="">Document Type : <span style="color: red;">*</span>{{@$rob_documents[0]->document_type}}</label>
                  <select name="document_type"  id="ddl_doc_categ"  class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                    <option  value="">--Select--</option>
                    <option value="PIC" {{@$data->document_type=='PIC' ? 'selected' : ''}}>Photographs of Event</option>
                    <option value="VID" {{@$data->document_type=='VID' ? 'selected' : ''}}>Video Clips of Event</option>
                    <option value="NEW" {{@$data->document_type=='NEW' ? 'selected' : ''}}>Newspaper cutting</option>
                  </select>
                  <span id="document_type_err" style="display: none;color: red;"></span>
                  <span id="detail_report_err" style="color: red;">
                      @error('document_type')
                        {{$message}}
                      @enderror
                    </span>
                  
                </div>
                <div class="col-xl-4">
                  <label for="">Date of Event : <span style="color: red;">*</span></label>
                  <input name="event_date" type="date" value="{{@$data->event_date ?? ''}}"  maxlength="10" id="txt_date_event" class="calendar1 form-control form-control-sm" {{$block}}  /> <!-- max="{{$today}}" -->
                  <span id="event_date_err" style="display: none;color: red;"></span>
                  <span id="detail_report_err" style="color: red;">
                      @error('event_date')
                      {{$message}}
                      @enderror
                    </span>
                  
                </div>
                @php
                $post_events=explode(",",@$data->village_name);
                //dd($post_events);
                //dd($data->post_venue);




                @endphp
                <div class="col-xl-4">
                  <label for="">Venue of Event : <span style="color: red;">*</span></label>
                  <!-- <input name="venue_event" type="text" value="{{@$data->venue_event ?? ''}}"  maxlength="50" id="txt_venue_event1" class="form-control form-control-sm" {{$block}}/> -->
                  <select class="form-control form-control-sm" name="post_venue">
                    <option value="">Select venue event</option>
                    @foreach($post_events as $post)
                    <option {{  @$post == @$data->post_venue ? 'selected': '' }} >{{@$post}}</option>
                    @endforeach
                  </select>
                  <span id="venue_event_err" style="display: none;color: red;"></span>
                    <span id="detail_report_err" style="color: red;">
                      @error('post_venue')
                      {{$message}}
                      @enderror
                    </span>
                </div>
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
                @if(@$data->status=='0' || @$data->status=='1')
                <div class="col-xl-4">
                  <label>Video upload : </label>
                  <input type="file" name="video" id="video" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*">
                  <span id="video_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4">
                  <label>Caption : </label>
                  <input type="text" name="video_caption" id="video_caption" class="form-control form-control-sm">
                  <span id="video_caption_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4"></div>
                @else
                <input type="hidden" name="video" value="{{@$data->video}}">
                <input type="hidden" name="video_caption" value="{{@$data->video_caption}}">
                
                @endif

                <!-- @$data->video2=='' && @$data->video2==null -->
                @if(@$data->status=='0' || @$data->status=='1')
                <div class="col-xl-4">
                  <label>Video upload : </label>
                  <input type="file" name="video2" id="video2" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*">
                  <span id="video2_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4">
                  <label>Caption : </label>
                  <input type="text" name="video2_caption" id="video2_caption" class="form-control form-control-sm">
                  <span id="video2_caption_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4"></div>
                @else
                <input type="hidden" name="video2" value="{{@$data->video2}}">
                <input type="hidden" name="video2_caption" value="{{@$data->video2_caption}}">
                
                @endif

                <!-- @$data->video3=='' && @$data->video3==null -->
                @if(@$data->status=='0' || @$data->status=='1')
                <div class="col-xl-4">
                  <label>Video upload : </label>
                  <input type="file" name="video3" id="video3" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*">
                  <span id="video3_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4">
                  <label>Caption : </label>
                  <input type="text" name="video3_caption" id="video3_caption" class="form-control form-control-sm">
                  <span id="video3_caption_err" style="color: red;display: none;"></span>
                </div>
                @else
                <input type="hidden" name="video3" value="{{@$data->video3}}">
                <input type="hidden" name="video3_caption" value="{{@$data->video3_caption}}">
                @endif

                <!-- <div class="col-xl-12" >
                  <h5 style="color: blue;"><u>Photograph section :</u> </h5>
                </div> -->
                <div class="col-xl-12">
                  <!-- @$rob_documents[0]->event_date =='' -->
                  @if(@$data->status=='0' || @$data->status=='1')
                  <table class="table borderless" id="FileUploadContainer" style="margin-left:-10px;">
                    <tr>
                        <td>
                          Photograph : <input type="file" name="document_name[]" id="pic" class="form-control form-control-sm" accept="image/png, image/gif, image/jpeg" style="width: 336px;">
                        </td>
                        <td><span style="margin-left: -10px;">Caption Name:</span> <input type="text" name="caption_name[]" id="caption_name1"  class="form-control form-control-sm" style="width: 334px;margin-left: -10px;">
                        </td>
                        <td>
                          <br><input type="checkbox" name="show_website[]" id="show_website" value="1"> Show on Website
                        </td>                        
                        
                        <!-- @$rob_documents[0]->event_date -->
                        @if(@$data->status=='0' || @$data->status=='1') <!-- when form is readable then add button not show -->
                        <td><br><button class="btn btn-info" id="Button1">Add More</button></td>
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
                <!-- <div class="col-xl-12" >
                  <h5 style="color: blue;"><u>Press Release File :</u> </h5>
                </div> -->
                <div class="col-xl-12">
                  <!-- @$rob_documents[0]->event_date =='' -->
                  @if(@$data->status=='0' || @$data->status=='1')
                  <table class="table borderless" id="PressUploadContainer" style="margin-left:-10px;">
                    <tr>
                        <td>
                          Press Release File : <input type="file" name="press_document_name[]" id="pic2" class="form-control form-control-sm" accept="image/png, image/gif, image/jpeg" style="width: 336px;">
                        </td>
                        <td> Caption Name: <input type="text" name="press_caption_name[]" id="press_caption_name"  class="form-control form-control-sm" style="width: 334px;margin-left: -10px;">
                        <td><br><input type="checkbox" name="press_show_website[]" id="press_show_website" value="1"> Show on Website</td>                        
                        </td>
                        <!-- @$rob_documents[0]->event_date=='' -->
                        @if(@$data->status=='1' || $status=='0') <!-- when form is readable then add button not show -->
                        <td><br><button class="btn btn-info" id="press">Add More</button></td>
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
                      <th style="width: 20%;">Video</th>
                      <th style="width: 20%;">Caption Name</th>
                    </tr>
                    <tr>
                      <td>1</td> 
                      <td>
                        <video controls width="150" height="100">
                        <source src="{{asset('rob/'.@$data->video)}}">
                        </video>
                      </td>
                      <td>
                        {{@$data->video_caption}}
                      </td>
                    </tr>
                    <tr>
                      <td>2</td> 
                      <td>
                        <video controls width="150" height="100">
                        <source src="{{asset('rob/'.@$data->video2)}}">
                        </video>
                      </td>
                      <td>
                        {{@$data->video2_caption}}
                      </td>
                    </tr>
                    <tr>
                      <td>3</td> 
                      <td>
                        <video controls width="150" height="100">
                        <source src="{{asset('rob/'.@$data->video3)}}">
                        </video>
                      </td>
                      <td>
                        {{@$data->video3_caption}}
                      </td>
                    </tr>
                  </table>
                @endif



                @if(@$data->status=='2')
                  <h4>Photograph Section : </h4>
                   <table class="table table-bordered" style="margin-top:10px;">
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 20%;">File</th>
                      <th style="width: 20%;">Caption Name</th>
                      <th style="width: 20%;">Show on Website</th>
                    </tr>
                    @foreach(@$rob_documents as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>
                        <a target="_blank" href="{{asset('rob/'.$rob_document->document_name)}}">
                          <img style="width: 50px;height: 50px;" src="{{asset('rob/'.$rob_document->document_name)}}">
                        </a>
                        <!-- <input type="hidden" name="document_name_modify[]" value="{{@$rob_document->document_name ?? ''}}"> -->
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                        <!-- <input type="hidden" name="caption_name_modify[]" value="{{@$rob_document->caption_name ?? ''}}"> -->
                      </td>
                      @php
                      if(@$rob_document->show_website=='1')
                      {
                        $check='checked';
                        $disabled='disabled';
                      }
                      else
                      {
                        $check='';
                        $disabled='';
                      }
                      @endphp
                      <td>
                        <input type="checkbox" name="show_website" {{$check}} {{$disabled}}>
                        <!-- <input type="hidden" name="show_website_modify[]" value="{{@$rob_document->show_website ?? '0'}}"> -->

                      </td>
                    </tr>
                    @endforeach
                  </table>
                  @else
                  @foreach(@$rob_documents as $key=>$rob_document)
                  <input type="hidden" name="document_name_modify[]" value="{{@$rob_document->document_name ?? ''}}">
                  <input type="hidden" name="caption_name_modify[]" value="{{@$rob_document->caption_name ?? ''}}">
                  <input type="hidden" name="show_website_modify[]" value="{{@$rob_document->show_website ?? '0'}}">
                  @endforeach
                  @endif


                  <!-- press section -->
                  <!-- @$press[0]->event_date!='' -->
                  @if(@$data->status=='2')
                  <h4>Press Release : </h4>
                   <table class="table table-bordered" style="margin-top:10px;">
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 20%;">File</th>
                      <th style="width: 20%;">Caption Name</th>
                      <th style="width: 20%;">Show on Website</th>
                    </tr>
                    @foreach(@$press as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>
                        <a target="_blank" href="{{asset('rob/'.$rob_document->document_name)}}">
                          <img style="width: 50px;height: 50px;" src="{{asset('rob/'.$rob_document->document_name)}}">
                        </a>
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                      </td>
                      @php
                      if(@$rob_document->show_website=='1')
                      {
                        $check='checked';
                        $disabled='disabled';
                      }
                      else
                      {
                        $check='';
                        $disabled='';
                      }
                      @endphp
                      <td><input type="checkbox" name="show_website" {{$check}} {{$disabled}}></td>
                    </tr>
                    @endforeach
                  </table>
                  @else
                   @foreach(@$press as $key=>$rob_document)
                   <input type="hidden" name="press_document_name_modify[]" value="{{@$rob_document->document_name ?? ''}}">
                   <input type="hidden" name="press_caption_name_modify[]" value="{{@$rob_document->caption_name ?? ''}}">
                   <input type="hidden" name="press_show_website_modify[]" value="{{@$rob_document->show_website ?? '0'}}">
                   @endforeach
                  @endif


              </div> <!-- row close -->