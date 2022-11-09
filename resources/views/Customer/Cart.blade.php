@extends('layouts.CommonLayout')

@section('content')

<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
               <a href="{{ route('index') }}" class="btn btn-lg btn-primary aa-cart-view-btn" style="border-radius:0px; padding:13px; float:right; margin-bottom:20px"></i>Add More Product&nbsp<i class="fa fa-smile-o fa-lg" aria-hidden="true"></i></a>
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        @foreach($cart as $item)
                        <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
                        @if($item->picture == 'defaultP.jpg')
                        <td><a href="#"><img src="assets/img/{{ $item->picture }}" alt="img"></a></td>
                        @else
                        <td><a href="#"><img src="data:image/png;base64, {{ $item->picture }}" alt="img"></a></td>
                        @endif
                        <td><a class="aa-cart-title" href="#">{{$item->productName}} ({{$item->color}})</a></td>
                        <td>{{$item->price}}</td>
                        <td><input class="aa-cart-quantity quantity" type="number" id="{{$item->id}}" data-id="{{$item->id}}" value="{{$item->quantity}}"></td>
                        <td>{{$item->price * $item->quantity}}</td>
                        <tr>
                        @endforeach
                        <td colspan="6" class="aa-cart-view-bottom">
                          <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>
                          <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total" style="width:50%">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td>{{$subtotal}}</td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td>{{$subtotal}}</td>
                   </tr>
                 </tbody>
               </table>
               <a href="{{ route('CheckOut') }}" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <script>

$(document).ready(function(){
    $(".quantity").on('change keyup', function() {
        //alert($(this).data('id'));
        var userName = '{{Session::get('userNames')}}';
        var cartId = $(this).data('id');
        var update = $(`#${cartId}`).val();
        //alert(cartId)
        $.ajax({
          url: `http://127.0.0.1:8000/api/update/${userName}/${cartId}/${update}`,
          method: "put",
          complete:function(xmlHttp, status){
            if(xmlHttp.status==200){
              //alert('ok')
            }else{
              alert("error")
            }
          }
        })
    }); 
});

 </script>

 @stop