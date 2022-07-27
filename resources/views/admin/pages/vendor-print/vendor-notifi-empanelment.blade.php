@extends('admin.layouts.layout')

  <?php
  $boc_ftp_path = $dbresponse->boc_ftp_path;
  ?>
@section('content')
<div class="content-wrapper">
  <div class="content-inside p-3">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-normal text-primary">Vendor Notification Empanelment</h6>
      </div>      
      <form action="" method="post">
        <div class="tab-content">
          <div class="content pt-3 tab-pane active show" role="tabpanel">
          <h5 style="margin-left: 14px;">Notification:-</h5>
            <div class="row" style="margin: 0;">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Name">Title Subject / शीर्षक विषय<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" name="title_sub" id="title_sub" placeholder="Title Subject" readonly value="{{$advisiory != null ? $advisiory->Title_Subject : ''}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Name">Start Date / आरंभ करने की तिथि<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="start_date" readonly placeholder="Start Date" value="{{$advisiory != null ? date('d-m-Y', strtotime($advisiory->start_date)) : ''}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Name">End Date / समाप्ति तिथि<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="end_date" readonly placeholder="End Date" value="{{$advisiory != null ? date('d-m-Y', strtotime($advisiory->end_date)) : ''}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Name">Publish Date / प्रकाशित तिथि<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="Publish_date" readonly placeholder="Publish Date" value="{{$advisiory != null ? date('d-m-Y', strtotime($advisiory->publish_date)) : ''}}">
                </div>
              </div>
              <div class="col-md-4" style="margin-top: auto;">
                <div class="form-group">
                  <label for="Name">Attatchment / अनुरक्ति<font color="red">*</font></label>
                  <a target="_blank" href="http://52.172.8.254:8080/BOC_web/pdf/whats_new/Adv13421682021.pdf">View</a>
                  <!--<input type="text" class="form-control" id="file" readonly value="{{@$boc_ftp_path}}">-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection