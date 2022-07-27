@if(@count($ownerotherdata)>=1 && $ownerotherdata != '')
@foreach($ownerotherdata as $key => $owner_other_data)
<div class="row" {{$key}}>
  <div class="col-md-12">
    <h4 class="subheading">Details of Other Publications of Same Owner or Publisher-----/एक ही मालिक या प्रकाशक के अन्य प्रकाशनों का विवरण ----</h4>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="title">Title / शीषक</label>
      <input type="text" name="title" placeholder="Enter Title" class="form-control  form-control-sm" id="title1" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ $owner_other_data['Newspaper Name'] ?? '' }}" disabled>
      <span id="alert_title" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"> 
    <div class="form-group">
      <label>Language / भाषा</label>
      <select id="davp_lang1" name="lang" class="form-control  form-control-sm" style="width: 100%;" disabled>
        <option value="" data-select2-id="2">Select Language</option>
        @foreach($languages as $language)
        <option value="{{ $language['Code'] }}" {{ @$ownerotherdata[$key]['Language'] == $language['Code']  ? 'selected' : '' }}>{{ $language['Code'] }} ~ {{ $language['Name'] }}</option>
        @endforeach
      </select>
      <span id="alert_davp_lang1" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="publication">Place of Publication / प्रकाशक का स्थान</label>
      <input type="text" name="place_of_publication_davp" placeholder="Enter Place of Publication" class="form-control  form-control-sm" id="publication1" onkeypress="return onlyAlphabets(event,this)" value="{{ $owner_other_data['Place of Publication'] ?? '' }}" disabled>
      <span id="alert_publication" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label>Periodicity / अवधि</label>
      <select name="periodicity_davp" id="periodicity_mult" class="form-control  form-control-sm" disabled>
        <option value="0" {{ @$ownerotherdata[$key]['Periodicity'] == 0  ? 'selected' : '' }}>Daily(M)</option>
        <option value="1" {{ @$ownerotherdata[$key]['Periodicity'] == 1  ? 'selected' : '' }}>Daily(E)</option>
        <option value="2" {{ @$ownerotherdata[$key]['Periodicity'] == 2  ? 'selected' : '' }}>Daily Except Sunday</option>
        <option value="3" {{ @$ownerotherdata[$key]['Periodicity'] == 3  ? 'selected' : '' }}>Bi-Weekly</option>
        <option value="4" {{ @$ownerotherdata[$key]['Periodicity'] == 4  ? 'selected' : '' }}>Weekly</option>
        <option value="5" {{ @$ownerotherdata[$key]['Periodicity'] == 5  ? 'selected' : '' }}>Fortnightly</option>
        <option value="6" {{ @$ownerotherdata[$key]['Periodicity'] == 6  ? 'selected' : '' }}>Monthly</option>
      </select>
      <span id="alert_periodicity_mult" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="davp">Owner/Group ID / मालिक/समूह कोड </label>
      <input type="text" name="davp" placeholder="Enter Owner/Group ID" class="form-control  form-control-sm" id="davp" value="{{ @$ownerotherdata[$key]['Newspaper Code'] ?? '' }}" disabled>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="edition_distance">Distance From This Edition(In Km) / इस संस्करण से दूरी (किमी. में)</label>
      <input type="text" name="distance_from_edition[]" placeholder="Enter Distance" class="form-control  form-control-sm" id="edition_distance" onkeypress="return onlyNumberKey(event)" value="{{ @$ownerotherdata !='' ?  @rtrim(rtrim(sprintf('%f', floatval(@$ownerotherdata[$key]['Distance from office to press'])),0),'.') : ''}}" disabled>
      <span id="alert_edition_distance" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"></div>
</div>
@endforeach
@else
<div class="row" id="add_davp" style="margin: 0px;">
</div>
@endif
<input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="{{$vendordatas['Newspaper Code'] ?? ''}}" {{$disabledall}}>
<input type="hidden" name="user_id" value="{{ session('id') }}" {{$disabledall}}>
<input type="hidden" name="next_tab_2" id="next_tab_2" value="0" {{$disabledall}}>
<div class="col-sm-12 text-right" style="padding: 0;">
  <a class="btn btn-primary reg-previous-button previousClass btn-sm m-0" data="10"><i class="fa fa-caret-left"></i> Previous</a>
  <a class="btn btn-primary next-button btn-sm m-0" id="tab_2">Next <i class="fa fa-caret-right"></i></a>
</div>