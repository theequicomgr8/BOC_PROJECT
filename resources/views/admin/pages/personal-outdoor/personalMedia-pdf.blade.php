<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Release Order cum Bill List</title>
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
$response=isset($response)? $response:'';
@endphp

<body>
    <div class="card-body">
        <h5 style="margin-left:250px"><i class="fa fa-user" aria-hidden="true"></i>Personal Media List</h5>
        <div style="overflow-x: auto;">
            <table width="100%" border="1" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Reference</th>
                        <th>Email</th>
                        <th>Sub category</th>
                        <th>Mobile</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Agreement</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personalpdf as $key => $perpdf )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                {{ $perpdf->media_id }}
                            </td>
                            <td>
                                {{ $perpdf->ho_email }}
                            </td>
                            <td>
                                <a href="#" sub-cat-id="{{ $perpdf->media_id }}" class="text-info sub-modal" id="" data-toggle="modal" data-target="#myModal2">View</a></td>
                            <td>
                                {{ $perpdf->mobile }}
                            </td>
                            <td>
                                <a href="rate-settlement-personal-media/{{ $perpdf->media_id }}" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-eye" style="font-size:30px;color:blue"></i></a>

                            </td>
                            <td>
                                 @if($perpdf->to_date >=$today)
                                    {{'Active'}}
                                @else
                                <a href="personal-renewal/{{ $perpdf->media_id }}" style="text-decoration: none;color: blue;">Renewal </a>
                                @endif
                            </td>
                            <td>
                                <a href="personal-fileupload/{{ $perpdf->media_id }}" style="text-decoration: none;color: blue;">Agreement</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

