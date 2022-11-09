@extends('layouts.CommonLayout')
@section('content')
<section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div style="margin-top:4%; margin-bottom:3%">  
        <h4 style="text-align:center">Create your dailyShop Account</h4>  
        <br>     
            <div class="row">
              <div class="col-md-2"></div>
                <div class="col-md-8 panel panel-default" style="padding:2% 4% 2%">
                        <div class="aa-myaccount-login">
                            <form class="aa-login-form" action="{{ route('registered') }}" method="post" id="form" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="result">
                                    <!-- @if(Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif -->
                                    
                                    @if(Session::get('fail'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif
                                </div>
                                    <div class="form-group">
                                        <label for="">Username<span>*</span></label>
                                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter your username" value="{{old('userName')}}">
                                        <span class="text-danger">@error('userName') {{ $message }} @enderror</span>
                                        <span class="text-danger" id="userNameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email<span>*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{old('email')}}">
                                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                        <span class="text-danger" id="emailError"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Password<span>*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control pwd" placeholder="Enter your password">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                            </span>          
                                        </div>
                                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                        <span class="text-danger" id="passwordError"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Phone Number<span>*</span></label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="{{old('phone')}}">
                                        <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                                        <span class="text-danger" id="phoneError"></span>
                                    </div>

                                    <div class="form-group" id="district">
                                        <label for="">District<span>*</span></label>
                                        <select class="form-control" name="district">
                                            <option>District</option>
                                        </select>
                                        <span class="text-danger">@error('district') {{ $message }} @enderror</span>
                                    </div>
                                     
                                    </div>
                                    <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="">Date Of Birth<span>*</span></label>
                                        <input type="date" class="form-control" id="DOB" name="DOB" value="{{ old('DOB') }}">
                                        <span class="text-danger">@error('DOB') {{ $message }} @enderror</span>
                                        <span class="text-danger" id="DOBError"></span>
                                    </div>

                                    <div class="form-group">
                                        <input style="margin:10px 0" class="form-check-input" type="radio" name="gender" id="gender" value="Male" {{(old('gender') == 'Male') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="Male">Male</label>
                                        <input style="margin-left:50px" class="form-check-input" type="radio" name="gender" id="gender" value="Female" {{(old('gender') == 'Female') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="Female">Female</label>
                                        <input style="margin-left:50px" class="form-check-input" type="radio" name="gender" id="gender" value="Custom" {{(old('gender') == 'Custom') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="custom">Custom</label>
                                        <div class="text-danger">@error('gender') {{ $message }} @enderror</div>
                                        <span class="text-danger" id="genderError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="Address">Address<span>*</span></label>
                                        <textarea class="form-control" rows="3" id="address" name="address" placeholder="Enter Your Address">{{ old('address') }}</textarea>
                                        <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                                        <span class="text-danger" id="addressError"></span>
                                    </div> 

                                    <button class="btn btn-block default" type="submit" id="do">SIGN UP</button>
                                    <hr>
                                    <div style="text-align:center">Or, sign up with</div>
                                    <button class="btn btn-block btn-primary" type="submit">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                        &nbsp &nbsp Facebook</button>
                                    <button class="btn btn-block btn-danger" type="submit">
                                        <i class="fa fa-google" aria-hidden="true"></i>  
                                        &nbsp &nbsp Google</button>
                                    <div class="aa-register-now" style="text-align:center; margin-top:100px">
                                        Already member? &nbsp<a href="{{route('login')}}"><span class="text-primary">Login</span>&nbsp here</a>
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

    $(document).ready(function(){
        $.ajax({

            url:"https://bdapis.herokuapp.com/api/v1.1/districts/",

            complete:function(xmlHttp, status){

                if(xmlHttp.status==200){
                    
                    str="";
                    var data = xmlHttp.responseJSON.data;
                
                    for(var i=0; i<data.length; i++){
                        if(data[i].district == "Dhaka"){
                            str+="<option selected value="+data[i].district+">"+data[i].district+"</option>"
                            continue;
                        }
                        str+="<option value="+data[i].district+">"+data[i].district+"</option>"
                    }
                    $("#district select").html(str);
                }else{
                    alert(xmlHttp.statusText);
                }

            }

        })

    })

    $(".reveal").on('click',function() {
        var $pwd = $(".pwd");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });

    $(".reveal2").on('click',function() {
        var $pwd = $(".pwd2");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });

    $("#do").click(function(){
        var n=0, cc=false;
        var a = $("#phone").val();
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (filter.test(a)) {
            cc=true;
        }
        if($("#userName").val()==""){
            $("#userNameError").text("You can't leave this empty.");
            n++;
        }
        if($("#email").val()==""){
            $("#emailError").text("You can't leave this empty.");
            n++;
        }
        if($("#password").val()==""){
            $("#passwordError").text("You can't leave this empty.");
            n++;
        }
        
        if(!cc){
            if(a.length!=11){
                $("#phoneError").text("Number is invalid.");
            }
            if($("#phone").val()==""){
                $("#phoneError").text("You can't leave this empty.");
            }
            n++;
        }
        if($("#DOB").val()==""){
            $("#DOBError").text("You can't leave this empty.");
            n++;
        }
        if($('input[name="gender"]:checked').val()==null){
            $("#genderError").text("You can't leave this empty.");
            n++;
        }
        if($('#address').val()==""){
            $("#addressError").text("You can't leave this empty.");
            n++;
        }
        if(n>0){
            return false;
        }
    });

</script>


@stop