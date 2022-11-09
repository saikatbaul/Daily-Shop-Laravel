@extends('layouts.AdminLayout')

@section('content')

<style>
    .button-group {
        margin: auto;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

</style>

    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a> >
    <a style="pointer-events: none" href="">&nbsp Customize Category</a>
    <div style="float:right">
        <a class="btn btn-primary" href="{{route('Home')}}">Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Customize Categroy</h4>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="card-title col-md-5">Customize Category</div>
                <div class="card-title col-md-5"><input id="target" class="form-control" type="text" placeholder="Search Category......"></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th style="width:30%" scope="col">#</th>
                            <th style="width:35%">Category</th>
                            <th style="width:35%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    @foreach($category as $item)
                        <tr id="deleteCategory{{$item['categoryId']}}">
                            <th scope="row">{{$item['categoryId']}}</th>
                            <td id="done{{$item['categoryId']}}">{{$item['categoryName']}}</td>
                            <td>
                                <button class="btn btn-success rounded-0 update" id="update{{$item['categoryId']}}" data-id="{{$item['categoryId']}}">Update</button> &nbsp
                                <button class="btn btn-danger rounded-0 delete" id="delete{{$item['categoryId']}}" data-id="{{$item['categoryId']}}">Delete</button>
                            </td>
                        </tr>
                        <tr id="updateRow{{$item['categoryId']}}" style="display:none">
                            <th></th>
                            <td>
                                <input type="text" class="form-control input-square" name="categoryName{{$item['categoryId']}}" id="categoryName{{$item['categoryId']}}" value="{{$item['categoryName']}}">
                                <span class="text-danger">@error('categoryName') {{ $message }} @enderror</span>
                                <span class="text-danger" id="categoryNameError"></span>

                            </td>
                            <td>
                                <button class="btn btn-outline-success btn-sm rounded-0 updated" id="updated{{$item['categoryId']}}" data-id="{{$item['categoryId']}}"><i class="la la-check" aria-hidden="true"></i>&nbsp Done</button> &nbsp
                                <button class="btn btn-outline-danger btn-sm rounded-0" id="cancel{{$item['categoryId']}}"><i class="la la-times"></i>&nbsp Cancel</button>
                            </td>
                        </tr>
                        <tr id="deleteRow{{$item['categoryId']}}" style="display:none">
                            <th></th>
                            <td>
                                <p><span class=text-danger>*</span>Are You Sure Want To Delete??</p>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-sm rounded-0 deleted" id="deleted{{$item['categoryId']}}" data-id="{{$item['categoryId']}}"><i class="la la-times"></i>Yes</button>&nbsp
                                <button class="btn btn-outline-success btn-sm rounded-0" id="no{{$item['categoryId']}}"><i class="la la-check" aria-hidden="true"></i>&nbsp No</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @if($total <= 25)
            <div class="mb-3 button-group">
                <div class="btn-group" aria-label="First group">
                    @for( $i = $startPoint; $i <= ceil($total/5); $i++)
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => $i]) }}">{{$i}}</a>
                    @endfor
                </div>
            </div>
            @else
            <div class="mb-3 button-group">
                <div class="btn-group" aria-label="First group">
                    @if($clickedId > 3)
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => 1]) }}">1..</a>
                    @else
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => 1]) }}">1</a>
                    @endif
                    @for( $i = $startPoint; $i < ($startPoint+3); $i++)
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => $i]) }}">{{$i}}</a>
                    @endfor
                    @if($clickedId > $totalRow-3)
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => $totalRow]) }}">{{$totalRow}}</a>
                    @else
                        <a class="btn btn-outline-primary btn-sm rounded-0" href="{{ route('CustomizeCategory', ['id' => $totalRow]) }}">...{{$totalRow}}</a>    
                    @endif
                </div> 
            </div>
            @endif
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        $(document).ready(function(){

            $( "#target" ).keyup(function() {
                var name = this.value
                $("#data").html("")
                $.ajax({
                    url:`https://dailyshop.thevoice24.com/api/searchCategory`,
                    //url:`http://127.0.0.1:8000/api/searchCategory`,
                    method:"Get",
                    data:{query:name},
                    complete:function(xmlHttp,status){
                        if(xmlHttp.status==200)
                        {
                            var str='';
                            var data=xmlHttp.responseJSON;
                            for(var i=0; i<data.length; i++){
                                str+="<tr id='deleteCategory"+data[i].categoryId+"'>"
                                str+="<th scope='row'>"+data[i].categoryId+"</th>"
                                str+="<td id='done"+data[i].categoryId+"'>"+data[i].categoryName+"</td>"
                                str+="<td>"
                                str+="<button class='btn btn-success rounded-0 update' id='update"+data[i].categoryId+"' data-id='"+data[i].categoryId+"'>Update</button> &nbsp"
                                str+="<button class='btn btn-danger rounded-0 delete' id='delete"+data[i].categoryId+"' data-id='"+data[i].categoryId+"'>Delete</button>"
                                str+="</td>"
                                str+="</tr>"
                                str+="<tr id='updateRow"+data[i].categoryId+"' style='display:none'>"
                                str+="<th></th>"
                                str+="<td>"
                                str+="<input type='text' class='form-control input-square' name='categoryName"+data[i].categoryId+"' id='categoryName"+data[i].categoryId+"' value='"+data[i].categoryName+"'>"
                                str+="<span class='text-danger'>@error('categoryName') {{ $message }} @enderror</span>"
                                str+="<span class='text-danger' id='categoryNameError'></span>"
                                str+="</td>"
                                str+="<td>"
                                str+="<button class='btn btn-outline-success btn-sm rounded-0 updated' id='updated"+data[i].categoryId+"' data-id='"+data[i].categoryId+"'><i class='la la-check' aria-hidden='true'></i>&nbsp Done</button> &nbsp"
                                str+="<button class='btn btn-outline-danger btn-sm rounded-0' id='cancel"+data[i].categoryId+"'><i class='la la-times'></i>&nbsp Cancel</button>"
                                str+="</td>"
                                str+="</tr>"
                                str+="<tr id='deleteRow"+data[i].categoryId+"' style='display:none'>"
                                str+="<th></th>"
                                str+="<td>"
                                str+="<p><span class=text-danger>*</span>Are You Sure Want To Delete??</p>"
                                str+="</td>"
                                str+="<td>"
                                str+="<button class='btn btn-outline-danger btn-sm rounded-0 deleted' id='deleted"+data[i].categoryId+"' data-id='"+data[i].categoryId+"'><i class='la la-times'></i>Yes</button>&nbsp"
                                str+="<button class='btn btn-outline-success btn-sm rounded-0' id='no"+data[i].categoryId+"'><i class='la la-check' aria-hidden='true'></i>&nbsp No</button>"
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


            $(document).on('click', '.update', function() {
                var id = $(this).data('id')

                $(`#deleteRow${id}`).hide()

                $(`#updateRow${id}`).show()

                $(`#cancel${id}`).click(function(){

                    $(`#updateRow${id}`).hide()

                })

            })

            $(document).on('click', '.delete', function() {

                var id = $(this).data('id')

                $(`#updateRow${id}`).hide()

                $(`#deleteRow${id}`).show()

                $(`#no${id}`).click(function(){
                    $(`#deleteRow${id}`).hide()

                })

            })

            $(document).on('click', '.updated', function() {

                var categoryId=$(this).data('id')

                $.ajax({
                    url:`https://dailyshop.thevoice24.com/api/updateCategory/${categoryId}`,
                    //url:`http://127.0.0.1:8000/api/updateCategory/${categoryId}`,
                    method:"PUT",
                    data:{
                        "catehoryId": categoryId,
                        "categoryName": $("#categoryName"+categoryId).val(),
                    },
                    complete:function(xmlHttp,status){
                        if(xmlHttp.status==200)
                        {
                            $(`#updateRow${categoryId}`).hide()
                            $("#done"+categoryId).html($("#categoryName"+categoryId).val());
                        }
                        else
                        {
                            alert("Error");
                        }
                    }
                })

            })

            $(document).on('click', '.deleted', function() {

                var categoryId=$(this).data('id')

                $.ajax({
                    url:`https://dailyshop.thevoice24.com/api/deleteCategory/${categoryId}`,
                    //url:`http://127.0.0.1:8000/api/deleteCategory/${categoryId}`,
                    method:"Delete",
                    complete:function(xmlHttp,status){
                        if(xmlHttp.status==204)
                        {
                            $(`#deleteCategory${categoryId}`).remove()
                            $(`#updateRow${categoryId}`).remove()
                            $(`#deleteRow${categoryId}`).remove()
                        }
                        else
                        {
                            alert("Error");
                        }
                    }
                })

            })

        });

    </script>


@stop
