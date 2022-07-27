@extends('admin.layouts.layout')

@section('content')

<div class="content-inside p-3" style="height: 85%;">
  <div class="card shadow mb-4" style="height: 85%;">
    @if(Session::get('HeadName') == 'Dte. of Mktg. & Inspection, Bangalore')
  	<div>
  		<h5 class="text-center" style="font-weight: 800;">Welcome</h5>
      <p class="text-center">to the CBC Dashboard for </p>
  		<h5 class="text-center" style="font-weight: 600;">@if($ministry_Code->ministry_name != 'Election Commission Of India') Ministry of @endif {{$ministry_Code->ministry_name}}</h5>
  		<p class="text-center" style="color: #808080;">{{Session::get('HeadName')}}</p>
      <hr>
    </div>
    @else
    <div style="margin-top: 10%;">
      <h2 class="text-center" style="font-weight: 800;">Welcome</h2>
      <p class="text-center">to the CBC Dashboard for </p>
      <h2 class="text-center" style="font-weight: 600;">@if($ministry_Code->ministry_name != 'Election Commission Of India') Ministry of @endif {{$ministry_Code->ministry_name}}</h2>
      <p class="text-center" style="color: #808080;">{{Session::get('HeadName')}}</p>
    </div>
    @endif
    @if(Session::get('HeadName') == 'Dte. of Mktg. & Inspection, Bangalore')
    <div style="margin-top: 1%;">
      <iframe width="1024" height="612" src="https://app.powerbi.com/view?r=eyJrIjoiZjUyOGRjN2ItZmFkYy00ZTY5LWIxNzUtNzc5YzJiYTA1YTVjIiwidCI6Ijg5OTIxMGU2LTlmNTYtNDkyMS1hNTIxLWJiZjhlNzlmOWM5ZCJ9" frameborder="0" allowFullScreen="true"></iframe>  
      
  	</div>
    @endif
  </div>
 </div>
@endsection