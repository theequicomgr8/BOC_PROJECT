@extends('admin.layouts.layout')
@section('content')
<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
        .auto-style1 {
            width: 40%;

        }
        .auto-style2 {
            width: 94px;
        }
        .auto-style3 {
            width: 94px;
            font-weight: bold;
        }
        .auto-style4 {
            /* width: 70%; */
        }
        table, td, th {
            border: 1px solid black;
        }

        .auto-style5 {
            width: 10%;
            text-align: center;
        }
        .auto-style6 {
            width: 25%;
        }
        .auto-style7 {
            width: 65%;
        }
        .auto-style9 {
            width: 25%;
            text-align: center;
        }
        .auto-style10 {
            width: 65%;
            text-align: center;
        }
    </style>
    <style>
ul.a {list-style-type: circle;}
ul.b {list-style-type: square;}
ol.c {list-style-type: upper-roman;}
ol.d {list-style-type: lower-alpha; margin-left: 20px;}
</style>
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Important instruction for empanelment form</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <!-- <div class="col-md-3"></div> -->
                <div class="col-md-12">
                    <div class="form-group">
                        <p><strong>1.</strong>   All the fields marked with (<font color="red">*</font>) are mandatory.</p>
                        <p><strong>2.</strong>   If connection is interrupted/lost or the user refreshes the page, then before the final submission data will not be saved and user has to submit again.</p>
                        <p><strong>3.</strong>   The size of the documents uploaded should not be more than 2MB.</p>
                        <p><strong>4.</strong>   All the documents should be uploaded in PDF format.</p>
                        <h6><strong>Documents to be submitted with Applications under Category A & Category C media for Outdoor and Personal Media rate applications</strong></h6>
                    </div>
                    <div>
                    <table align="center" class="auto-style4">
                    <tr>
                        <td class="auto-style5"><strong>S.No.</strong></td>
                        <td class="auto-style9"><strong>Details/ Information Required</strong></td>
                        <td class="auto-style10"><strong>Supporting Documents to be submitted</strong></td>
                    </tr>
                    <tr>
                        <td class="auto-style5">1</td>
                        <td class="auto-style6"> Company Document List</td>
                        <td class="auto-style7">i) Legal Status of Company<br />

                                                ii) Copy of Pan Number <br />

                                                iii) GST Registration Certificate</td>
                    </tr>
                    <tr>
                        <td class="auto-style5">2</td>
                        <td class="auto-style6">Account Document List</td>
                        <td class="auto-style7">i) Cancelled Cheque</td>
                    </tr>
                    <tr>
                        <td class="auto-style5">3</td>
                        <td class="auto-style6">Empanelment Document List</td>
                        <td class="auto-style7">i) Affidavit of Oath <br />

                                ii) Latest License Fees Paid <br />

                                iii) Rate Offered to CBC <br />

                                iv) Notarized Copy of Agreement</td>
                    </tr>
                  
                </table>
                <br />
                    </div>
                    <div class="form-group">
                    <p><strong>5.</strong>   With the agreement document, please specify the page no. where the details of location and media is submitted.</p>
                        <p><strong>6.</strong> Your empanelment application will be considered only after you have submitted the location images through the mobile app.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection