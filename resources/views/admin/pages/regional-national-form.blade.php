@extends('admin.layouts.layout')
<style>
body{
    color: #6c757d !important;

}
#davp_code-error{
  color: red;
}
</style>
@section('content')
 <!-- Content Wrapper. Contains page content -->

<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Fresh Empanelment of AV-TV</h6>
        </div>
        <!-- Main content -->
          <!-- /.end card-header -->
          @php
           if(@$Chanal_Details->{'Modification'} == 1){
                  $click='preventLeftClick';
                  }else{
                  $click ="";
                }
            @endphp
          <form  action="/form-type" method="post" id="myform"  enctype="multipart/form-data"> 
            @csrf
          <div class="card-body">
            <div class="row ml-1 mb-1">
            <h6 class="m-0 font-weight-bold">Form type</h6>
          </div>
                        <div class="row ml-3">
                            
                        <div class="icheck-primary d-inline">
                          @if(@$Chanal_Details->{'Channel Type'} == 0)
                                <input type="radio" id="davp_code1" name="davp_code" class="{{$click}}" value="Regional" checked="checked">
                                @else
                                <input type="radio" id="davp_code1" name="davp_code" class="{{$click}}" value="Regional">
                                @endif
                                <label for="davp_code1">Regional / क्षेत्रीय</label>&nbsp;&nbsp;
                              </div>
                              <div class="icheck-primary d-inline">
                                @if(@$Chanal_Details->{'Channel Type'} == 1)
                                <input type="radio" id="davp_code2" name="davp_code" class="{{$click}}" value="National" checked="checked">
                                @else
                                <input type="radio" id="davp_code2" name="davp_code" class="{{$click}}" value="National">
                                @endif
                                <label for="davp_code2">National / राष्ट्रीय</label>
                              </div>

                              <span id="alert_msg" class="ml-3" style="display: none;color: red">
                                Select any one
                              </span>
                               
                              <div class="row text-center pt-5">
                               <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                            </div>
                            </div>
                            <!-- /.card-body -->
                          </div>
                        </div>
                      </div>           
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->      
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  @section('custom_js')
  <script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
  <script type="text/javascript">


 $(document).ready(function(){
  $('form').on('submit',function(){ 
    var davp_code = $('input[name="davp_code"]:checked').val();
    // alert(davp_code);
    if(davp_code == undefined)
    {
      // alert("Not Checked");
      $("#alert_msg").show();
      return false;
    }
    else
    {
      $("#alert_msg").hide();
    }
  })
});
$(document).ready(function() {
    $('.preventLeftClick').on('click', function(e) {
        e.preventDefault();
        return false;
    });
});


  </script>
@endsection
