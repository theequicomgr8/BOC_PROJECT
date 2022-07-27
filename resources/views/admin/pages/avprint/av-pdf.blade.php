<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Audio Video Application Receipt</title>
        <style>
        body{
        color: #6c757d !important;
        font-size:12px;
    }
    tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .tree {
                page-break-inside: avoid;
            }
    .text-size{
    text-size:10px;
    }
    table, th, td {
    border:1px solid #dee2e6;
    border-collapse: collapse;
    }
    </style>
    </head>
    <body>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%">
                    <thead>
                    <tr>
                            <td align="center" colspan="7"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                                <p><strong>GOVERNMENT OF INDIA <br />
                                        CENTRAL BUREAU OF  COMMUNICATION<br />
                                        Ministry of Information & Broadcasting</strong><br />
                                    Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                                </p>
                            </td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-striped table-bordered table-hover order-list text-size" width="100%">
                        <tr>
                            <th colspan="8" style="float: right;"><h4>Basic Information</h4></th>
                        </tr>
                        <tr>
                            <td colspan="4"><b>AV Producer ID :</b></td>
                            <td colspan="4"><?= @$avdatas['AV Producer ID'] ?></td>
                        </tr>
                        <tr>
                            @php
                            $category = '';
                            $category_arr = array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'Special Category');
                            foreach($category_arr as $key => $val){
                            if($avdatas['AV Producer Type'] == $key){
                            $category = $val;
                            }
                            }
                            @endphp
                            <td colspan="4"><b>Category Applied For :</b></td>
                            <td colspan="4"><?= $category ?? ''?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Do you Have Branch Office / Offices Other than Indicated Above in Delhi or Outside Delhi (if yes then Give Details) :</b></td>
                            <td colspan="4"><?= $avdatas['Branch Office'] == "0" ? 'No' : 'Yes' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Branch Office Address :</b></td>
                            <td colspan="4"><?= $avdatas['Branch Office Address'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Name of Organization :</b></td>
                            <td colspan="4"><?= $avdatas['Organization Name'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Office Address in Full :</b></td>
                            <td colspan="4"><?= $avdatas['Office Address'] ?></td>
                        </tr>

                        <tr>
                            <td colspan="4"><b>Name of the Executive Producers :</b></td>
                            <td colspan="4"><?= $avdatas['Executive Producer Name'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Resident Telephone :</b></td>
                            <td colspan="4"><?= $avdatas['Residential Phone'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Mobile No. :</b></td>
                            <td colspan="4"><?= $avdatas['Mobile'] ?? ''?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>E-Mail ID :</b></td>
                            <td colspan="4"><?= $avdatas['Email ID'] ?? ''?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Branch Office / Offices Other than Indicated Above in Delhi Or Outside Delhi :</b></td>
                            <td colspan="4"><?= $avdatas['Branch Office Address'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Contact Person :</b></td>
                            <td colspan="4"><?= $avdatas['Contact Person at Delhi'] ?? ''?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Phone No. :</b></td>
                            <td colspan="4"><?= $avdatas['Contact Person Phone'] ?? ''?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>If your Organization Registered Under Companies Act? :</b></td>
                            <td colspan="4"><?= $avdatas['Organization Registered'] == "0" ? 'No' : 'Yes'?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Phone No. :</b></td>
                            <td colspan="4"><?= $avdatas['Studio Phone'] ?></td>
                        </tr>
                        <tr>
                            <th colspan="8" style="float: right;"><h4>AV Producer Information</h4></th>
                        </tr>

                        <tr>
                            <td colspan="4"><b>Select Organization Type :</b></td>
                            <td colspan="4"><?= $avdatas['Org_ Type'] == "1" ? 'Partnership Firm' : 'Company'?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Select Org Legal Status:</b></td>
                            <td colspan="4">
                                <?php
                                $array = array("0" => "Private","1" => "Public","2" => "Ltd","3" => "Other");
                                if(array_key_exists($avdatas['Org_ Legal Status'],$array)){
                                echo $array[$avdatas['Org_ Legal Status']];
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Address of Partners :</b></td>
                            <td colspan="4"><?= $avdatas['Org_ Address'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Address of Directors :</b></td>
                            <td colspan="4"><?= $avdatas['Org_ Address'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Net Worth (for A/B/C Categories) :</b></td>
                            <td colspan="4"><?= round($avdatas['Net Worth']) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Details of Programme :</b></td>
                            <td colspan="4"><?= $avdatas['Program Detail'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Channel in Which Telecast/Broadcast :</b></td>
                            <td colspan="4"><?= $avdatas['Telecatst_Channel'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Date/Time of Telecast :</b></td>
                            <td colspan="4"><?= date('d/m/Y H:i A ',strtotime($avdatas['Telecast_DateTime'])) ?? '' ?></td>
                        </tr>
                        @if(@$avdatas['AV Producer Type']==0)
                        <tr>
                            <td colspan="4"><b>TRP Ratings of Programme :</b></td>
                            <td colspan="4"><?= $avdatas['TRP_Ratings'] ?? '' ?></td>
                        </tr>
                        @endif


                        @if(@$avdatas['AV Producer Type']==1)
                        <tr>
                            <td colspan="4"><b>TRP Ratings of Programme :</b></td>
                            <td colspan="4"><?= $avdatas['TRP_Ratings'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Address of Studio :</b></td>
                            <td colspan="4"><?= $avdatas['Studio Address'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Phone No :</b></td>
                            <td colspan="4"><?= $avdatas['Studio Phone'] ?? '' ?></td>
                        </tr>
                        @endif


                        @if(@$avdatas['AV Producer Type']==2)
                        <tr>
                            <td colspan="4"><b>Net Worth (for A/B/C Categories) :</b></td>
                            <td colspan="4"><?= round($avdatas['Net Worth']) ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>The number of audio-spots/jingles/video spots produced by you in the last three years :</b></td>
                            <td colspan="4"><?= $avdatas['No_ Of Audio-Spots_video'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>How many of above has been for clients other than davp/government departments :</b></td>
                            <td colspan="4"><?= $avdatas['No_ For Others'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Institution from which degree/diploma was obtained :</b></td>
                            <td colspan="4"><?= $avdatas['Institution Name'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Year in which obtained :</b></td>
                            <td colspan="4"><?= $avdatas['Degree_Diploma Year'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Area in which degree/diploma was obtained :</b></td>
                            <td colspan="4"><?= $avdatas['Degree_Diploma Area'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Award if any :</b></td>
                            <td colspan="4"><?= $avdatas['List Of Award'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Name at least one programme in the applied category which has been produced by you, along with duration :</b></td>
                            <td colspan="4"><?= $avdatas['List Of Program'] ?? '' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Any other relevant information :</b></td>
                            <td colspan="4"><?= $avdatas['Other Information'] ?? '' ?></td>
                        </tr>
                        @endif

                        <tr>
                            <th colspan="8" style="float: right;"><h4>Account Details</h4></th>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Bank Account Number for Receiving Payment :</b></td>
                            <td colspan="4"><?= $avdatas['Account No_'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Account Holder Name :</b></td>
                            <td colspan="4"><?= $avdatas['Payee Name'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>IFSC Code :</b></td>
                            <td colspan="4"><?= $avdatas['IFSC Code'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Bank Name :</b></td>
                            <td colspan="4"><?= $avdatas['Bank Name'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Branch :</b></td>
                            <td colspan="4"><?= $avdatas['Bank Branch'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>PAN No. :</b></td>
                            <td colspan="4"><?= $avdatas['PAN'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Draft No. :</b></td>
                            <td colspan="4"><?= $avdatas['DD No_'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Drawn on Bank :</b></td>
                            <td colspan="4"><?= $avdatas['DD Bank Name'] ?></td>
                        </tr>

                        <tr>
                            <th colspan="8" style="float: right;"><h4>Upload Documents</h4></th>
                        </tr>

                        <tr>
                            <td colspan="4"><b>Legal Status of Organization Copy of The Certificate of Registration May be Attached :</b></td>
                            <td colspan="4"><?= $avdatas['Legal cert_ of regist_'] == "0" ? 'No' : 'Yes' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Copy of Income-Tax Return of Last Financial Year to be Attached :</b></td>
                            <td colspan="4"><?= $avdatas['I_T Return File Name'] == "0" ? 'No' : 'Yes'?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Cancelled Cheque to be Attached :</b></td>
                            <td colspan="4"><?= $avdatas['Cancelled Cheque File Name'] == "0" ? 'No' : 'Yes' ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Bio-data of key Person of Creative Team (Please Attach Separate Sheet) :</b></td>
                            <td colspan="4"><?= $avdatas['Bio-data File Name'] == "0" ? 'No' : 'Yes' ?></td>
                        </tr>
                        <tr style="border:none !important;">
                            <td  colspan="8" height="80px">
                            <h3 align="left">I Confirm that All the Information Given by me is True and Nothing has Been Concealed.</h3>
                            <p align="right" style="margin-top:100px">Authorized Signatory / Signature</p></td>
                        </tr>
                </table>
            </div>
        </div>
    </body>
</html>
