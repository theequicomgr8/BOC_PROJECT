@extends('admin.layouts.wallayout')

@section('content')
<!DOCTYPE html>
<html>
<head>
<style>
/* table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 80%;
  margin-left: 10%;
} */

td, th {
  border: 1px solid #dddddd;

}
body {
    color: #6c757d !important;
  }

  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }

  .input-group-text {
    height: 32px !important;
  }

  .custom-file-label {
    height: 32px !important;
    overflow: hidden;
  }

  .custom-file-label::after {
    height: 30px !important;
  }

  .input-group-text {
    font-size: 0.8rem !important;
  }

  .flexview {
    display: inline-flex;
  }
  .eyecolor{
    color: #007bff !important;
  }
  .iframemargin{
    margin-bottom: -50px;
  }
  .fieldset-border {
    width: 100%;
    border: solid 1px #ccc;
    border-radius: 5px;
    margin: 0 10px 15px 10px;
    padding: 0 15px;
}
.fieldset-border legend {
  width: auto;
  background: #fff;
  padding: 0 10px;
  font-size: 14px;
  font-weight: 600;
  color: #3d63d2;
}
.subheading {
  font-size: 16px;
  font-weight: 500;
  color: #4066d4;
  border-bottom: solid 1px #4066d4;
  margin-bottom: 15px;
}
.divmargin {
  margin-top: 19px;
}

.alert-info-msg{
  color: green;
}
.alert-info-msg2{
  color: red;
}

