<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pre Rob Application Receipt</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }

        body{
            font-size:12px;
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
                                    CENTRAL BUREAU OF COMMUNICATION<br />
                                    Ministry of Information & Broadcasting</strong><br />
                                Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                            </p>
                        </td>
                    </tr>
                </thead>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Date</th>
                            <th>Village/Town</th>
                            <th>Block</th>
                            <th>District</th>
                            <th>Distance Covered(in km)</th>
                            <th>Date of last Visit</th>
                            <th>Contact Number</th>
                            <th>Program Theme</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($fetch as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ date('d/m/Y',strtotime($item->duration_activity_from_date)) }}</td>
                            <td>{{ $item->village_name }}</td>
                            <td>{{ $item->block }}</td>
                            <td>{{ $item->district }}</td>
                            <td style="text-align: center;">{{ $item->distance_covered }}</td>
                            <td>
                                @if($item->last_visit_date!='' || $item->last_visit_date!=null)
                                {{ date('d/m/Y',strtotime($item->last_visit_date)) }}
                                @else
                                {{'First Time'}}
                                @endif
                            </td>
                            <td>{{ $item->contact_no }}</td>
                            <td>{{ $item->sop_theme }}</td>
                            <td>
                                    @if($item->approve == 1)
                                    <span style="color: green;">Approve</span>
                                    @elseif($item->approve == 0)
                                    {{'Pending'}}
                                    @elseif($item->approve == 2)
                                    <span style="color: red;cursor: pointer" class="rejectdata" reject-id="{{ @$item->Pk_id }}" data-toggle="modal" data-target="#rejectmodel">Rejected</span>
                                    @endif
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</body>
</html>
