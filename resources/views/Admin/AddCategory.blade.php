@extends('layouts.AdminLayout')

@section('content')

    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a> >
    <a style="pointer-events: none" href="">&nbsp Add Category</a>
    <div style="float:right">
        <a class="btn btn-primary" href="{{route('Home')}}">Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Add Categroy</h4>

    <form action="{{route('AddedCategory')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Add Category
                </div>
            </div>
            <div class=card-body>
                @if(Session::has('success'))
                    <div class="alert" style="background-color:#E7F0E1; color:green">
                        {{Session::get('success')}}
                    </div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert" style="background-color:#F0E1E3; color:red">
                        {{Session::get('fail')}}
                    </div>
                @endif
                <div class="form-group">
                    <input type="text" class="form-control input-square" name="categoryName" id="categoryName" placeholder="Enter Category" value="{{ old('categoryName') }}">
                    <span class="text-danger">@error('categoryName') {{ $message }} @enderror</span>
                    <span class="text-danger" id="categoryNameError"></span>
                </div>
            </div>
            <div class="card-action">
                <button id="do" class="btn btn-success rounded-0">Add Category</button>
            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $("#do").click(function(){
            if($("#categoryName").val()==""){
                $("#categoryNameError").text("You can't leave this empty.");
                return false;
            }

        })
    </script>

@stop