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
    <a style="pointer-events: none" href="">&nbsp Add Category</a>
    <div style="float:right">
        <a class="btn btn-primary" href="{{route('Home')}}">Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Add Categroy</h4>

    <form action="{{route('UpdatedProduct',  ['id'=> $product['productId']] )}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Add Product
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
                <div class="row container">
                    <div class="col-md-7" style="margin-top:10px;">
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" class="form-control input-square" id="productName" name="productName" value="{{ $product['productName'] }}">
                            <span class="text-danger">@error('productName') {{ $message }} @enderror</span>
                            <span class="text-danger" id="productNameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control input-square" rows="3" id="description" name="description">{{ $product['description']}}</textarea>
                            <span class="text-danger">@error('description') {{ $message }} @enderror</span>
                            <span class="text-danger" id="descriptionError"></span>
                        </div>
                        <div class="form-group" id="categoryId">
                            <label>Category</label>
                            <select class="form-control input-square" name="category">
                            @foreach($category as $item)
                                @if( $item['categoryId'] == $product['categoryId'] )
                                <option value="{{ $item['categoryId'] }}" selected>{{ $item['categoryName'] }}</option>
                                @else
                                <option value="{{ $item['categoryId'] }}">{{ $item['categoryName'] }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Buying Price</label>
                                    <input type="number" class="form-control input-square" id="buyingPrice" name="buyingPrice" value="{{ $product['buyingPrice'] }}">
                                    <span class="text-danger">@error('buyingPrice') {{ $message }} @enderror</span>
                                    <span class="text-danger" id="buyingPriceError"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Selling Price</label>
                                    <input type="number" class="form-control input-square" id="sellingPrice" name="sellingPrice" value="{{ $product['sellingPrice'] }}">
                                    <span class="text-danger">@error('sellingPrice') {{ $message }} @enderror</span>
                                    <span class="text-danger" id="sellingPriceError"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="number" class="form-control input-square" id="quantity" name="quantity" value="{{ $product['quantity'] }}">
                            <span class="text-danger">@error('productName') {{ $message }} @enderror</span>
                            <span class="text-danger" id="quantityError"></span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-8" style="margin-top:8%">
                                <img id="myImg" src="data:image/png;base64, {{ $product['picture'] }}" alt="your image" style="height:300px; width:250px" class="thumb">
                                <input type="file" name="picture" id="img" style="display:none;" /><br />
                                <span class="text-danger"></span>
                                <span class="text-danger" id="pictureError"></span>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                            <br>
                                <label for="img" class="btn btn-primary cc input-square">Choose Files</label>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <div class="row container">
                    <div class="col-md-6">
                    <button id="do" class="btn btn-block btn-success rounded-0">Update Product</button>
                    </div>
            </div>
            </form>
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

    

</script>

<script>

        $(document).ready(function(){
            
            $("#do").click(function(){
                n=0;
                if($("#productName").val()==""){
                    $("#productNameError").text("You can't leave this empty.");
                    n++;
                }
                if($("#description").val()==""){
                    $("#descriptionError").text("You can't leave this empty.");
                    n++;
                }

                if($('#buyingPrice').val()==""){
                    $("#buyingPriceError").text("You can't leave this empty.");
                    n++;
                }
                if($('#sellingPrice').val()==""){
                    $("#sellingPriceError").text("You can't leave this empty.");
                    n++;
                }
                if($('#quantity').val()==""){
                    $("#quantityError").text("You can't leave this empty.");
                    n++;
                }
                if(n>0){
                    return false;
                }
            });

        })

    </script>

@stop