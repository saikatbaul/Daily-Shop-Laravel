@extends('layouts.AdminLayout')

<style>
    /* Image Designing Propoerties */
    .thumb {
        height: 200px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    }
    .cc{
        color: white;
    }
</style>


@section('content')

<a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a> >
    <a style="text-decoration:none" href="{{route('ProfileSettings')}}">&nbsp Account Settings &nbsp</a>>
    <a style="pointer-events: none" href="">&nbsp Change Profile Photo</a>
    <div style="float:right">
        <a class="btn btn-primary rounded-0" href="{{route('ChangePassword')}}">Change Password</a>&nbsp
        <a class="btn btn-info rounded-0" href="{{route('ProfileSettings')}}">Account Settings</a>&nbsp
        <a class="btn btn-primary rounded-0" href="{{route('Home')}}">Go To Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Account Settings</h4>

    <div class="row">
        <div class="col-md-4">
        <div class="card">
        <div class="card-header">
            <div class="card-title">Change Profile Photo</div>
        </div>
        <form action="{{route('UploadedPhoto')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
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
                <div class="row">
                    <div class="col-md-12">
                        @if($image=="default.jpg")
                            <img id="myImg" src="assets/img/{{$image}}" alt="your image" style="height:200px; width:200px" class="thumb">
                        @else
                            <img id="myImg" src="data:image/png;base64, {{ $image }}" style="height:200px; width:200px" alt="your image" class="thumb">
                        @endif
                        </br>
                        <input type="file" name="picture" id="img" style="display:none;" /><br />
                        <span class="text-danger">@error('picture') {{ $message }} @enderror</span>
                        <span class="text-danger" id="pictureError"></span>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <label for="img" class="btn btn-primary cc input-square">Choose Files</label>&nbsp
                <button class="btn btn-success input-square" id="do">Upload Photo</button>
            </div>
        </form>
        </div>
    </div>   

@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    /* The uploader form */
    $(function () {
        $(":file").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
        $('#myImg').attr('src', e.target.result);
        $('#yourImage').attr('src', e.target.result);
    };

    $("#do").click(function(){
        if($("#img").val()==""){
            $("#pictureError").text("You can't leave this empty.");
            return false;
        }
    });

</script>