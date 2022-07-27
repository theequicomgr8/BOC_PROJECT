@extends('admin.layouts.layout')
<style>
body{
    color: #6c757d !important;
  }

</style>
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          @php 
            $results=isset($npLists)? $npLists:'';
            @endphp
          <div class="col-sm-12">
             @php 
            $mpdetail='';
            $mpdetail=isset($mpdetails)? $mpdetails:''; 
            if(@$mpdetail->{'Cl Approval Received'}==1){
            $disabled='disabled';
            }else{
            $disabled='';
          }
            @endphp 
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
          <div class="col-md-12" style="">
            <div class="card card-default">
            <div class="card-header">
                <p><STRONG style="color: #0072C6;">MEDIA PLAN</STRONG>
            <a href="{{url('pdfGenerateOD/'.$mpdetail->{'MP No_'})}}" class="m-0 font-weight-normal text-primary float-right">
            <i class="fa fa-download"></i> Download Outdoor Media Plan Received
               </a></p>
            <div class="card-tools">
            </div>
          </div>
          <!-- /.end card-header -->     
              <div class="card-body p-2">
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-3">Request No</label>
                    <label class="control-label col-sm-3 font-weight-normal">{{@$mpdetail->{'Client Request No_'} }}</label>
                    <label class="control-label col-sm-3">Language Name</label>
                    <label class="control-label col-sm-3 font-weight-normal">{{@$LanguageName ? @$LanguageName:'NA' }}</label>
                    <!-- <label class="control-label col-sm-3"></label>
                    <label class="control-label col-sm-3 font-weight-normal"></label> -->
                  </div>
                  <div class="row">
                    <label class="control-label col-sm-3">MP No</label>
                    <label class="control-label col-sm-3 font-weight-normal">{{@$mpdetail->{'MP No_'} }}</label>  
                     <label class="control-label col-sm-3">Ministry Head</label>
                    <label class="control-label col-sm-3 font-weight-normal">{{@$mpdetail->{'Ministry Head'} }}</label>
                  </div>
                  <div class="row">
                    <label class="control-label col-sm-3">Client Name</label>
                    <label class="control-label col-sm-3 font-weight-normal">{{ @$mpdetail->{'Client Name'} ?@$mpdetail->{'Client Name'}:'NA'}}</label>
                    <label class="control-label col-sm-3">Ministry Name</label>
                    <label class="control-label col-sm-3 font-weight-normal">{{@$MinistryName }}</label>
                  </div>
                  <div class="row">
                    <label class="control-label col-sm-3">Plan Budget</label>
                    <label class="control-label col-sm-3 font-weight-normal" > {{ @$ODBudget ? @round(@$ODBudget):'NA' }} </label>
                    <label class="control-label col-sm-3">Actual Amount</label>
                    <label class="control-label col-sm-3 font-weight-normal"> {{ @$npActualAmt }} </label>
                  </div>
                </div>
        <div class="row">
          <div class="col-md-12" style="">
            <div class="card card-default">  
            <div class="card-header">
             <STRONG style="color: #0072C6;">Selected media agency </STRONG>
            <div class="card-tools">
            </div>
          </div>
          <!-- /.end card-header -->     
              <div class="card-body p-2">
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="myTable" >
              <thead>
                <tr>
                  <th scope="col" >S.No</th>
                  <th scope="col" >MP No.</th>
                  <th scope="col" >Agency Code</th>
                  <th scope="col" >Agency Name</th>
                  <!-- <th scope="col" >Language</th> -->
                  <th scope="col" >State Name</th>
                  <th scope="col" >City</th>
                  <th scope="col" >Category</th>
                   <th scope="col" >Amount</th> 
                </tr>
                </thead>
                 <tbody>
                  @forelse($results as $key=>$result)
                    <tr>
                      <td>{{ $results->firstItem() + $key }}</td>
                      <td>{{ @$result->{'Document No_'} }} </td>
                      <td>{{ @$result->{'Agency Code'} }} </td>
                      <td>{{ @$result->{'Agency Name'}  }} </td> 
                      <td>{{ @$result->{'State Name'}  }} </td>
                      <td>{{ @$result->{'City'}  }} </td>
                      @if(@$result->{'Category'}==0)
                      <td>{{ 'BIG'  }} </td>
                      @elseif(@$result->{'Category'}==1)
                       <td>{{ 'MEDIUM'  }} </td>
                       @elseif(@$result->{'Category'}==2)
                       <td>{{ 'SMALL'  }} </td>
                       @endif
                        <td>
                        @php
                        $budgate=@$ODBudget; 
                        $amount=@$result->{'Amount'};
                        $per=($amount/$budgate)*100;
                        @endphp
                       
                         {{ @number_format(@$result->{'Amount'})  }} ( {{ @number_format($per,2).'%' }})    
                        </td> 
                    </tr>
                  @empty
                      <tr style="background:silver"><td colspan="8" ><strong style="padding-left: 279px;">No Data</strong></td></tr>
                  @endforelse
                </tbody>  
              </table>
            </div>
            <div class="d-block" style="width:100%; float: left;">
              <span class="float-right"> 
              {{$results->links('pagination::bootstrap-4')}}
            </span> 
            </div>
              <form id= "client_comment">
                <div class="form-group">
                  <div align="center" class="alert alert-success"></div>
                  <div align="center" class="alert alert-danger"></div>
                <div class="row">
                <label class="control-label col-sm-3 offset-sm-2 align-right" for="fname">Agree/Return With Comment:</label>
                <span id ="aggreValidation" style="color:red"></span>
                <div class="col-sm-4">
                  <select {{$disabled}} id ="Consent" name="Consent" class="form-control">
                    <option value="">---Select---</option>
                    <option value="0" {{ @$mpdetail->{'Client Consent'}==0 ? 'selected':'' }}>Agree</option>
                    <option value="1" {{ @$mpdetail->{'Client Consent'}==1 ? 'selected':'' }}>Return With Comment</option>
                   </select>
                </div>
              </div>
            </div>
             <div class="form-group" id="comment">
                <div class="row">
                <label class="control-label col-sm-3 offset-sm-2 align-right" for="fname">Comment</label>
                <div class="col-sm-4">
                  <span id ="remarkValidation" style="color:red"></span>
                  <textarea {{$disabled}} cols="25" rows="3" class="form-control" name="Comment" id="Comment">{{ @$mpdetail->{'Client Remarks'} ?? '' }}</textarea>
                </div>
              </div>
            </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6 offset-sm-5">
                   @if($disabled =='')
                     <a class="btn btn-primary " onclick='SaveComment("{{ @$mpdetail->{"MP No_"}  }}");' >Send to Boc</a>@endif
                 <input type="hidden" id ="mpno" name ="mpno" value="">
                  </div>
                </div>
              </div>  
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->       
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
@endsection

