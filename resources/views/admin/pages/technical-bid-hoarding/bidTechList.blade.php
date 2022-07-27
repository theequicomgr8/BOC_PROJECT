@extends('admin.layouts.wallayout')
@section('content')
<?php $user_id = Session::get('UserID'); ?>

<div class="content-inside p-3">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">


                <div class="row">
                    <div class="col-xl-6">
                        <h4>List of Bid Hoarding Details</h4>
                    </div>
                    <div class="col-xl-6">
                        <a href="{{ URL::to('TechnicalHoarding') }}" class="btn btn-info" style="float: right;"><i class="fa fa-plus"></i> Add Bid  Hoarding</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <table class="table table-striped text-center" id="bidhoarding">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Agency Name</th>
                                    <th>Bid Security</th>
                                    <th>Head Office Address</th>
                                    <th>Headoffice Telephone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($vendor as $key => $vendors)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $vendors->agency_name }}</td>
                                        <td>
                                            @if($vendors->bid_security == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>{{ $vendors->headoffice_address }}</td>
                                        <td>{{ $vendors->headoffice_telephone }}</td>
                                        <td>
                                            <a href="{{URL::to('bidHoarding-view')}}/{{$vendors->id}}" title="View Details" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-eye"></i> View </a>
                                            <a href="{{URL::to('bidHoarding-edit')}}/{{$vendors->id}}" title="Edit Details" style="text-decoration: none;color: blue;" id="view">&nbsp;<i class="fa fa-pencil-square-o"></i>Edit</a>
                                        </td>
                                    </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
</div>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#bidhoarding').DataTable();
    });
</script>
@endsection
