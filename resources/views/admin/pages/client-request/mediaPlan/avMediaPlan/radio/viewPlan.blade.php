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
            //echo '<pre>';
           //print_r($results);
            //@endphp
          @php 
            $mpdetail='';
            $mpdetail=isset($mpdetails)? $mpdetails:''; 
            if(@$mpdetail->{'Cl Approval Received'}==1){
            $disabled='disabled';
            }else{
            $disabled='';
          }
          //dd($mpdetail);
            @endphp



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
               <a href="{{url('radio-pdf/'.$mpdetail->{'MP No_'})}}" class="m-0 font-weight-normal text-primary float-right">
            <i class="fa fa-download"></i> Download AV-Radio Media Plan Received
               </a></p>
            <div class="card-tools">
             
            </div>
          </div>
          <!-- /.end card-header -->     
              <div class="card-body p-2">
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-3">Request No</label>
                    <label class="control-label col-sm-3 font-weight-normal"> {{ @$mpdetails->{'Client Request Code'} }} </label>
                    <label class="control-label col-sm-3"></label>
                    <label class="control-label col-sm-3 font-weight-normal"></label>
                  </div>
                  <div class="row">
                    <label class="control-label col-sm-3">MP No</label>
                    <label class="control-label col-sm-3 font-weight-normal">{{@$mpdetails->{'MP No_'} }}</label>  
                  </div>
                   <div class="row">
                    <label class="control-label col-sm-3">Ministry Name</label> 
                    <label class="control-label col-sm-3 font-weight-normal">{{ @$MinistryName }}</label>
                    <!-- <label class="control-label col-sm-3">Print Size</label>
                   
                      @if(@$mpdetails->{'Print Size Selection'} ==0)      
                        <label class="control-label col-sm-3 font-weight-normal">{{ 'Custom Size' }} </label>
                      @elseif(@$mpdetails->{'Language'} ==1)
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'Half Page' }} </label>
                      @elseif(@$mpdetails->{'Language'} ==2)
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'Full Page' }} </label>
                    
                      @endif -->

                      <label class="control-label col-sm-3">Ministry Head</label>
                    <label class="control-label col-sm-3 font-weight-normal"> {{ @$mpdetails->{'Ministry Head'} }}</label>
                    
                  </div>
                  <div class="row">
                   
                  </div>
                  <div class="row">
                    <label class="control-label col-sm-3">Client Name</label>
                    <label class="control-label col-sm-3 font-weight-normal"> {{ @$mpdetails->{'Client Name'} ?@$mpdetails->{'Client Name'}:'NA' }}</label>
                    
                    <!-- <label class="control-label col-sm-3">Color</label>
                     @if(@$mpdetails->Color == 0)
                        <label class="control-label col-sm-3 font-weight-normal">{{ 'Color' }} </label>
                       @elseif(@$mpdetails->Color == 1)
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'B/W' }} </label>
                        @else
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'NA' }} </label>
                      @endif --> 


                      <label class="control-label col-sm-3">Target Area</label>
                     @if(@$mpdetails->{'Target Area'} ==0)      
                        <label class="control-label col-sm-3 font-weight-normal">{{ 'Pan India' }} </label>
                      @elseif(@$mpdetails->{'Target Area'} ==1)
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'Specific Regional' }} </label>
                      @elseif(@$mpdetails->{'Target Area'} ==2)
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'Group Regional' }} </label>
                      @endif

                  </div>
                  <!-- <div class="row">
                    <label class="control-label col-sm-3">Target Area</label>
                     @if(@$mpdetails->{'Target Area'} ==0)      
                        <label class="control-label col-sm-3 font-weight-normal">{{ 'Pan India' }} </label>
                      @elseif(@$mpdetails->{'Target Area'} ==1)
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'Individual State' }} </label>
                      @elseif(@$mpdetails->{'Target Area'} ==2)
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'Group of States' }} </label>
                      @elseif(@$mpdetails->{'Target Area'} ==3) 
                        <label class="control-label col-sm-3 font-weight-normal"> {{ 'Cities' }} </label>
                      @endif 
                  </div> -->
                  <div class="row">
                    <label class="control-label col-sm-3">Plan Budget</label>
                    <label class="control-label col-sm-3 font-weight-normal" > {{ @$mpdetails->{'Planned Budget'} ? @round(@$mpdetails->{'Planned Budget'}):'NA' }} </label>
                    <label class="control-label col-sm-3">Actual Amount</label>
                    <!-- Amount fetch from BOC$Channel Select table sk -->
                   
                    <label class="control-label col-sm-3 font-weight-normal"> {{ @$npActualAmt  }} </label> 
                  </div>
                </div>
        <div class="row">
          <div class="col-md-12" style="">
            <div class="card card-default">  
            <div class="card-header">
             <STRONG style="color: #0072C6;">Selected News Channels </STRONG>
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
                  <th scope="col" >Channel Code</th>
                  <th scope="col">Channel Name</th>
                  <th scope="col" >Amount</th> 
                </tr>
                </thead>
                 <tbody>
                  @forelse($results as $key=>$result)
                    <tr>
                      <td>{{ $results->firstItem() + $key  }}</td>
                      <td>{{  $result->{'Document No_'}  }} </td>
                      <td>{{  $result->{'FM No_'}  }} </td>
                      <td>{{$result ->{'FM Name'} }}</td>
                       <td>
                        @php
                        $budgate=@$mpdetails->{'Planned Budget'}; 
                        $amount=@$result->{'Amount'};
                        $per=($amount/$budgate)*100;
                        @endphp
                       
                         {{ @number_format(@$result->{'Amount'})  }} ( {{ @number_format($per,2).'%' }})    
                        </td>  
                    </tr>
                  @empty
                      <tr style="background:silver"><td colspan="7" ><strong style="padding-left: 279px;">No Data</strong></td></tr>
                  @endforelse
                </tbody>  
              </table>
            </div>
            <div class="d-block" style="width:100%; float: left;">
              <span class="float-right"> 
               {{ $results->links('pagination::bootstrap-4') }}
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
                  <select {{$disabled}}  id ="Consent" name="Consent" class="form-control">
                    <option value="">---Select---</option>
                    <option value="0" {{ @$mpdetail->{'Client Consent'}==0 ? 'selected':'' }}>Agree</option>
                    <option value="1" {{ @$mpdetail->{'Client Consent'}==1 ? 'selected':'' }} >Return With Comment</option> <!--send to client 1  -->
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
                     <!-- <a class="btn btn-primary">Send to Boc</a> -->
                      @if($disabled =='')
                     <a class="btn btn-primary " onclick='SaveComment("{{ @$mpdetails->{"MP No_"}  }}");' >Send to Boc</a>
                     @endif
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
        url: "{{Route('radioMediaPlan.store')}}",
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