@section('custom_js')
<script >
    $(document).ready(function () {
      $("#comment").hide();
      var value=$("#Consent").val();
         if(value==1){

              $("#comment").show();
         }
         else{
          $("#Comment").val('');
          $("#comment").hide();
         }
         if(value==0){
        $('#aggreValidation').html('');
      }
      $("#Consent").change(function(){
         var value=$("#Consent").val();
         if(value==1){

              $("#comment").show();
         }
         else{
          $("#Comment").val('');
          $("#comment").hide();
         }
         if(value==0){
        $('#aggreValidation').html('');
      }

      });

    });


    </script>
    <script type="text/javascript">
      
  $('#Comment').keyup(function(){
     
      if($('#Comment')!=''){
         $('#remarkValidation').html('');
      }
  });
  function SaveComment(mpno='') {
    var Consent=$('#Consent').val();
    var Comment=$('#Comment').val();
    if(Consent==''){
      $('#aggreValidation').html('Please Select any One');
      return false;
    }
    console.log(Comment);
    if(Comment=='' && Consent!=0 ){
      $('#remarkValidation').html('Please Enter Comments');
      return false;
    }
    if(mpno!=''){
      $('#mpno').val(mpno);

    }
     var formData =new FormData($('#client_comment')[0]);
     $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },       
        type: "POST",
        url: "{{Route('ODMediaPlan.store')}}",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {
          if (data.success == true) {
            
              $('.alert-success').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-success').fadeOut("slow");
                //window.location.reload();
              }, 5000 ); 
          }
          if (data.success == false) {
              $('.alert-danger').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-danger').fadeOut("slow");
              }, 5000 );

          }
        },
        error: function(error) {

          console.log('error');
        }
      });
    
   
  }
    $('.alert-danger').fadeOut();
    $('.alert-success').fadeOut();
    </script>
    @endsection
