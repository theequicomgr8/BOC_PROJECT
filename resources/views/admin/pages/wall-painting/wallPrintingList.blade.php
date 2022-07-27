@extends('admin.layouts.wallayout')

@section('content')
<?php $user_id = Session::get('UserID'); ?>
<style>
         /* .container {
         width: 100%;
         height: 50%;
         } */
        
      </style>
<div class="content-inside p-3"> 
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

                {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Wall Painting</h1>
                </div> --}}
                <div class="row">
                    <div class="col-xl-6">
                        <h4>List of Wall Painting Details</h4>
                    </div>
                    <div class="col-xl-6">
                        <a href="wall-painting" class="btn btn-info" style="float: right;"><i class="fa fa-plus"></i> Add Wall Painting</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <table class="table table-striped text-center" id="wallPaintingTable">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name of Agency</th>
                                    <th>Bid Security Declaration</th>
                                    <th>Head Office Email</th>
                                    <th>Branch Telephone</th>
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
                                        <td>{{ $vendors->name_of_agency }}</td>
                                        <td>
                                            @if($vendors->bid_security_declaration == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>{{ $vendors->head_office_email }}</td>
                                        <td>{{ $vendors->branch_telephone }}</td>
                                        <td>
                                            <a href="{{URL::to('wallPainting-view')}}/{{$vendors->id}}" title="View Details" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-eye"></i> </a>
                                            ||
                                            <a href="{{url('edit_Wall_painting/'.$vendors->id)}}" title="View Details" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-edit"></i> </a> ||
                                            <a href="{{ url('wallPainting-export-pdf/'.$vendors->id) }}" title="View Details" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> </a>
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
        $('#wallPaintingTable').DataTable();
    });
</script>
@endsection
