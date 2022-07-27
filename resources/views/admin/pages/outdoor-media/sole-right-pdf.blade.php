<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Status of Media Applied</title>
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
        
        <div style="overflow-x: auto;">
            <table width="100%" border="1" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <td align="center" colspan="5"><img style="margin-top: 15px;margin-bottom: 15px;" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                            <p><strong>GOVERNMENT OF INDIA <br />
                                    CENTRAL BUREAU OF  COMMUNICATION<br />
                                    Ministry of Information & Broadcasting</strong><br />
                                Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                            </p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td align="center" colspan="5">
                        <h3 class="text-left"><u>Status of Media Applied</u></h3> 
                            </td>
                           
                        </tr>
                    <tr>
                        <th>Sr.No</th>
                        <th>Reference</th>
                        <th>Email</th>
                        <th>Sub category</th>
                        <th>Mobile</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solepdfdata as $key => $soledata)
                    <tr>
                        <td align="center">{{ $key+1 }}</td>
                        <td align="center">
                            {{ $soledata->mediaID }}
                        </td>
                        <td align="center">
                            {{ $soledata->ho_email }}
                        </td>
                        <td align="center">
                            {{ $soledata->subcat_name }}
                        </td>
                        <td align="center">
                            {{ $soledata->mobile }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</body>
</html>
