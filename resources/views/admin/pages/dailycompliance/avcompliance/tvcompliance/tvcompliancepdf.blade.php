<!DOCTYPE html>
<html>
    @php
    $response = isset($tvcompliancePdf) ? $tvcompliancePdf : '';
    $title = 'AV TV Compliance';
    if (request()->complianceType != 1) {
        $th_name1 = 'Station Code';
        $th_name2 = 'Broadcast';
    } else {
        $th_name1 = 'TV Channel';
        $th_name2 = 'Telecast';
    }
    if (request()->complianceType == 0) {
        $title = 'Private FM';
    }
    if (request()->complianceType == 3) {
        $title = 'Community Radio station';
    }
    @endphp
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$title}}</title>
    <style type="text/css">
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table {
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="card-body">
        <h5 style="margin-left:250px"><i class="fa fa-user" aria-hidden="true"></i>{{$title}}</h5>
        <div style="overflow-x: auto;">
            <table width="100%" border="1" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">RO Code</th>
                        <th scope="col">{{$th_name1}} Code</th>
                        <th scope="col">{{$th_name1}} Name</th>
                        <th scope="col">Language</th>
                        <th scope="col">State</th>
                        <th scope="col">Head Quarter</th>
                        <th scope="col">{{$th_name2}} From Date</th>
                        <th scope="col">{{$th_name2}} To Date</th>
                        <th scope="col">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($response as $key=>$result)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $result->{'RO Code'} }}</td>
                            <td>{{ $result->{'Agency Code'} }} </td>
                            <td>{{ $result->{'Agency Name'} }} </td>
                            <td>{{ $result->Name }}</td>
                            <td>{{ $result->Description }}</td>
                            <td>{{ $result->{'Head Quarter Name'} }}</td>
                            <td>{{ date('Y-m-d', strtotime($result->{'Telecast_Broadcast From Date'})) }} </td>
                            <td>{{ date('Y-m-d', strtotime($result->{'Telecast_Broadcast To Date'})) }} </td>
                            <td>{{ $result->Remarks }} </td>
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
