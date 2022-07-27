<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Download Billing Reports</title>
    <style type="text/css">
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table {
            font-size: 13px;
        }
    </style>
</head>
@php
$results=isset($response)? $response:'';
@endphp
<body>
    <div class="card-body">
        <div style="overflow-x: auto;">
            <table width="100%" border="1" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Control No.</th>
                        <th>RO Code</th>
                        {{-- <th>Version</th> --}}
                        {{-- <th>Newspaper Code</th> --}}
                        <th>Newspaper Name</th>
                        <th>Language</th>
                        <th>State</th>
                        <th>Published On</th>
                        <th>Remarks</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $key=>$result)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$result->ReferenceNo }}</td>
                        <td>{{$result->{'RO No_'} }}</td>
                        {{-- <td>{{$result->{'planVersion'} }}</td> --}}
                        {{-- <td>{{$result->{'NP Code'} }}</td> --}}
                        <td>{{$result->{'NP Name'} }}</td>
                        <td>{{$result->Language}}</td>
                        <td>{{$result->{'State Name'} }}</td>
                        <td>{{date('Y-m-d', strtotime($result->{'Publishing Date'}))}}</td>
                        <td>{{$result->{'Remarks'} }}</td>
                        <td>{{$result->{'StatusLable'} }}</td>
                    </tr>
                    @empty
                    <tr style="text-align: center; color: red;">
                        <td colspan="8">No Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>