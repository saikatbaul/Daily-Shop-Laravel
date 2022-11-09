@extends('layouts.CommonLayout')

@section('content')

    
    
    <!-- / catg header banner section -->
    <!-- product category -->
    <section id="aa-product-details">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="aa-product-details-area">
                <div class="aa-product-details-content">
                <div class="row">
                <br>
                    <!-- Modal view slider -->
                    <form action="{{route('ProductDetails')}}" method="post">
                        @csrf
                    <input type="hidden" name="id" value="{{ Request::get('id') }}">
                    <div class="col-md-5 col-sm-5 col-xs-12">                              
                    <div class="aa-product-view-slider">                                
                        <div id="demo-1" class="simpleLens-gallery-container">
                        <div class="simpleLens-container">
                            @if($product['picture']=="defaultP.jpg")
                                <div class="simpleLens-big-image-container"><img src="assets/img/{{ $product['picture'] }}" class="simpleLens-big-image"></a></div>
                            @else
                                <div class="simpleLens-big-image-container"><img src="data:image/png;base64, {{ $product['picture'] }}" class="simpleLens-big-image"></a></div>
                            @endif
                            <!-- <div class="simpleLens-big-image-container"><a data-lens-image="img/view-slider/large/polo-shirt-1.png" class="simpleLens-lens-image"><img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image"></a></div> -->
                        </div>
                        
                        </div>
                    </div>
                    </div>
                    <!-- Modal view content -->
                    <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="aa-product-view-content">
                        <h3>{{ $product['productName'] }}</h3>
                        <div class="aa-price-block">
                        <span class="aa-product-view-price">৳{{ $product['sellingPrice'] }}</span>
                        @if($product['quantity'] > 0)
                            <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                        @else
                            <p class="aa-product-avilability">Avilability: <span>stock out</span></p>
                        @endif
                        </div>
                        
                        <!-- <h4>Size</h4>
                        <div class="aa-prod-view-size">
                        <a href="#">S</a>
                        <a href="#">M</a>
                        <a href="#">L</a>
                        <a href="#">XL</a>
                        </div> -->
                        <h4>Color</h4>
                        <div class="form-group">
                            <input style="margin:10px 0" class="form-check-input" type="radio" name="color" id="color" value="Red">
                            <label class="form-check-label" for="Male">Red</label>
                            <input style="margin-left:30px" class="form-check-input" type="radio" name="color" id="color" value="Black">
                            <label class="form-check-label" for="Female">Black</label>
                            <input style="margin-left:30px" class="form-check-input" type="radio" name="color" id="color" value="White">
                            <label class="form-check-label" for="custom">White</label>
                            <div class="text-danger">@error('color') {{ $message }} @enderror</div>
                            <span class="text-danger" id="colorError"></span>
                        </div>
                        <div class="aa-prod-quantity">
                            <select id="quantity" name="quantity">
                            <option selected="1" value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                        <p class="aa-prod-category">
                            Category: <a href="#">{{ $category['categoryName'] }}</a>
                        </p>
                        </div>
                        <div class="aa-prod-view-bottom">
                        <button class="aa-add-to-cart-btn do">
                           Buy Now
                        </button> &nbsp 
                        </form>
                        <a href="{{route('Cart')}}" class="aa-add-to-cart-btn does" id="AddtoCart">Add To Cart</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="aa-product-details-bottom">
                <ul class="nav nav-tabs" id="myTab2">
                    <li><a href="#description" data-toggle="tab">Description</a></li>             
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="description" style="word-wrap: break-word; margin-left: 20%; margin-right:20%">
                        {{ $product['description'] }}
                    <br><br><br><br>
                    </div>
                                
                </div>
                </div>
                <!-- Related product -->
                
                <!-- / quick view modal -->   
                </div>  
            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- / product category -->


    <!-- Modal -->
    <div style="margin-top:9%" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 750px;" role="document">
        <div class="modal-content">
        <div class="modal-body">
        <div class="aa-myaccount-login" style="padding:2% 4% 2%">
        <h4 style="text-align:center">Welcome! Please Login to continue.</h4> 
            <form class="aa-login-form" action="{{ route('check') }}" method="post" id="form" novalidate>
                @csrf
                <input type="hidden" name="idd" value="somthing">
                <input type="hidden" name="ids" value="{{ Request::get('id') }}">
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
                    <button class="btn btn-block default" type="submit" id="doing">Login</button>
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
        </div>
    </div>
    </div>


    <!-- Subscribe section -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $('#AddtoCart').click(function(){
            //alert('dddd')
            var quantity = $('#quantity').find(":selected").text();
            let searchParams = new URLSearchParams(window.location.search)
            var id = searchParams.get('id')
            var userName = '{{ Session::get('userNames') }}';
            $.ajax({
                url:`http://127.0.0.1:8000/api/addToCart/${id}/${userName}`,
                method:"POST",
                data:{
                    "userName": userName,
                    "productName": '{{ $product['productName'] }}',
                    "price": '{{ $product['sellingPrice'] }}',
                    "color": $("#color:checked").val(),
                    "quantity": quantity,
                    "picture": '{{ $product['picture'] }}'
                },
                complete:function(xmlHttp,status){
                    if(xmlHttp.status==200)
                    {
                        var dd = xmlHttp.responseText
                        window.location = '/cart?total='+dd;
                    }
                    else
                    {
                        return false;
                    }
                }
            })
        })

        $('.do, .does').click(function(){
            var searchParams = new URLSearchParams(window.location.search)
            var userId = searchParams.get('userId')
            var userIds = '{{ Session::get('LoggedUser') }}';
            var width = $(window).width(); 

            if($('input[name="color"]:checked').val()==null){
                $('#colorError').text('You have to select one color');
                return false;
            }
            if(userId != userIds && width > 400 && userIds==""){
                $('#exampleModalCenter').modal('show'); 
                return false;
            }
            
        })

        $("#doing").click(function(){
            if($("#user").val()=="" && $("#password").val()==""){
                $("#userError").text("You can't leave this empty.");
                $("#passwordError").text("You can't leave this empty.");
                return false;
            }
            if($("#user").val()==""){
                $("#userError").text("You can't leave this empty.");
                $("#passwordError").text("");
                return false;
            }
            if($("#password").val()==""){
                $("#passwordError").text("You can't leave this empty.");
                $("#userError").text("");
                return false;
            }
        });

    </script>
    

@stop