#blink {
  font-size: 18px;
  color: red;
  transition: 0.5s;
  text-align: center;
}
</style>
</head>
   <body>
      <div class="container pt-4">

         <h6 class="text-center"><u>Evaluation of technical bid for wall painting / Digital wall painting</u> <a href="{{ url('wallPainting-export-pdf/'.Request::segment(2)) }}" id="download" style="background:#006799; color:#fff; text-decoration:none; font-size:16px; border-radius: 15px; font-family: sans-serif; padding:8px 20px; text-transform: uppercase;">Download</a></h6>

         <p class="text-left">A. Detail of company<a href="{{ URL::to('wallPainting') }}" title="Home" class="pull-right"><i class="fa fa-home" style="font-size:30px;"></i></a>
      
         <br />
      </p>
      @if(Session::has('msg'))
      <div class="alert alert-success">
      <strong>Success!</strong> {{Session::get('msg')}}
      </div>
      @endif
         <form Method="post" action="{{ url('/company-details') }}" enctype="multipart/form-data" id="company_details">
         @csrf
         <table class="table table-bordered">
            <thead>
               <tr style="background-color: #dddddd;">
                  <th width="80">S No.</th>
                  <th>Description</th>
                  <th colspan ="4">Documents</th>
               </tr>
            </thead>
            <tbody>
            <tr>
                  <td>1</td>
                  <td>Tender number</td>
                  <td colspan ="6">
                     <div>
                        <label for="">{{ @$wall_print_data->Tender_number }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Name of Agency <font class="text-danger">*</font></td>
                  <td colspan ="4">
                     <div>
                        <label for="">{{ $wall_print_data->name_of_agency }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Bid Security declaration</td>
                  <td colspan ="4">
                     <label for="">
                     {{ $wall_print_data->bid_security_declaration == 1 ? "YES" : "NO" }}
                     </label>
                  </td>
               </tr>
               <tr>
                  <td>4</td>
                  <td>Head office with Head office email</td>
                  <td colspan ="4">
                     <div>
                        <label for="">{{ $wall_print_data->head_office_email }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>5</td>
                  <td>Ownership documents premises / rent agreement and electricity bill of past six months</td>
                  <td colspan ="4">
                     <div>
                       <label for=""><a href="{{ asset('uploads/CompanyDetails/'.$wall_print_data->ownership_document_rent_agreement) }}" target="_blank">View Document</a></label>
                        <!-- <a href="pdfname">View Document</a> -->
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>6</td>
                  <td>Branch office with telephone number</td>
                  <td colspan ="4">
                     <div>
                        <label for="">{{$wall_print_data->branch_telephone ?? ''}}</label>
                     </div>
                  </td>
               </tr>

               <tr rowspan="2">
                  <td rowspan="6">7</td>
                  <td rowspan="6">Legal Status of company</td>
                  <th colspan ="3">Document</th>
                  <th>Yes/No</th>
               </tr>
               <tr>
                  <td colspan ="3">1. Certificate Of Incorporation:</td>
                  <td>
                     <div>
                        <label>{{$wall_print_data->certificate_incorporation == 1?"YES":"NO"}}
                        </label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">2. GST Registration Certificate:</td>
                  <td>
                     <div class="form-group">
                     <label>{{$wall_print_data->gst_certificate == 1 ? "YES" :"NO"}}
                        </label>
                        <br />
                        @if($wall_print_data->gst_certificate == 1)
                        <label for="">{{$wall_print_data->gst_number ?? ''}}</label>
                        @endif
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">3. PAN/TAN Card:</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->Pan_tan_card == 1 ? "YES" : "NO"}}</label>
                        <br />
                        @if($wall_print_data->Pan_tan_card == 1)
                        <label for="">{{$wall_print_data->pan_card ?? ''}}</label>
                        @endif
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">4. Registration of Startup:</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->registration_startup == 1 ? "YES" : "NO"}}</label>
                        <br />
                        @if($wall_print_data->registration_startup == 1)
                        <label for="">{{$wall_print_data->registration_startup_input ?? ''}}</label>
                        @endif
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">5. Any Other document:</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->other_document == 1 ? "YES" : "NO" }}</label>
                        <br />
                        @if($wall_print_data->other_document == 1)
                        <label for=""><a href="{{ asset('uploads/CompanyDetails/'.$wall_print_data->other_document_file) }}" target="_blank">View Document</a></label>
                        @endif
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>8</td>
                  <td>Area of work (name of state/city)</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->area_work_name_state_city }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">9</td>
                  <td rowspan="2">Details of past work executed (state wise)- 50,0000 sq.ft each state for wall painting</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->details_of_past_work_wall_painting }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="4">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->details_of_past_work_digital_painting }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">10</td>
                  <td rowspan="2">Total Year of experience in wall painting / Digital Wall Painting in applied state</td>
                  <td colspan="4">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->details_of_past_work_wall_painting }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="4">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->total_years_exp_digital_painting}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="12">11</td>
                  <td rowspan="12">Annual turn over of FY 2019-20 and 2020-21 (notarized copy of annual return / CA certified return)</td>
                  <td rowspan="3">a. FY 2019-20</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group">
                       <label for="">{{ $wall_print_data->annual_turn_2019_20_wp }}</label>
                     </div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->annual_turn_2019_20_dwp }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">b. FY 2020-21</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->annual_turn_2020_21_wp}}</label>
                     </div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->annual_turn_2020_21_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">b. FY 2021-22</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->annual_turn_2021_22_wp}}</label>
                     </div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->annual_turn_2021_22_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">c. If start-up, DPIIT Certificate no.</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->startup_certificate_wp}}</label>
                     </div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                    <div class="form-group">
                        <label for="">{{$wall_print_data->startup_certificate_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="5">12</td>
                  <td rowspan="5">work order of past three years (wall painting only)</td>
                  <td>F Year</td>
                  <td>Area Of Painting (in sq.ft)</td>
                  <td>Amount in Rs.</td>
                  <td>WP/DWP not specified</td>
               </tr>
               <tr>
                  <td>2018-19</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2018_19_area_of_painting}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2018_19_amt_rs}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2018_19_wp_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2019_20_area_of_painting}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2019_20_amt_rs}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2019_20_wp_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2020_21_area_of_painting}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2020_21_amt_rs}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2020_21_wp_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <td>2021-22</td>
               <td>
                  <div class="form-group">
                    <label for="">{{$wall_print_data->work_past_three_2021_22_area_of_painting}}</label>
                  </div>
               </td>
               <td>
                  <div class="form-group">
                    <label for="">{{$wall_print_data->work_past_three_2021_22_amt_rs}}</label>
                  </div>
               </td>
               <td>
                  <div class="form-group">
                     <label for="">{{$wall_print_data->work_past_three_2021_22_wp_dwp}}</label>
                  </div>
               </td>
               </tr>
               <tr>
                  <td rowspan="5">13</td>
                  <td rowspan="5">work order of past three years (wall painting only)</td>
                  <td>F Year</td>
                  <td>Area Claimed as painted</td>
                  <td colspan="2">Area Marked with GST</td>
               </tr>
               <tr>
                  <td>2018-19</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2018_19_area_claimed}}</label>
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2018_19_area_gst}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2019_20_area_claimed}}</label>
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2019_20_area_gst}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2020_21_area_claimed}}</label>
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2020_21_area_gst}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2021-22</td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2021_22_area_claimed}}</label>
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2021_22_area_gst}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">14</td>
                  <td rowspan="2">Painting Printing capacity of the campany - Own Printing machine /Vendor (Proof of own machine /Vendor)</td>
                  <td colspan="2">Own Printing machine:<br />
                     <b>a.</b> Premises Ownership/Rent agreement<br />
                     <b>b.</b> Machine details with purchase invoice
                  </td>
                  <td colspan="2">
                  @if($wall_print_data->Premises_Ownership_Rent_agreement != "")
                  <br />
                        <label for=""><a href="{{ asset('uploads/CompanyDetails/'.$wall_print_data->Premises_Ownership_Rent_agreement) }}" target="_blank">View Document</a></label><br />
                        @endif
                        @if($wall_print_data->purchase_invoice_file != "")
                        <label for=""><a href="{{ asset('uploads/CompanyDetails/'.$wall_print_data->purchase_invoice_file) }}" target="_blank">View Document</a></label>
                        @endif
                  </td>
               </tr>
               <tr>
                  <td colspan="2">Agreement with other vendor: <br />
                     <b> a.</b> Copy of agreement <br />
                     <b> b.</b> copies of bill
                  </td>
                  <td colspan="2">
                  @if($wall_print_data->Copy_of_agreement_file != "")
                  <br />
                        <label for=""><a href="{{ asset('uploads/CompanyDetails/'.$wall_print_data->Copy_of_agreement_file) }}" target="_blank">View Document</a></label><br />
                        @endif
                        @if($wall_print_data->copy_of_bill_file != "")
                        <label for=""><a href="{{ asset('uploads/CompanyDetails/'.$wall_print_data->copy_of_bill_file) }}" target="_blank">View Document</a></label>
                        @endif
                  </td>
               </tr>
                <!-- <tr>
                  <td colspan="6">
                     <div class="form-group">
                        <button class="btn btn-info">Print</button>
                     </div>
                  </td>
               </tr> -->
            </tbody>
         </table>
         <form>
      </div>
<script>
    setTimeout(function() {
        $('.alert-success').fadeOut("slow");

    }, 3000);
</script>
</body>
</html>
@endsection
