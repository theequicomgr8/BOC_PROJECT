@extends('layouts.layout')
@section('content')
<?php
$current_url = last(request()->segments());
?>


<div class="form-validation mt-20">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="text-danger text-center">{{$error}}</div>
    @endforeach
    @endif
    @if(session()->has('success_message'))
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
    @endif
    <!-- <h4>Client/ Partner Login</h4> -->
    <h4 class="text-right"> Admin Sign in </h4>

    <!-- start super admin login-->
    <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">
    <form method="POST" action="{{URL::to('admin/'.$current_url)}}" id="login-form">
        @csrf
        <div class="form-group"><i class="fa fa-user"></i>
            <input name="group_id" type="text" id="group_id" maxlength="10" class="form-control underline-input" placeholder="Enter Group ID">
        </div>
        <div class="form-group"><i class="fa fa-unlock-alt"></i>
            <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Enter Password">
        </div>
        <div class="form-group text-left">
            <input type="submit" value="Login" class="btn btn-greensea b-0 br-2 pull-right mr-0 login-form">
            <a href="{{url('admin/reset-password')}}" class="frgt">Reset Password</a>
        </div>
    </form><!-- end super admin login-->

</div>
@endsection
@section('custom_js')
<script>
$(document).ready(function () {
    $(".login-form").click(function () {
        var form = $("#login-form");
        form.validate({
            rules: {               
                group_id: {
                    required: true,
                    gstExt: true
                },
                password: {
                    required: true
                }
            },
            messages: {             
                group_id: {
                    required: "Please Fill Required Field!"
                },
                password: {
                    required: "Please Fill Required Field!",
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
        if (form.valid() === false) {
            return false;
        }
    });
});
</script>
@endsection