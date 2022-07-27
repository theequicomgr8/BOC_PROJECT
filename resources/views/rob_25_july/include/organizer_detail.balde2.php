          



          <div class="row">
            <div class="col-xl-12">
              <h5 style="color: blue;"><u>Organizer Details</u></h5>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-4">
              <div class="form-group"> <!-- vip_designation -->
                <label for="">Name of Officer :<span style="color: red;"></span></label>
                <input type="text" name="officer_name_person" value="{{@$data->officer_name_person ?? ''}}" id="officer_name_person" onkeypress="return alphaOnly(event);"  class="form-control form-control-sm" {{$block}} {{$mouse}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Designation :<span style="color: red;"></span></label>
                <input type="text" name="person_designation" value="{{@$data->person_designation ?? ''}}" id="person_designation" onkeypress="return alphaOnly(event)" maxlength="10" class="form-control form-control-sm" {{$block}} {{$mouse}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Contact No. :<span style="color: red;"></span></label>
                <input type="text" name="contact_no" value="{{@$data->contact_no ?? ''}}" id="contact_no" onkeypress="return onlyNumberKey(event)" maxlength="10"  class="form-control form-control-sm" {{$block}} {{$mouse}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">E-mail ID :<span style="color: red;">*</span></label>
                <input type="text" name="email" value="{{@$data->email ?? ''}}" id="email" class="form-control form-control-sm" {{$block}} {{$mouse}}>
                <span id="email_err_" style="color: red;"></span>
              </div>
            </div>

            
            @php
            if(@$data->system_date==null)
            {
              $none='none';
            }
            else
            {
              $none='';
            }
            @endphp
            <div class="col-xl-4" style="display: {{$none}}">
              <div class="form-group">
                <label for="">Date:<span style="color: red;"></span></label>
                <input type="date" name="system_date" value="{{@$data->system_date ?? ''}}" class="form-control form-control-sm" {{$block}} {{$mouse}}>
                <span id="system_date_err_" style="color: red;"></span>
              </div>
            </div>

          </div>