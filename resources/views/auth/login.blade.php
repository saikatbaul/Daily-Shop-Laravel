@extends('layouts.CommonLayout')
@section('content')
<section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div style="margin-top:4%; margin-bottom:2.5%"> 
        @if( Request::get('id') != 0 )
        <h4 style="text-align:center">Welcome to dailyShop! Please login.</h4>  
        @else
        <h4 style="text-align:center">Welcome! Please Login to continue.</h4>
        @endif
        <br>     
            <div class="row">
              <div class="col-md-2"></div>
                <div class="col-md-8 panel panel-default" style="padding:2% 4% 2%">
                        <div class="aa-myaccount-login">
                            <form class="aa-login-form" action="{{ route('check') }}" method="post" id="form" novalidate>
                                @csrf
                                @if(Request::has('ids') && Request::has('idd') )
                                <input type="hidden" name='ids' value="{{Request::get('ids')}}">
                                <input type="hidden" name='idd' value="{{Request::get('idd')}}">
                                @endif
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="result">
                                    @if(Session::get('fail'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif
                                </div>
                                    <label for="">Username or Email address<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="Username or email" name="user" id="user" value="{{ Session::get('user') }}">
                                    <span class="text-danger">@error('user') {{ $message }} @enderror</span>
                                    <span class="text-danger" id="userError"></span>
                                    <p id="user" class="text-danger"></p>
                                    
                                    <div class="form-group">
                                        <label for="">Password<span>*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control pwd" placeholder="password">
                                            <span class="input-group-btn">
                                                <button class="btn reveal" style="border-radius:0% 10% 10% 0%;background-color:white; padding-top:9.15px; border-color:#b8b8b8" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                            </span>          
                                        </div>
                                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                        <span class="text-danger" id="passwordError"></span>
                                    </div>	
                                    <div style="text-align:right"><a class="text-primary" href="#">Forgotten password?</a></div>
                                    </div>
                                    <div class="col-sm-6">
                                    <br>
                                    <button class="btn btn-block default" type="submit" id="do">Login</button>
                                    <hr>
                                    <div style="text-align:center">Or, login with</div>
                                    <a href="{{ route('LoginWithFacebook') }}" class="btn btn-block btn-primary">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                        &nbsp &nbsp Facebook</a>
                                    <a href="{{ route('LoginWithGoogle') }}" class="btn btn-block btn-danger">
                                        <i class="fa fa-google" aria-hidden="true"></i>  
                                        &nbsp &nbsp Google</a>
                                    <div class="aa-register-now" style="text-align:center; margin-top:18px">
                                        Don't have an account?<a href="{{route('register')}}"><span class="text-primary">Register now!</span></a>
                                    </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $("#do").click(function(){
        if($("#user").val()=="" && $("#password").val()==""){
            $("#userError").text("You can't leave this empty.");
            $("#passError").text("You can't leave this empty.");
            return false;
        }
        if($("#user").val()==""){
            $("#userError").text("You can't leave this empty.");
            $("#passError").text("");
            return false;
        }
        if($("#password").val()==""){
            $("#passError").text("You can't leave this empty.");
            $("#userError").text("");
            return false;
        }
    });

    $(".reveal").on('click',function() {
                var $pwd = $(".pwd");
                if ($pwd.attr('type') === 'password') {
                    $pwd.attr('type', 'text');
                } else {
                    $pwd.attr('type', 'password');
                }
            });

</script>


@stop