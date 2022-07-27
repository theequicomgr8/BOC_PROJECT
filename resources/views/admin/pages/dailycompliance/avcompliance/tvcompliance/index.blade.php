@extends('admin.layouts.layout')
<style>
    body {
        color: #6c757d !important;
    }

</style>
@section('content')
    @php
    $results = isset($response) ? $response : '';
    @endphp
    {{-- {{dd('tvcompliancePdf/'.request()->complianceType[0]);}} --}}
    <div class="content-inside p-3">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <div class="row">
                    <div class="m-0" style="color: #007bff;">
                        <i class="fa fa-user"></i> Daily Compliance Reports For AV-TV
                    </div>
                    <h6 class="m-0" style="padding-left: 418px;">
                        <a style="font-size: 13px; float:right;" class="btn btn-info" href="{{ route('tvcompliance.create') }}" id="addnew" />
                        Click to Add New Compliance </a>
                    </h6>
                    <div class="col-sm">
                        @if(Session::has('UserID'))
                            @if(request()->complianceType == 1)
                                <a href="{{ url('tvcompliancePdf/'.request()->complianceType) }}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download AVTV</a>
                            @endif
                            @if(request()->complianceType == 3)
                            <a href="{{ url('tvcompliancePdf/'.request()->complianceType) }}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download CRS</a>
                            @endif
                            @if(request()->complianceType == 0)
                            <a href="{{ url('tvcompliancePdf/'.request()->complianceType) }}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download Pvt FM</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="card-body p-2">
                    <form name="odmcsearch" id="odmcsearch" method="GET" enctype="multipart/form-data"
                        action="{{ Route('tvcompliance.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Compliance Type</label>
                                    <select name="complianceType" id="complianceType" class="form-control form-control-sm">
                                        <option value="">Select Compliance Type</option>
                                        <option value="1" {{ request()->complianceType == 1 ? 'selected' : '' }}>AV TV
                                        </option>
                                        <option value="3" {{ request()->complianceType == 3 ? 'selected' : '' }}>Community
                                            Radio Station</option>
                                        <option value="0" {{ request()->complianceType == 0 ? 'selected' : '' }}>Private FM
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-control-label">&nbsp;</label>
                                    <input type="submit" class="btn btn-block btn-primary btn-sm">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    @php
                        if (request()->complianceType != 1) {
                            $th_name1 = 'Station Code';
                            $th_name2 = 'Broadcast';
                        }else{
                            $th_name1 = 'TV Channel';
                            $th_name2 = 'Telecast';
                        }
                    @endphp
                    <table style="" class="table table-striped table-bordered table-hover order-list" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">S.No.</th>
                                <th scope="col">RO Code</th>
                                <th scope="col">{{$th_name1}} Code</th>
                                <th scope="col">{{$th_name1}} Name</th>
                                <th scope="col">Language</th>
                                <th scope="col">State</th>
                                <th scope="col">Head Quarter</th>
                                <th scope="col">{{$th_name2}} From Date</th>
                                <th scope="col">{{$th_name2}} To Date</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $key=>$result)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $result->{'RO Code'} }}</td>
                                    <td>{{ $result->{'Agency Code'} }} </td>
                                    <td>{{ $result->{'Agency Name'} }} </td>
                                    <td>{{ $result->Name }} </td>
                                    <td>{{ $result->Description }}</td>
                                    <td>{{ $result->{'Head Quarter Name'} }}</td>
                                    <td>{{ date('Y-m-d', strtotime($result->{'Telecast_Broadcast From Date'})) }} </td>
                                    <td>{{ date('Y-m-d', strtotime($result->{'Telecast_Broadcast To Date'})) }} </td>
                                    <td>{{ $result->Remarks }} </td>
                                    @if ($result->{'AV Type'} == '1' && $result->{'Billing Status'} == '1')
                                        <td>Bill Submitted</td>
                                    @else
                                        <td style="width: 150px" align="center"><a class="m-0 font-weight-normal text-info" href="{{ route('tvcompliance.create', ['agencyCode' => $result->{'Agency Code'},'ROCode' => $result->{'RO Code'},'avtype' => $result->{'AV Type'}]) }}" class="editMember"><i class="fa fa-user-plus"></i> Submit Bill</a></td>
                                        {{-- <td  style="width: 150px"align="center"><a class="m-0 font-weight-normal text-primary" href="{{route('tvcompliance.create', ['agencyCode'=>$result->{'Agency Code'},'ROCode'=>$result->{'RO No_'}, 'CreativeFileName'=>$result->{'Creative File Name'},'givenAmount'=>round($result->{'Amount'}),'totaladvtSize'=>round($result->{'advtSize'}),'cpublishedDate'=>date('Y-m-d', strtotime($result->{'Publishing Start Date'}))] )}}"  class="editMember"><i class="fa fa-user-plus"></i> Submit Bill</a> </td> --}}
                                    @endif
                                </tr>
                                @empty
                                <tr style="text-align: center; color: red;">
                                    <td colspan="11">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-block" style="width:100%; float: left;">
                    <span class="float-right">
                        {{-- {{$results->links('pagination::bootstrap-4')}} --}}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
