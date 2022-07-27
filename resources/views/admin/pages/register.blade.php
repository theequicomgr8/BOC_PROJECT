@extends('admin.layouts.layout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  function alphadash(event) {
    var inputValue = event.charCode;
    if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0) && (inputValue!=45)){
      event.preventDefault();
    }
  }
</script>
<?php
// $url = Request::url();
$current_url = last(request()->segments());

?>

<title>Sign up Form</title>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
<link rel="stylesheet" href="{{ asset('login/css/style.css')}}" > -->
<div class="lgt-frm adt-cd">
    <div id="wrap" class="animsition backlayer" style="opacity: 1;">



        <div class="container">
            <div class="layerRight col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-login">
                    <div class="login-page float-right">
                        <div class="form-validation mt-20"> 
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="text-danger text-center">{{$error}}</div>
                            @endforeach
                            @endif
                            <!-- <h4>Client/ Partner Login</h4> -->
                            <h4>
                                @if(last(request()->segments())=='rob-login')
                                {{'ROB-LOGIN'}}
                                @else
                                {{'Sign in/ Sign up Form'}}
                                @endif
                            </h4>
                            @if(last(request()->segments())=='rob-login')
                            <form method="POST" action="{{URL::to($current_url)}}">
                                @csrf
                                <input id="userTypeHidden" type="hidden" name="userTypeHidden"  value="{{request()->user_type}}">
                                <div class="form-group"><i class="fa fa-user"></i>
                                    <input name="email" type="text" id="email" tabindex="0" onkeypress="return alphadash(event,this);"  class="form-control underline-input" placeholder="User Name" required="required">
                                <!-- @error('email')
                                {{'Only Alpha Character'}}
                                @enderror -->
                            </div>

                            <div class="form-group"><i class="fa fa-unlock-alt"></i>
                                <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Password" required="required">
                            </div>
                            
                            <div class="form-group text-left ">
                                <button type ="submit" class="btn btn-greensea btn-block  animated-button">Login</button> 
                            </div>
                            
                        </div>
                    </form>
                    @else
                    <!-- client / vendor login-->
                    <form method="POST" action="{{URL::to($current_url)}}">
                        @csrf
                        <input id="userTypeHidden" type="hidden" name="userTypeHidden"  value="{{request()->user_type}}">
                        <div class="form-group"><i class="fa fa-user"></i>
                            <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="User Name" required="required">
                            @error('email')
                            {{'Only Alpha Character'}}
                            @enderror
                        </div>

                        <div class="form-group"><i class="fa fa-unlock-alt"></i>
                            <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Password" required="required">
                        </div>

                        <div class="form-group dp_ful captcha">
                           <!--  <span class="re flt mr10" ng-click="Captha()" style="cursor:pointer;">
                                <i class="fa fa-refresh" aria-hidden="true"></i> <span class="rand1 captcha_txt flt mr10">10</span> <span class="captcha_txt flt mr10">+</span> <span class="rand2 captcha_txt flt mr10">14</span> <span class="captcha_txt flt mr10">=</span> <span class="captcha_txt flt pull-right">
                                    <input type="text" id="" placeholder="" autocomplete="off" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" ng-model="Caltotal" only-digits="" required="">
                                </span>
                            </span> -->
                        </div>
                        <div class="form-group text-left ">

                            <input type="submit" value="Login"  class="btn btn-greensea b-0 br-2 mr-3">
                            <a href="{{url('reset-password')}}" class="frgt">Forget password?</a>
                        </div>
                    </div>

                        <!-- <div class="form-group text-left ">
                            <button type ="submit" class="btn btn-greensea btn-block  animated-button">Login</button> 
                        </div> -->
                        
                    </div>
                </form><!-- end client / vendor login-->
                @endif
            </div>
        </div>
    </div>
</div>

<footer class="loginfooter-lgn"><a class="explogologinpg" href="#">Managed by BECIL </a></footer>
</div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/js') }}/sole-right-validation.js"></script> -->


@endsection
