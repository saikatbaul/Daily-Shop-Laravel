@extends('layouts.AdminLayout')
@section('content')

    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a> >
    <a style="text-decoration:none" href="{{route('ProfileSettings')}}">&nbsp Account Settings &nbsp</a>>
    <a style="pointer-events: none" href="">&nbsp Change Password</a>
    <div style="float:right">
        <a class="btn btn-info rounded-0" href="{{route('ProfileSettings')}}">Account Settings</a> &nbsp
        <a class="btn btn-primary rounded-0" href="{{route('Home')}}">Go To Home</a>
    </div>
    <br>
    <form action="{{ route('ChangedPassword') }}" method="post">
        @csrf
    <h4 style="margin-top:15px; margin-bottom:20px">Account Settings</h4>
    <div class="card"> 
        <div class="card-header">
            <div class="card-title">Change Password</div>
        </div>
        <div class="card-body">
            @if(Session::get('success'))
                <div class="alert" style="background-color:#E7F0E1; color:green">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::get('fail'))
                <div class="alert alert-danger" style="background-color:#F0E1E3; color:red">
                    {{ Session::get('fail') }}
                </div>
            @endif
            <div class="form-group">
                <label for="">Old Password<span>*</span></label>
                <div class="input-group">
                    <input type="password" name="oldPassword" id="oldPassword" class="form-control pwd" placeholder="Enter your password">
                    <span class="input-group-btn">
                        <button class="btn reveal" style="border-radius:0% 10% 10% 0%;background-color:white; border-color:#b8b8b8" type="button"><i class="la la-eye"></i></button>
                    </span>          
                </div>
                <span class="text-danger">@error('oldPassword') {{ $message }} @enderror</span>
                <span class="text-danger" id="oldPasswordError"></span>
            </div>	
            <div class="form-group">
                <label for="">New Password<span>*</span></label>
                <div class="input-group">
                    <input type="password" name="newPassword" id="newPassword" class="form-control pwd" placeholder="Enter new password">
                    <span class="input-group-btn">
                        <button class="btn reveal" style="border-radius:0% 10% 10% 0%;background-color:white; border-color:#b8b8b8" type="button"><i class="la la-eye"></i></button>
                    </span>          
                </div>
                <span class="text-danger">@error('newPassword') {{ $message }} @enderror</span>
                <span class="text-danger" id="newPasswordError"></span>
            </div>
            <div class="form-group">
                <label for="">Confirm Password<span>*</span></label>
                <div class="input-group">
                    <input type="password" name="newCPassword" id="newCPassword" class="form-control pwd" placeholder="Enter your password">
                    <span class="input-group-btn">
                        <button class="btn reveal" style="border-radius:0% 10% 10% 0%;background-color:white; border-color:#b8b8b8" type="button"><i class="la la-eye"></i></button>
                    </span>          
                </div>
                <span class="text-danger">@error('newCPassword') {{ $message }} @enderror</span>
                <span class="text-danger" id="newCPasswordError"></span>
            </div>
        </div>
        <div class="card-action">
            <button id="do" class="btn btn-primary">Confirm</button>
        </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
            
            $("#do").click(function(){
                var n=0;
                if($("#oldPassword").val()==""){
                    $("#oldPasswordError").text("You can't leave this empty.");
                    n++;
                }
                if($("#newCPassword").val()==""){
                    $("#newCPasswordError").text("You can't leave this empty.");
                    n++;
                }
                if($("#newPassword").val().length<4){
                    $("#newPasswordError").text("Password have to be legnth of 4.");
                    n++;
                }
                if( $("#newCPassword").val() != $("#newPassword").val() ){
                    $("#newCPasswordError").text("Password not matched.");
                    n++;
                }
                if( $("#oldPassword").val() == $("#newPassword").val() ){
                    $("#newPasswordError").text("Please type a new Passwor.");
                    n++;
                }
                if($("#newPassword").val()==""){
                    $("#newPasswordError").text("You can't leave this empty.");
                    n++;
                }
                if(n>0){
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