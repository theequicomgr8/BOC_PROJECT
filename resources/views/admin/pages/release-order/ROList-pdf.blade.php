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
        <h5 style="margin-left:250px"><i class="fa fa-user" aria-hidden="true"></i>Release Order cum Bill List</h5>
        <div style="overflow-x: auto;">
            <table width="100%" border="1" style="border-collapse: collapse;">
                <thead>
                    <tr>
                      <th scope="col">S.No</th>
                      {{-- <th scope="col" >Creative Image</th> --}}
                      <th scope="col">NP Code</th>
                       <th scope="col">MP Version</th>
                      <th scope="col" >RO Code</th>
                      <th scope="col" >Display Key</th>
                      <th scope="col" >Publish On</th>
                      <th scope="col" >Not After</th>

                    </tr>
                  </thead>
                <tbody>
                    @forelse($response as $key=>$res)
                    <tr>
                        <td>{{$key + 1}}</td>
                        {{-- <td>

                            @if($res->{'Crative File Name'} == "")
                              NA
                            @else
                            <img src="{{ storage_path('uploads/client-request/'.$res->{'Crative File Name'}) }}" style="width: 50px; height: 50px">
                            @endif
                            </td> --}}
                        <td>{{$res->npcode}}</td>
                        <td>{{$res->planVersion}}</td>
                        <td>{{$res->RoCode}} </td>
                        <td>{{$res->RoCode}} </td>
                        <td>{{date('d/m/Y', strtotime($res->PublishDate))}} </td>
                        <td>{{date('d/m/Y', strtotime($res->PublishDate))}} </td>
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
