@extends('layouts.AdminLayout')

@section('content')

<style>
    .button-group {
        margin: auto;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .thumb {
        height: 200px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    }

    .picture-nm {
        width: 125px;
        height: 150px;
    }

    #hide{
        visibility: hidden;
    }

    .productcss{
        width:150px;
    }

    .piccss{
        width:142px;
    }

    .actioncss{
        width:150px;
    }

    .quantitycss{
        width:85px;
    }

    @media (max-width: 1300px) {
        .hidden-xs {
            display: none !important;
        } 

        #hide{
            visibility: visible;
        }

        .picture-xs {
            width: 62px;
            height:75px;
        }
        .productcss{
            width:48px;
        }
        .piccss{
            width:45px;
        }
        .actioncss{
            width:45px;
        }
        .quantitycss{
            width:32px;
        }
    }

</style>

    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a> >
    <a style="pointer-events: none" href="">&nbsp Customize Product</a>
    <div style="float:right">
    <button class="btn btn-info" onClick="window.location.reload();"><i class="la la-refresh" aria-hidden="true"></i>&nbsp Refresh</button>
        <a class="btn btn-primary" href="{{route('Home')}}">Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Customize Product</h4>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="card-title col-md-3">Customize Product</div>
                @if(Request::path() == "blocked_product")
                    <div class="col-md-2"><a href="{{ route('CustomizeProduct', ['id' => 0]) }}" class="btn btn-dark">Normal Products</a></div>
                @else
                    <div class="col-md-2">
                        <a href="{{ route('BlockedProduct', ['id' => 0]) }}" class="btn btn-secondary">Blocked Products</a>
                    </div>
                @endif
                <div class="col-md-2">
                <button class="btn" style="border-color:blue; margin-left:35px" onClick="window.location.reload();"><i style="color:blue" class="la la-refresh" aria-hidden="true">&nbsp Refresh</i></button>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2"><input id="target" class="form-control" type="text" placeholder="Search Product......"></div>
                <div class="col-md-2">
                    <select class="form-control" name="" id="category">
                        <option value=0>All Category</option>
                        @foreach($category as $cate)
                            @if(Request::get('category') == $cate['categoryId'])
                                <option selected value="{{$cate['categoryId']}}">{{$cate['categoryName']}}</option>
                            @else
                                <option value="{{$cate['categoryId']}}">{{$cate['categoryName']}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
                @if(Session::has('fail'))
                    <div class="alert" style="text-align:center; background-color:#F0E1E3; color:red">
                        {{Session::get('fail')}}
                    </div>
                @endif
            <div class="table-responsive">
                <table class="table table-bordered" style="table-layout: fixed; width: 100%">
                    <thead class="">
                        <tr>
                            <th scope="col" style="width:30px" class="hidden-xs">#</th>
                            <th class="productcss">Product Name</th>
                            <th style="width:200px" class="hidden-xs">Description</th>
                            <th class="piccss">Picture</th>
                            <th style="width:85px" class="hidden-xs">Category</th>
                            <th style="width:110px" class="hidden-xs">Buying Price</th>
                            <th style="width:110px" class="hidden-xs">Selling Price</th>
                            <th class="quantitycss">Quantity</th>
                            <th class="actioncss">Action</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    @foreach($product as $item)
                        <tr id="deletedRow{{$item['productId']}}">
                            <td class="hidden-xs" id="done{{$item['productId']}}">{{$item['productId']}}</td>
                            <td id="done{{$item['productId']}}">{{$item['productName']}}</td>
                            <td class="hidden-xs" style="word-wrap: break-word" id="done{{$item['productId']}}">{{$item['description']}}</td>
                            @if($item['picture']=="defaultP.jpg")
                            <td id="done{{$item['productId']}}">
                                <img id="myImg" src="assets/img/{{ $item['picture'] }}" alt="your image" class="thumb picture-xs picture-nm">
                            </td>
                            @else
                            <td id="done{{$item['productId']}}">
                                <img id="myImg" src="data:image/png;base64, {{ $item['picture'] }}" alt="your image" class="thumb picture-xs picture-nm">
                            </td>
                            @endif
                            @foreach($category as $cat)
                                @if($cat['categoryId'] == $item['categoryId'])
                                    <td class="hidden-xs" scope="row">{{$cat['categoryName']}}</td>
                                @endif
                            @endforeach
                            <td class="hidden-xs" id="done{{$item['productId']}}">{{$item['buyingPrice']}}</td>
                            <td class="hidden-xs" id="done{{$item['productId']}}">{{$item['sellingPrice']}}</td>
                            <td id="quantity{{$item['productId']}}">{{$item['quantity']}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('UpdateProduct', ['id'=> $item['productId'] ])}}">Update</a> <br>
                                @if($item['quantity']>0)
                                    <button style="margin-top:2px;border-color:black" class="btn block" id="blocked{{$item['productId']}}" data-id="{{$item['productId']}}">Block</button> <br>
                                @else
                                    <button style="margin-top:2px;border-color:black" class="btn btn-dark block" id="blocked{{$item['productId']}}" data-id="{{$item['productId']}}">Unblock</button> <br>
                                @endif
                                <button style="margin-top:2px;" class="btn btn-danger delete" data-id="{{$item['productId']}}">Delete</button> <br>
                                <button style="margin-top:2px" class="btn btn-info" id="hide">Detail</button> <br>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="mb-3 button-group">
                <div class="btn-group" aria-label="First group">
                @if($total <= 25)
                    <div class="mb-3 button-group">
                        <div class="btn-group" aria-label="First group">
                            @for( $i = $startPoint; $i <= ceil($total/5); $i++)
                                <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeProduct', ['id' => $i, 'category' => Request::get('category') ]) }}">{{$i}}</a>
                            @endfor
                        </div>
                    </div>
                    @else
                    <div class="mb-3 button-group">
                        <div class="btn-group" aria-label="First group">
                            @if($clickedId > 3)
                                <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeProduct', ['id' => 1, 'category' => Request::get('category') ]) }}">1..</a>
                            @else
                                <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeProduct', ['id' => 1, 'category' => Request::get('category') ]) }}">1</a>
                            @endif
                            @for( $i = $startPoint; $i < ($startPoint+3); $i++)
                                <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeProduct', ['id' => $i, 'category' => Request::get('category') ]) }}">{{$i}}</a>
                            @endfor
                            @if($clickedId > $totalRow-3)
                                <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeProduct', ['id' => $totalRow, 'category' => Request::get('category') ]) }}">{{$totalRow}}</a>
                            @else
                                <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeProduct', ['id' => $totalRow, 'category' => Request::get('category') ]) }}">...{{$totalRow}}</a>    
                            @endif
                        </div> 
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

        $(document).ready(function(){

            $(document).on('click', '.delete', function() {
                var id = $(this).data('id')
                swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this info!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url:`https://dailyshop.thevoice24.com/api/deleteProduct/${id}`,
                            //url:`http://127.0.0.1:8000/api/deleteProduct/${id}`,
                            method:"Delete",
                            complete:function(xmlHttp,status){
                                if(xmlHttp.status==204)
                                {
                                    $(`#deletedRow${id}`).remove()
                                }
                                else
                                {
                                    alert("Error");
                                }
                            }
                        })

                        swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
            })

            $(document).on('click', '.block', function() {
                var id = $(this).data('id')
                if($(`#blocked${id}`).hasClass("btn-dark")){
                    $(`#blocked${id}`).removeClass("btn-dark")
                    $(`#blocked${id}`).html("Block")
                }else{
                    $(`#blocked${id}`).addClass("btn-dark")
                    $(`#blocked${id}`).html("Unblock")
                }
                $.ajax({
                    url:`https://dailyshop.thevoice24.com/api/blockProduct/${id}`,
                    //url: `http://127.0.0.1:8000/api/blockProduct/${id}`,
                    method: "Put",

                    complete:function(xmlHttp, status){
                        if(xmlHttp.status==200){
                            $(`#quantity${id}`).html(xmlHttp.responseJSON.quantity)
                        }else{
                            alert("error")
                        }
                    }

                })


            })

        });

        $( "#target" ).keyup(function() {
            var name = this.value
            $("#data").html("")
            $.ajax({
                url:`https://dailyshop.thevoice24.com/api/searchProduct`,
                //url:`http://127.0.0.1:8000/api/searchProduct`,
                method:"Get",
                data:{query:name},
                complete:function(xmlHttp,status){
                    if(xmlHttp.status==200)
                    {
                        var str='';
                        var data=xmlHttp.responseJSON;
                        for(var i=0; i<data.length; i++){
                            str+="<tr id='deletedRow"+data[i].productId+"'>"
                            str+="<td class='hidden-xs' id='done"+data[i].productId+"]'>"+data[i].productId+"</td>"
                            str+="<td id='done"+data[i].productId+"'>"+data[i].productName+"</td>"
                            str+="<td class='hidden-xs' style='word-wrap: break-word' id='done"+data[i].description+"}'>"+data[i].description+"</td>"
                            if(JSON.stringify(data[i].picture)==JSON.stringify("defaultP.jpg")){
                                str+="<td id='done"+data[i].productId+"'>"
                                str+="<img id='myImg' src='assets/img/"+data[i].picture+"' alt='your image' class='thumb picture-xs picture-nm'>"
                                str+="</td>"
                            }
                            else{
                                str+="<td id='done"+data[i].productId+"'>"
                                str+="<img id='myImg' src='data:image/png;base64, "+data[i].picture+"' alt='your image' class='thumb picture-xs picture-nm'>"
                                str+="</td>"
                            }
                            str+="<td class='hidden-xs' scope='row'>"+data[i].productId+"</td>"
                            str+="<td class='hidden-xs' id='done"+data[i].productId+"'>"+data[i].buyingPrice+"</td>"
                            str+="<td class='hidden-xs' id='done"+data[i].productId+"'>"+data[i].sellingPrice+"</td>"
                            str+="<td id='quantity"+data[i].productId+"'>"+data[i].productId+"</td>"
                            str+="<td>"
                            str+="<a class='btn btn-primary' href='/update_product/"+data[i].productId+"'>Update</a> <br>"
                            if(data[i].quantity>0){
                                str+="<button style='margin-top:2px;border-color:black;' class='btn block'id='blocked"+data[i].productId+"' data-id="+data[i].productId+">Block</button> <br>"
                            }else{
                                str+="<button style='margin-top:2px;' class='btn btn-dark block' id='blocked"+data[i].productId+"' data-id='"+data[i].productId+"'>Unblock</button> <br>"
                            }
                            str+="<button style='margin-top:2px' class='btn btn-danger delete' data-id='"+data[i].productId+"'>Delete</button> <br>"
                            str+="<button style='margin-top:2px' class='btn btn-info' id='hide'>Detail</button> <br>"
                            str+="</td>"
                            str+="</tr>"
                        }	
                        $("#data").html(str);
                    }
                    else
                    {
                        
                    }
                }
            })

        });

            let searchParams = new URLSearchParams(window.location.search)
            var id = searchParams.get('id')
            $('#category').change(function(){
                window.location.href = '/customize_product?id='+ searchParams.get('id') + '&category=' + $(this).val();
        });

    </script>


@stop
