@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }
</style>
<div class="content-wrapper">
    {{-- <link href="{{asset('arogi/css/override_style.css')}}" rel="stylesheet" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Pre Event List </h6> 
      
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"></h1>
              </div><!-- /.col -->
              <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
              </div> -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
    </div>
@php
$rob_name=Session::get('UserName');
$name=substr($rob_name,4,20);
$usertype=Session::get('UserType'); 
if($usertype=='2')
{
    $user='ROB';
}
else
{
    $user='FOB';
}
@endphp
<section class="content">
    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="row form-actions float-right">
                   
                </div>
                    <table class="table table-striped text-center" id="example">
                        <thead class="custom-shorting-header">
                            <tr>
                                <th>Sr.No</th>
                                <th>Theme of Activity/Programme </th>
                                <th>Duration of the Event</th>
                                <th>Category Of Programme Activity</th>
                                <th>Venue</th> <!-- Region -->
                                <th>Activity</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($data as $key => $list)
                           <tr>
                               <td>{{$key+1}}</td>
                               <td>{{$list->sop_theme}}</td>
                               <td>{{date("d-m-Y", strtotime($list->duration_activity_from_date))}}
                                    {{date("d-m-Y", strtotime($list->duration_activity_to_date))}}
                                <!-- {{$list->duration_activity_from_date}} {{$list->duration_activity_to_date}} -->
                                </td>
                               <td>
                                @php
                                if($list->programme_activity==1)
                                {
                                    $programme_activity='Programme Activites(under ICOP) under DCID fund of M/O I&B';
                                }
                                elseif($list->programme_activity==2)
                                {
                                    $programme_activity='Programme Activites on SAP under DCID fund of M/O I&B';
                                }
                                elseif($list->programme_activity==3)
                                {   
                                    $programme_activity='Programme Activites under Establishment fund';
                                }
                                elseif($list->programme_activity==4)
                                {
                                    $programme_activity='Programme Activites (ICOP) for other Ministries';
                                }
                                elseif($list->programme_activity==5)
                                {
                                    $programme_activity='Programme Activites (Other than ICOP) for other Ministries';
                                }
                                elseif($list->programme_activity==6)
                                {
                                    $programme_activity='Programme Activites(other than ICOP) under DCID fund of M/O I&B';
                                }
                                @endphp
                                {{$programme_activity}}
                                </td>
                               <td>{{$list->region_id}}</td>
                               <td>
                                  @php
                                  $activity=[];
                                  if($list->engagement_pre_event_activity==1)
                                  {
                                    $activity=[];
                                    $activity[]='ENGAGEMENT';
                                  }

                                  elseif($list->nukkad_natak_pre_event_activity==1 || $list->public_meeting_pre_event_activity==1 || $list->public_announcement_pre_event_activity==1 || $list->distribution_pamphlets_pre_event_activity==1 || $list->social_media_pre_event_activity==1 || $list->other_media_pre_event_activity==1)
                                  {
                                    $activity=[];
                                    if($list->nukkad_natak_pre_event_activity==1)
                                    {
                                        $activity[]='NUKKAD NATAK';
                                    }
                                    if($list->public_meeting_pre_event_activity==1)
                                    {
                                        $activity[]='PUBLIC MEETING';
                                    }
                                    if($list->public_announcement_pre_event_activity==1)
                                    {
                                        $activity[]='PUBLIC ANNOUNCEMENTS';
                                    }
                                    if($list->distribution_pamphlets_pre_event_activity==1)
                                    {
                                        $activity[]='DISTRIBUTION OF PAMPHLETS';
                                    }
                                    if($list->social_media_pre_event_activity==1)
                                    {
                                        $activity[]='SOCIAL MEDIA CAMPAIGN';
                                    }
                                    if($list->other_media_pre_event_activity==1)
                                    {
                                        $activity[]='OTHER';
                                    }
                                  }

                                  elseif($list->nukkad_natak1_pre_event_activity==1 || $list->public_meeting1_pre_event_activity==1 || $list->public_announcement1_pre_event_activity==1 || $list->distribution_pamphlets1_pre_event_activity==1 || $list->social_media_campaign1_pre_event==1 || $list->public_rally_pre_event_activity==1 || $list->media_briefing_pre_event_activity==1 || $list->dd_air_curtain_pre_activity==1 || $list->social_media_campaign_pre_event==1 || $list->other_media_campaign_pre_event==1)
                                  {
                                    $activity=[];
                                    if($list->nukkad_natak1_pre_event_activity==1)
                                    {
                                        $activity[]='NUKKAD NATAK';
                                    }
                                    if($list->public_meeting1_pre_event_activity==1)
                                    {
                                        $activity[]='PUBLIC MEETING';
                                    }
                                    if($list->public_announcement1_pre_event_activity==1)
                                    {
                                        $activity[]='PUBLIC ANNOUNCEMENTS';
                                    }
                                    if($list->distribution_pamphlets1_pre_event_activity==1)
                                    {
                                        $activity[]='DISTRIBUTION OF PAMPHLETS';
                                    }
                                    if($list->social_media_campaign1_pre_event==1)
                                    {
                                        $activity[]='SOCIAL MEDIA CAMPAIGN';
                                    }
                                    if($list->public_rally_pre_event_activity==1)
                                    {
                                        $activity[]='PUBLIC RALLY IN NEARBY VILLAGE/TOWNS';
                                    }
                                    if($list->media_briefing_pre_event_activity==1)
                                    {
                                        $activity[]='MEDIA BRIEFING';
                                    }
                                    if($list->dd_air_curtain_pre_activity==1)
                                    {
                                        $activity[]='DD/AIR SCROLL/CURTAIN RAISERS';
                                    }
                                    if($list->social_media_campaign_pre_event==1)
                                    {
                                        $activity[]='SOCIAL MEDIA CAMPAIGN';
                                    }
                                    if($list->other_media_campaign_pre_event==1)
                                    {
                                        $activity[]='OTHER';
                                    }
                                  }
                                  
                                  $act=implode(',',$activity);

                                  @endphp 
                                  {{@$act}}
                               </td>
                               <td>
                                    @if($list->approve == 1)
                                     <span style="color:green">Approved</span>
                                    @else
                                        <span style="color:red">Rejected</span>
                                    @endif
                               </td>
                               <td>

                                @if($list->approve == 1)
                                    <a href="{{URL::to('approve-rejected/0/').'/'.$list->Pk_id}}" title="Reject" style="color:red"><i class="fa fa-times" aria-hidden="true"></i></a>
                                   
                                @else
                                    <a href="{{URL::to('approve-rejected/1/').'/'.$list->Pk_id}}" title="Approve" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a>
                                @endif
                               </td>
                               <td>
                                  <!-- adglistview -->
                                    <a href="post-form/{{$list->Pk_id}}" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-eye" style="font-size:20px;color:blue"></i></a>
                               </td>
                           </tr>
                           
                           @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</section>

<!-- <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
<script src="{{('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/datafetch.js')}}" type="text/javascript"></script> -->



@endsection





