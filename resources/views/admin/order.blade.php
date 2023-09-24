<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   @include('admin.css')
   <style type="text/css">

    .title_deg
    {
        text-align: center;
        font-size: 25px;
        font-weight: bold;
        padding-bottom: 40px;
    }

    .table_deg
    {
        width: 100%;
        margin: auto;
        padding-top: 50px;

    }
    th {
        background: skyblue;
    }

    table, th ,td
    {
        border: 2px solid white;
        padding: 4px;
        
    }
   </style>

   
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <h1 class="title_deg">All Orders</h1>


                <div style="padding-left: 400px; padding-bottom: 10px;">
                    <form action="{{url('search')}}" method="get" >
                        @csrf
                        <input type="text" style="color:black;" name="search" id="" placeholder="Search For Sumething">
                        <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form>
                </div>

                <table class="table_deg">

                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Delivered</th>
                        
                    </tr>


                    
                        
                    
                    
                    @forelse ($order as $order)
                        
                    
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td style="height: 100px; width: 100px;">
                            <img src="/product/{{$order->image}}">
                        </td>    
                        <td>
                            @if ($order->delivery_status=='processing')
                               
                                <a href="{{url('delivered',$order->id)}}" class="btn btn-primary" onclick="return confirm('Are you sure this product is delivered ??');">Delivered</a>
                            
                            @else 
                                @if ($order->delivery_status=='canceled')
                                    <p style="color: red">Canceled</p>
                                    @else
                                    <p style="color: green">Delivered</p>
                                @endif
                                
                            @endif
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="16" style="text-align: center">No Data Found</td>
                        
                    </tr>






                    @endforelse
                   

                </table>







            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>