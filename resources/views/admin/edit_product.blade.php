<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <base href="/public">
   @include('admin.css')
   <style type="text/css">
    .div_center
    {
        text-align: center;
        padding-top:40px; 
    }
    .font_size
    {
        font-size: 40px;
        padding-bottom: 40px;
    }
    .text_color
    {
        color:black;
        padding-bottom: 20px;
    }
    label
    {
        display: inline-block;
        width: 200px;
    }
    .div_design {
        padding-bottom: 15px;
    
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

                @if (session()->has('message'))

                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aroia-hidden='true'>x</button>
                    {{session()->get('message')}}
                </div>
                    
                @endif


                <div class="div_center">

                    <h1 class="font_size">Update Product</h1>
                    <form action="{{url('/update_product',$product->id)}}" method="post" enctype="multipart/form-data">

                        @csrf
                    <div class="div_design">

                    <label for="">Product Title :</label>
                    <input class="text_color" type="text" name="title" value="{{$product->title}}" required>
                    
                    </div>

                    <div class="div_design">

                        <label for="">Product Description :</label>
                        <input class="text_color" type="text" name="description" value="{{$product->description}}" required>
                        
                    </div>

                    <div class="div_design">

                        <label for="">Product Price :</label>
                        <input class="text_color" type="number" name="price" value="{{$product->price}}" required>
                        
                    </div>

                    <div class="div_design">

                        <label for="">Discount Price :</label>
                        <input class="text_color" type="number" name="dis_price" value="{{$product->discount_price}}" required>
                                
                    </div>

                    <div class="div_design">

                        <label for="">Product Quantity :</label>
                        <input class="text_color" type="number" min="0" name="quantity" value="{{$product->quantity}}" required>
                            
                    </div>

                        

                    <div class="div_design">

                        <label for="">Product Catagory :</label>
                        <select name="catagory"   class="text_color" required >
                            <option value="{{$product->catagory}}" selected="">{{$product->catagory}}</option>
                            @foreach ($catagory as $catagory )

                            <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                                
                            @endforeach
                        </select>
                            
                    </div>

                    <div>
                        <label for="">Current image:</label>
                        <img style="margin:auto;" height="70" width="70" src="/product/{{$product->image}}" alt="">
                        <br>
                    </div>

                    <div class="div_design">

                        <label for="" >change Image :</label>
                        <input type="file" name="image" >
                            
                    </div>

                    <div class="div_design">

                        <input type="submit" value="Update Product" class="btn btn-primary">
                            
                    </div>


                </div>
            </form>


            </div>
        </div>

                
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>