<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
  <!-- CSRF Token -->
  <title>CBC</title>
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="{{ asset('theme/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('theme/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('theme/css/responsive.css')}}">
  <link href="{{ asset('theme/dist/css/font-awesome.min.css')}}" rel="stylesheet" />


</head>

<body>
    @php 
  $current_url = last(request()->segments());
  if($current_url=='vendor-login'){
    $frmVal='vendor-form-validation';
    $lginfooter='vendor-footer';
 }else if($current_url=='client-login'){
    $frmVal='client-form-validation';
    $lginfooter='client-footer';
 }else if($current_url=='rob-login'){
    $frmVal='rob-form-validation';
    $lginfooter='rob-footer';
 }
  @endphp
  <div id="app">
    <div id="wrap" class="animsition backlayer" style="opacity: 1;">
      <header class="layerLeft">
        <div class="logo text-left"><a href=""><img alt="" src="{{URL::to('theme/images/logo.png')}}" title=""></a></div>
      </header>
    </div>
  @if($current_url=='vendor-login' || $current_url=='vendor-signup' || $current_url=='reset-password' || $current_url=='forgot-password'|| $current_url=='submitotp' || $current_url=='signup_confirm' || $current_url=='set-password' || $current_url=='tam-login' || $current_url=='resendotp' || $current_url =='login')
    <div class="bg-video-wrap"> 
            <video src="{{ asset('theme/images/vendor-login-bg.mp4')}}" loop muted autoplay>
            </video>
     </div>
     <div class="overlay-video"></div>
  @endif

  @if($current_url=='rob-login')
    <div class="bg-video-wrap"> 
            <video src="{{ asset('theme/images/vendor-login-bg.mp4')}}" loop muted autoplay>
            </video>
     </div>
     <div class="overlay-video"></div>
  @endif
  @if($current_url=='client-login')
    <div class="bg-video-wrap"> 
            <video src="{{ asset('theme/images/client-login-bg.mp4')}}" loop muted autoplay>
            </video>
     </div>
     <div class="overlay-video"></div>
  @endif


    <div class="lgt-frm adt-cd">
      <div id="wrap" class="animsition backlayer" style="opacity: 1;">
        <div class="container-fluid">
          <div class="layerRight col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-login">
              <div class="login-page float-right {{@$frmVal}}">
                <!-- <main class="py-4"> -->
                @yield('content')
                <!-- </main> -->
              </div>
              <!--end client / vendor login-->
            </div>
          </div>
        </div>
      </div>
      <footer class="loginfooter-lgn {{@$lginfooter}}">
        
        @if($_SERVER['REQUEST_URI'] != '/rob-login')
            @if($_SERVER['REQUEST_URI'] == '/client-login')
            <div class="btn-group fm1">
                                    <a role="button" href="{{URL::to('ministry-wise-client-list')}}">
                                        Ministry wise client code
                                    </a> 
                                </div>

                                &nbsp; | 
            @endif
                            <div class="btn-group fm2">
                                <a role="button" data-toggle="dropdown" class="btn dropdown-toggle" href="javascript:void(0)">
                                    Policies & Guidelines:
                                </a>
                                 <ul class="dropdown-menu fm2-0" role="menu" aria-labelledby="dropdownMenu">  
                                    <li class="fm2-1"><a class="dropdown-item" target="_blank" tabindex="-1" href="{{URL::to('uploads/footer_document/PrintMedia/Print Media Advertisement Policy2O2O.pdf')}}">Print</a></li>

                                    <li class="dropdown-submenu fm2-3"><a class="dropdown-item" href="#">AV Media</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">  
                                            <li class="dropdown-submenu">
                                                <a class="dropdown-item" tabindex="-1" href="#">
                                                    Community Radio Station
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" tabindex="-1" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Community Radio Station (CRS)2020.pdf')}}">Guidelines of CRS</a></li>
                                                    <li><a class="dropdown-item" target="_blank" tabindex="-1" href="{{URL::to('uploads/footer_document/AVMedia/Revision in the guidelines of Empanelment of Community Radio Station2022.pdf')}}">Revision guidelines of CRS </a></li>
                                                </ul>
                                            </li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Pvt. FM Stations2020.pdf')}}">Guidelines of  PVt. FM</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Guidelines for Empanelment of AV Producers2011.pdf')}}">Guidelines of AV Producers</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Pvt. C&S TV Policy Guidelines January 2019.pdf')}}">Guidelines of AV TV</a></li>
                                         </ul>
                                    </li>

                                    <li class="dropdown-submenu fm2-2"><a class="dropdown-item" href="#">Outdoor</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">  
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/Outdoor/Policy Guidelines for Outdoor & Personal Media2021.pdf')}}">Outdoor & Personal Media</a></li>
                                         </ul>
                                    </li>

                                    
                                    <li class="dropdown-submenu fm2-4"><a class="dropdown-item" href="#">New Media</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">  
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Bulk SMS & Other Value Added Services2020.pdf')}}">Guidelines of Bulk SMS</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment & Engagement of Social Media Platforms2020.pdf')}}">Guidelines of Social Media</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment and Rate Fixation for Central Govt. Advertisements on Internet Websites2016.pdf')}}">Guidelines of Internet websites</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment of Digital Cinema2019.pdf')}}">Guidelines of Digital Cinema</a></li>
                                         </ul>
                                    </li>
                                    <li class="dropdown-submenu fm2-5"><a class="dropdown-item" href="#">Print Publisher</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">  
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Empanelment of Offset PrintersDiary Makers & Digital Printers2018.pdf')}}">Guidelines of  Digital Printers</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Guidelines for empanelment of Offset Printers and Diary Makers with DAVP 2018.pdf')}}">Guidelines of Offset Printer & Diary Makers</a></li> 
                                         </ul>
                                    </li>
                                 </ul>
                                 
                            </div>
                             &nbsp; | &nbsp;   
                            <div class="btn-group fm3">
                                  <a role="button" data-toggle="dropdown" class="btn dropdown-toggle" href="javascript:void(0)">
                                    Advisories 
                                </a> 
                                 <ul class="dropdown-menu fm2-0" role="menu" aria-labelledby="dropdownMenu">  
                                    <li class="fm2-1"><a class="dropdown-item" target="_blank" tabindex="-1" href="{{URL::to('uploads/footer_document/PrintMedia/Print Media Advertisement Policy2O2O.pdf')}}">Print</a></li>
                                    <li class="dropdown-submenu fm2-3"><a class="dropdown-item" href="#">AV Media</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">  
                                            <li class="dropdown-submenu">
                                                <a class="dropdown-item" tabindex="-1" href="#">
                                                    Community Radio Station
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" target="_blank" tabindex="-1" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Community Radio Station (CRS)2020.pdf')}}">Guidelines of CRS</a></li>
                                                    <li><a class="dropdown-item" target="_blank" tabindex="-1" href="{{URL::to('uploads/footer_document/AVMedia/Revision in the guidelines of Empanelment of Community Radio Station2022.pdf')}}">Revision guidelines of CRS </a></li>
                                                </ul>
                                            </li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Pvt. FM Stations2020.pdf')}}">Guidelines of  PVt. FM</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Guidelines for Empanelment of AV Producers2011.pdf')}}">Guidelines of AV Producers</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Pvt. C&S TV Policy Guidelines January 2019.pdf')}}">Guidelines of AV TV</a></li>
                                         </ul>
                                    </li>
                                    
                                    <li class="dropdown-submenu fm2-2"><a class="dropdown-item" href="#">Outdoor</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">  
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/Outdoor/Policy Guidelines for Outdoor & Personal Media2021.pdf')}}">Outdoor & Personal Media</a></li>
                                         </ul>
                                    </li>
                                    
                                    <li class="dropdown-submenu fm2-4"><a class="dropdown-item" href="#">New Media</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">  
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Bulk SMS & Other Value Added Services2020.pdf')}}">Guidelines of Bulk SMS</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment & Engagement of Social Media Platforms2020.pdf')}}">Guidelines of Social Media</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment and Rate Fixation for Central Govt. Advertisements on Internet Websites2016.pdf')}}">Guidelines of Internet websites</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment of Digital Cinema2019.pdf')}}">Guidelines of Digital Cinema</a></li>
                                         </ul>
                                    </li>
                                    <li class="dropdown-submenu fm2-5"><a class="dropdown-item" href="#">Print Publisher</a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">  
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Empanelment of Offset PrintersDiary Makers & Digital Printers2018.pdf')}}">Guidelines of  Digital Printers</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Guidelines for empanelment of Offset Printers and Diary Makers with DAVP 2018.pdf')}}">Guidelines of Offset Printer & Diary Makers</a></li> 
                                         </ul>
                                    </li>
                                 </ul>
                                 
                            </div> 
                            
                              <?php 
            if($_SERVER['REQUEST_URI'] == '/vendor-login' || $_SERVER['REQUEST_URI'] == '/vendor-signup' || $_SERVER['REQUEST_URI'] == '/reset-password' || $_SERVER['REQUEST_URI'] == '/forgot-password' || $_SERVER['REQUEST_URI'] == '/submitotp' || $_SERVER['REQUEST_URI'] == '/signup_confirm' || $_SERVER['REQUEST_URI'] == '/set-password' || $_SERVER['REQUEST_URI'] == '/resendotp')
            {
            ?>
            @if($_SERVER['REQUEST_URI'] == '/vendor-login' || $_SERVER['REQUEST_URI'] == '/vendor-signup' || $_SERVER['REQUEST_URI'] == '/reset-password' || $_SERVER['REQUEST_URI'] == '/forgot-password'|| $_SERVER['REQUEST_URI'] == '/submitotp'|| $_SERVER['REQUEST_URI'] == '/signup_confirm'|| $_SERVER['REQUEST_URI'] == '/tam-login'|| $_SERVER['REQUEST_URI'] == '/resendotp')
            &nbsp; | &nbsp; 
                            <div class="btn-group fm5">
                                <a id="dLabel" role="button" data-toggle="dropdown" class="btn dropdown-toggle" href="javascript:void(0)">
                                    Empaneled Vendors
                                </a>
                                 <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                    <li><a class="dropdown-item" href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Digital Cinema Vendors.xlsx')}}">Digital Cinema Vendors</a></li>
                                    <li><a class="dropdown-item" href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Print Vendors.xlsx')}}">Print Vendors</a></li>
                                    <li><a class="dropdown-item" href="{{URL::to('tv-channel-list')}}">TV Channels</a></li>  
                                    <!-- <li><a class="dropdown-item" href="{{URL::to('uploads/footer_document/VendorsEmpaneled/TV Channels.xlsx')}}">TV Channels</a></li>   -->
                                    <li><a class="dropdown-item" target="_blank" href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Websites.pdf')}}">Websites</a></li>  
                                 </ul>
                            </div> 
            @endif
                <?php   
            }
          ?>
         
          @if($_SERVER['REQUEST_URI'] == '/client-login')
           &nbsp; | &nbsp; 
          <div class="btn-group fm4">
                                <a role="button" target="_blank" href="{{URL::to('uploads/footer_document/ClientFAQs.pdf')}}">
                                    FAQs
                                </a> 
                            </div>
        @elseif($_SERVER['REQUEST_URI'] == '/vendor-login' || $_SERVER['REQUEST_URI'] == '/vendor-signup' || $_SERVER['REQUEST_URI'] == '/reset-password' || $_SERVER['REQUEST_URI'] == '/forgot-password' || $_SERVER['REQUEST_URI'] == '/submitotp' || $_SERVER['REQUEST_URI'] == '/signup_confirm' || $_SERVER['REQUEST_URI'] == '/resendotp')
        &nbsp; | &nbsp; 
        <div class="btn-group fm6">
                <a role="button" target="_blank" href="#">
                   Vendor FAQs
                </a> 
            </div>
        @endif
                              &nbsp; 
                            |
        @endif
                 <!-- <a class="explogologinpg" href="#">Managed by BECIL </a> -->
        <span class="pull-left"> Managed by BECIL</span>
        <span class="pull-right">Support सहायता : 9810205148</span>
      </footer>
    </div>
  </div> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{ asset('theme/dist/js/bootstrap.min.js')}}"></script>
  <!-- <script src="{{ asset('theme/js/jquery.backstretch.min.js')}} "></script>-->
  <script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{url('/js')}}/pwstrength-bootstrap.min.js"></script>
  <!-- <script>
    $.backstretch("/theme/images/bg_v2.jpg", {
      speed: 500
    });
  </script> -->

  <script>
$(".btn-group, .dropdown").hover(
                        function () {
                            $('>.dropdown-menu', this).stop(true, true).fadeIn("fast");
                            $(this).addClass('open');
                        },
                        function () {
                            $('>.dropdown-menu', this).stop(true, true).fadeOut("fast");
                            $(this).removeClass('open');
                        });
</script>

</body>

</html>
<!-- Page specific script -->
@section('custom_js')
@show