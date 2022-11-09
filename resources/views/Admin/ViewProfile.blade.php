@extends('layouts.AdminLayout')
@section('content')
    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a>><a style="pointer-events: none;" href="{{route('ProfileSettings')}}">&nbsp Profile</a>
    <div style="float:right">
        <a class="btn btn-info rounded-0" href="{{route('Home')}}">Go To Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Profile</h4>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Profile
                        <a class="btn btn-primary rounded-0" href="{{route('ProfileSettings')}}" style="float:right">Edit</a>
                    </div>
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
                            @if($user['picture']=="default.jpg")
                                <img src="assets/img/{{ $user['picture'] }}" class="img-thumbnail rounded-circle" style="height:90%; width:80%" alt="...">
                            @else
                                <img src="data:image/png;base64, {{ $user['picture'] }}" class="img-thumbnail rounded-circle" style="height:90%; width:80%" alt="...">
                                <!-- <button class="btn btn-primary row justify-content-center" style="float:right; border-radius: 35px;">Change Photo</button> -->
                            @endif
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
    </div>
@stop