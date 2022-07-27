<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        select,
        input[type="text"],
        textarea,
        input[type="email"] {
            width: 100%;
            padding: 3px;
        }

        table.maintable {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin-left: 10%;
        }

        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
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

        .eyecolor {
            color: #007bff !important;
        }

        .iframemargin {
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

        .alert-info-msg {
            color: green;
        }

        .alert-info-msg2 {
            color: red;
        }

        #blink {
            font-size: 18px;
            color: red;
            transition: 0.5s;
            text-align: center;
        }

        .vtext {
            font-weight: bold;
            font-size: 13px;
        }

    </style>
</head>

<body>
    <div class="container pt-4">
        <h4 class="text-left" style="text-align: center;"><u>Evaluation of Technical Bid for Bid Hoarding</u>

            @if (@$pdfdown != 'downloadpdf')
            <a href="{{ url('bidHoarding-export-pdf/' . Request::segment(2)) }}" id="download"
                style="background:#006799; color:#fff; text-decoration:none; font-size:16px; border-radius: 15px; font-family: sans-serif; padding:8px 20px; text-transform: uppercase;">Download</a>
                @endif
        </h4>
        <p style="text-align: center;">A. Detail of company<a href="{{ URL::to('bidHoarding') }}" title="Home"
                class="pull-right"><i class="fa fa-home" style="font-size:30px;"></i></a></p>

        <form Method="post" action="{{ url('/company-details') }}" enctype="multipart/form-data" id="company_details">
            @if(Session::has('message'))
            <div class="alert alert-success" style="margin-left: 142px;color: green;">
            {{session('message')}}
           </div>
           @endif
            @csrf
            <table class="table table-bordered maintable">
                <thead>
                    <tr>
                        <th class="col-1">S No.</th>
                        <th class="col-3">Description</th>
                        <th colspan="5">Documents</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Name of Agency <font class="text-danger">*</font>
                        </td>
                        <td colspan="5">
                            <div class="form-group">
                                <label for="">{{ $bid_hoarding_data->agency_name }}</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bid Security declaration</td>
                        <td colspan="5">
                            <label for="">
                                {{ $bid_hoarding_data->bid_security == 1 ? 'YES' : 'NO' }} </label>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Head office with telephone no. & email(Ownership document of premises/ rent agreement and
                            electricity bill of past six month)</td>
                        <td colspan="5">
                            <table width="100%">
                                <tr>
                                    <td width="39%" class="vtext">State:</td>
                                    <td><label for="">{{ $bid_hoarding_data->headoffice_state }}</label></td>
                                </tr>
                                <tr>
                                    <td class="vtext">Address:</td>
                                    <td><label for="">{{ $bid_hoarding_data->headoffice_address }}</label></td>
                                </tr>
                                <tr>
                                    <td class="vtext">Telephone no.:</td>
                                    <td><label for="">{{ $bid_hoarding_data->headoffice_telephone }}</label></td>
                                </tr>
                                <tr>
                                    <td class="vtext">Email:</td>
                                    <td><label for="">{{ $bid_hoarding_data->headoffice_email }}</label></td>
                                </tr>
                                <tr>
                                    <td class="vtext">Contact person:</td>
                                    <td><label for="">{{ $bid_hoarding_data->headoffice_contact_person }}</label></td>
                                </tr>
                                <tr>
                                    <td class="vtext">Whether electricity bill of past six months submitted:
                                    </td>
                                    <td><label for="">{{ $bid_hoarding_data->headoffice_electricity_bill }}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="vtext">Whether head office owned or rented:</td>
                                    <td>
                                        <label for="companyName" class="mr-2 col-form-label-sm"></label><br />
                                        {{ (($bid_hoarding_data->headoffice_owned_rented == 0? 'Owned': $bid_hoarding_data->headoffice_owned_rented == 1)? 'Rented': $bid_hoarding_data->headoffice_owned_rented == 2)? 'Document not submitted': '' }}
                                        <label for=""></label>
                                    </td>
                                </tr>
                            </table>
    </div>
    </td>
    </tr>
    <td>4</td>
    <td>Branch office with tel no. Ownership document of premises/ rent agreement and electricity bill of past six month
    </td>
    <td colspan="5">
        <table id="dynamicTable" width="100%">
            @if (count($branch_office_data) > 0)
                @foreach ($branch_office_data as $branch_office)
                    <tr>
                        <td width="39%" class="vtext">State:</td>
                        <td>
                            <option value="">{{ $branch_office->branchoffice_state }}</option>
                        </td>
                    </tr>
                    <tr>
                        <td class="vtext">Address:</td>
                        <td><label for="">{{ $branch_office->branchoffice_address }}</label></td>
                    </tr>
                    <tr>
                        <td class="vtext">Telephone no.:</td>
                        <td>{{ $branch_office->branchoffice_telephone }}</td>
                    </tr>
                    <tr>
                        <td class="vtext">Email:</td>
                        <td>{{ $branch_office->branchoffice_email }}</td>
                    </tr>
                    <tr>
                        <td class="vtext">Contact person:</td>
                        <td>{{ $branch_office->branchoffice_contact_person }}</td>
                    </tr>
                    <tr>
                        <td class="vtext">Whether electricity bill of past six months submitted:</td>
                        <td>
                            <label>
                                {{ $branch_office->branchoffice_electricity_bill == 1 ? 'YES' : 'NO' }} </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="vtext">Whether head office owned or rented:</td>
                        <td>
                            <label for="companyName" class="mr-2 col-form-label-sm"></label><br />
                            {{ (($branch_office->branchoffice_owned_rented == 1 ? 'Owned': $branch_office->branchoffice_owned_rented == 2)? 'Rented': $branch_office->branchoffice_owned_rented == 3)? 'Document not submitted': '' }}
                            <label for=""></label>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>No data</tr>
            @endif
        </table>
        <div></div>
    </td>
    <tr rowspan="2">
        <td rowspan="6">5</td>
        <td rowspan="6">Legal Status of company</td>
        <th colspan="4">Document</th>
        <th>Yes/No</th>
    </tr>
    <tr>
        <td colspan="4">1. Certificate Of Incorporation:</td>
        <td>
            <label>
                {{ $bid_hoarding_data->legal_document_certificate == 1 ? 'YES' : 'NO' }}
            </label>
        </td>
    </tr>
    <tr>
        <td colspan="4">2. GST Registration Certificate:
            @if($bid_hoarding_data->legal_document_gst_registration == 1)<br>&nbsp;&nbsp;&nbsp; @endif
        </td>
        <td>
            <label>
                {{ $bid_hoarding_data->legal_document_gst_registration == 1 ? 'YES' : 'NO' }}
                @if($bid_hoarding_data->legal_document_gst_registration == 1)
                <label>{{$bid_hoarding_data->gst_number}}</label>
            @endif
            </label>
        </td>
    </tr>
    <tr>
        <td colspan="4">3. PAN/TAN Card:
            @if($bid_hoarding_data->legal_document_pan == 1)<br><br>&nbsp;&nbsp;&nbsp; @endif
        </td>
        <td>
            <label>
                {{ $bid_hoarding_data->legal_document_pan == 1 ? 'YES' : 'NO' }}
            </label><br>
            @if($bid_hoarding_data->legal_document_pan == 1)
                <label>{{$bid_hoarding_data->pan_card}}</label>
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="4">4. Registration of Startup:</td>
        <td>
            <label>
                {{ $bid_hoarding_data->legal_document_whether_startup == 1 ? 'YES' : 'NO' }}
            </label>
        </td>
    </tr>
    <tr>
        <td colspan="4">5. Any Other document:</td>
        <td>
            <label>
                {{ $bid_hoarding_data->legal_document_other == 1 ? 'YES' : 'NO' }}
            </label>
        </td>
    </tr>
    <tr>
        <td>6</td>
        <td>Total years of experience in display of Hoarding in applied state/s</td>
        <td colspan="5">
            <label for="">{{ $bid_hoarding_data->total_years_experience }}</label>
        </td>
    </tr>
    <tr>
        <td rowspan="5">7</td>
        <td rowspan="5">Work order of past three years (Hoarding only)</td>
        <td>F Year</td>
        <td>Qty. of POs</td>
        <td>Qty. of hoardings </td>
        <td>Amount (in rupees)</td>
        <td>Remarks</td>
    </tr>
    <tr>
        <td>2018-19</td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2018_19_qty_pos }}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2018_19_qty_hording }}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2018_19_amount }}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2018_19_remarks }}</label>
            </div>
        </td>
    </tr>
    <tr>
        <td>2019-20</td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2019_20_qty_hording }}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2019_20_amount }}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2019_20_amount }}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2019_20_remarks }}</label>
            </div>
        </td>
    </tr>
    <tr>
        <td>2020-21</td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2020_21_qty_pos}}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2020_21_qty_hording }}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2020_21_amount }}</label>
            </div>
        </td>
        <td>
            <div class="form-group">
                <label for="">{{ $bid_hoarding_data->work_order_2020_21_remarks }}</label>
            </div>
        </td>
    </tr>
    <td></td>
    </tr>
    <tr rowspan="2">
        <td rowspan="3">8</td>
        <td rowspan="3">Annual turnover of FY 2019-20 and 2020-21 (notarized copy of annual return/CA certified return)
        </td>
        <td colspan="4"> FY 2019-20 </td>
        <td> {{ $bid_hoarding_data->annual_turnover_2019_20_rs }}</td>
    </tr>
    <tr>
        <td colspan="4">FY 2020-21</td>
        <td> Rs. {{ $bid_hoarding_data->annual_turnover_2020_21_rs }}</td>
    </tr>
    <tr>
        <td colspan="4"> If Startup, DPIIT certificate no.:</td>
        <td>
            <label for="">{{ $bid_hoarding_data->annual_turnover_startup_dpiit }}</label>
        </td>
    </tr>

    {{-- <tr rowspan="2">
                  <td>9</td>
                  <td>Name of state</td>
                  <td colspan ="5">
                    <label for="">{{$bid_hoarding_data->headoffice_state}}</label>
                </td>
               </tr> --}}

    <td>9</td>
    <td>Details of authorized access of hoardings (state wise)</td>
    <td colspan="5">
        <table id="dynamicTable" width="100%">
            @if (count($details_authorized_data) > 0)

                @foreach ($details_authorized_data as $details_authorized)
                    {{-- <tr>
                        <td width="39%" class="vtext">Name of state</td>
                        <td>
                            <label>{{ $details_authorized->details_authorized_state }}
                            </label>
                        </td>
                    </tr> --}}

                    <tr>
                        <td width="39%" class="vtext">Whether document supporting access to more than 50
                            hoardings submitted?</td>
                        <td width="39%" class="vtext">
                            <option value="">{{ $details_authorized->details_authorized_document_support == 1 ? 'YES' : 'NO' }}
                            </option>
                        </td>
                    </tr>
                    <tr>
                        <td class="vtext">Whether Geo tagged location submitted in CD/Pendrive</td>
                        <td width="39%" class="vtext"><label
                                for="">{{ $details_authorized->details_authorized_geo_tagged == 1 ? 'YES' : 'NO' }}</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="vtext">Hard copy of list of location</td>
                        <td width="39%" class="vtext">
                            {{ $details_authorized->details_authorized_list_location == 1 ? 'YES' : 'NO' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>No data</tr>
            @endif
        </table>
        <div></div>
    </td>
    <tr>
        <td>10</td>
        <td>Flex/vinyl printing:
            Printing capacity of the company – Own printing machine/Vendor (Proof of own machine/vendor)</td>
        <td colspan="5">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>Document supporting own printing machine submitted?</td>
                    <td>{{ $bid_hoarding_data->flex_own_printing == 1 ? 'YES' : 'NO' }}</td>
                </tr>
                <tr>
                    <td>Document supporting rented printing machine submitted?</td>
                    <td>{{ $bid_hoarding_data->flex_rented_printing == 1 ? 'YES' : 'NO' }}</td>
                </tr>
                <tr>
                    <td>Address of printing press</td>
                    <td>{{ $bid_hoarding_data->flex_address}}</td>
                </tr>
                <tr>
                    <td>Remarks</td>
                    <td>{{ $bid_hoarding_data->flex_remarks }}</td>
                </tr>
            </table>
        </td>

        </td>

        </tbody>
        </table>
        {{-- <div class="row">
            <div class="form-group col-9"></div>
            <div class="form-group col-3">
                {{-- <input type="submit" class="form-control form-control-sm btn btn-success" name="Print" id="submit_id" placeholder="Please enter Agreement with other vendor"> --}}
            </div>
        </div>
        <form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        setTimeout(function() {
            $('.alert-success').fadeOut("slow");

        }, 3000);
    </script>
    </body>
</html>
