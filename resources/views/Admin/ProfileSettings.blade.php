@extends('layouts.AdminLayout')
@section('content')
    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a>><a style="pointer-events: none;" href="{{route('ProfileSettings')}}">&nbsp Account Settings</a>
    <div style="float:right">
        <a class="btn btn-primary rounded-0" href="{{route('UploadPhoto')}}">Change Profile Photo</a>&nbsp
        <a class="btn btn-info rounded-0" href="{{route('ChangePassword')}}">Change Password</a>&nbsp
        <a class="btn btn-primary rounded-0" href="{{route('Home')}}">Go To Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Account Settings</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Profile info</div>
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <h6><b>Name : </b><span>{{$user['name']}}</span></h6>
                            </div>
                            <div class="form-group">
                                <h6><b>Username : </b><span>{{$user['userName']}}</span></h6>
                            </div>
                            <div class="form-group">
                                <h6><b>Position : </b><span style="color:#5680E9">{{$user['userType']}}</span></h6>
                            </div>
                            <div class="form-group">
                                <h6><b>Email : </b><span>{{$user['email']}}</span></h6>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                            @if($user['picture']=="default.jpg")
                                <img src="assets/img/{{ $user['picture'] }}" class="img-thumbnail rounded-circle" style="height:90%; width:90%" alt="...">
                            @else
                                <img src="data:image/png;base64, {{ $user['picture'] }}" class="img-thumbnail rounded-circle" style="height:90%; width:90%" alt="...">
                                <!-- <button class="btn btn-primary row justify-content-center" style="float:right; border-radius: 35px;">Change Photo</button> -->
                            @endif
                            </div>
                            <!-- <div class="form-group" style="text-align:center; color:black">
                                <button class="btn btn-warning">Change</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <h6><b>Phone number : </b><span>{{$user['phone']}}</span></h6>
                    </div>
                    <div class="form-group">
                        <h6><b>Address : </b><span>{{$user['address']}}</span></h6>
                    </div>
                    <div class="form-group">
                        <h6><b>District : </b><span>{{$user['district']}}</span></h6>
                    </div>								
                </div>
                <div class="card-action">

                </div>
            </div>
        </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update profile info</div>
                    </div>
                    <div class="card-body">
                    <form action="{{route('UpdateProfile')}}" method="post">
                        @csrf
                        @if(Session::get('success'))
                            <div class="alert" style="background-color:#E7F0E1; color:green">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert" style="background-color:#F0E1E3; color:red">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control input-square" id="name" name="name" value="{{$user['name']}}">
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            <span class="text-danger" id="userNameError"></span>
                        </div>	
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control input-square" id="email" name="email" value="{{$user['email']}}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                            <span class="text-danger" id="emailError"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control input-square" id="phone" name="phone" value="{{$user['phone']}}">
                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                            <span class="text-danger" id="phoneError"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea class="form-control" rows="3" id="address" name="address" value="Address">{{ $user["address"] }}</textarea>
                            <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                            <span class="text-danger" id="addressError"></span>
                        </div>
                        <div class="form-group" id="district">
                            <label for="">District<span>*</span></label>
                            <select class="form-control" name="district">
                                <option>District</option>
                            </select>
                            <span class="text-danger">@error('district') {{ $message }} @enderror</span>
                        </div>									
                        </div>
                        <div class="card-action">
                            <button id="do" class="btn btn-success rounded-0">Update</button>
                        </div>
                    </form>    
                </div> 
            </div>
        </div>
    </div>

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

            $("#do").click(function(){
                var n=0, cc=false;
                var a = $("#phone").val();
                var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
                if (filter.test(a)) {
                    cc=true;
                }
                if($("#name").val()==""){
                    $("#userNameError").text("You can't leave this empty.");
                    n++;
                }
                if($("#email").val()==""){
                    $("#emailError").text("You can't leave this empty.");
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
                if($('#address').val()==""){
                    $("#addressError").text("You can't leave this empty.");
                    n++;
                }
                if(n>0){
                    return false;
                }
            });

        })

    </script>

@stop