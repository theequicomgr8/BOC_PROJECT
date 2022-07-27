 <!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
  <meta charset="utf-8">
  <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
  <!-- CSRF Token -->
  <meta name="csrf-token1" content="{{ csrf_token() }}">
  <!-- <title>Wall Painting</title> -->
  <!-- <title>App Name - @yield('title')</title> -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">

  <link href="{{ asset('theme/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('theme/css/style.css')}}" >
  <link rel="stylesheet" href="{{ asset('theme/css/responsive.css')}}">
  <link href="{{ asset('theme/dist/css/font-awesome.min.css')}}" rel="stylesheet" />
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('/css') }}/OverlayScrollbars/OverlayScrollbars.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('/css') }}/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ url('/css') }}/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ url('/css') }}/bootstrap-colorpicker/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/css') }}/select2/select2.min.css">
  <link rel="stylesheet" href="{{ url('/css') }}/select2-bootstrap4/select2-bootstrap4.min.css">
  @section('custom_css')
  @show
</head>

<body>
  <div id="app" >
    @if(Session::get('UserID'))
    <div class="wrapper d-flex align-items-stretch">
     <!-- Start Sidebar -->
     @include('admin.layouts/header')
   </div>
   @endif
   @if(session()->missing('UserID'))

   <div id="wrap" class="animsition backlayer" style="opacity: 1;">
    <header class="layerLeft">
      <div class="logo"><a href=""><img alt="" src="{{URL::to('theme/images/logo.png')}}" title=""></a></div>
    </header>
  </div>
  <main class="py-4">
    @yield('content')
  </main>
  @endif
</div>
<script src="{{ asset('theme/js/jquery.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('theme/js/popper.js')}}"></script>
<script src="{{ asset('theme/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('theme/js/main.js')}}"></script>
<script src="{{ asset('theme/js/jquery.backstretch.min.js')}} "></script>
<!-- <script>
  $.backstretch("/theme/images/bg_v2.jpg", { speed: 500 });
</script> -->
<script src="{{ url('/js') }}/select2/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<!-- InputMask -->
<script src="{{ url('/js') }}/moment/moment.min.js"></script>
<script src="{{ url('/js') }}/inputmask/jquery.inputmask.min.js"></script>

<!-- bootstrap color picker -->
<script src="{{ url('/js') }}/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- dropzonejs -->
<!-- InputMask -->
<script src="{{ url('/js') }}/moment/moment.min.js"></script>
<script src="{{ url('/js') }}/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="{{ url('/js') }}/daterangepicker/daterangepicker.js"></script>
<!-- Page specific script -->
<script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
<!-- validation comman js  -->
<script src="{{ url('/js') }}/validation_comman.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<!--Start For ROB -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<!--End For ROB -->
</body>
</html>
<!-- Page specific script -->
@section('custom_js')
@show



