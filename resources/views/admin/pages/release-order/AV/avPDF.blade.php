<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Media Request Application Receipt</title>
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
                            <th colspan="7" style="float: right;">
                                @if(Session::get('WingType') == 4)
                                    <h4>AV TV Information</h4>
                                @endif
                                @if(Session::get('WingType') == 5)
                                    <h4>AV Radio Information</h4>
                                @endif
                                @if(Session::get('WingType') == 7)
                                    <h4>AV Producer Information</h4>
                                @endif
                            </th>
                        </tr>
                        <thead>
                            <tr>
                              <th scope="col">S.No</th>
                              <th scope="col">Creative Image</th>
                              <th scope="col">Agency Code</th>
                              <th scope="col">RO Code</th>
                              <th scope="col">Display Key</th>
                              <th scope="col">Publish On</th>
                              <th scope="col">Not After</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($avRodata as $key=>$result)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $result->{'Creative File Name'} !='' ? $result->{'Creative File Name'} : 'NA' }}</td>
                                    <td>{{ $result->{'agencyCode'} }} </td>
                                    <td>{{ $result->{'RoCode'} }}</td>
                                    <td>{{ $result->{'PlanId'} }}</td>
                                    <td>{{ date('d/m/Y', strtotime($result->{'PublishDate'})) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($result->{'PublishDate'})) }}</td>
                                </tr>
                                @empty
                                <tr style="text-align: center; color: red;">
                                    <td colspan="11">No Data</td>
                                </tr>
                            @endforelse
                       </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
