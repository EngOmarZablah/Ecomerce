<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function view_catagory(){
        $data=Catagory::all();
        $user=Auth::user();
        return view('admin.catagory',compact('data','user'));
    }
    public function add_caragory(Request $request){
        $data=new Catagory;
        $data->catagory_name=$request->catagory;
        $data->save();
        return redirect()->back()->with('message','Catagory Added Successfully');
    }
    public function delete_catagory($id){
        Catagory::destroy($id);
        return redirect()->back()->with('message','Catagory Deleted Successfully');
    }
    public function view_product(){
        $catagory=Catagory::all();
        $user=Auth::user();
        return view('admin.product',compact('catagory','user'));
    }
    public function add_product(Request $request){
        $product=new Product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->dis_price;
        $product->catagory=$request->catagory;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);

        $product->image= $imagename;

        $product->save();
        $user=Auth::user();

        return redirect()->back()->with('message','Product Added Successfully');

    }
    public function show_product(){
        $product=Product::all();
        $user=Auth::user();
        return view('admin.show_products',compact('product','user'));
    }
    public function delete_product($id){
        Product::destroy($id);
        return redirect()->back()->with('message','Product Deleted Successfully');
    }
    public function edit_product($id){
        $product=Product::find($id);
        $catagory=Catagory::all();
        $user=Auth::user();
        return view('admin.edit_product',compact('product','catagory','user'));
    }
    public function update_product(Request $request , $id){
        $product=Product::find($id);
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->dis_price;
        $product->catagory=$request->catagory;

        $image=$request->image;

        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);

            $product->image= $imagename;
        }
        

        $product->save();
        
        return redirect()->back()->with('message','Product Updated Successfully');

    }


    public function order(){
        $order=Order::all();
        $user=Auth::user();
        return view('admin.order',compact('order','user'));
    }
    
    public function delivered($id){
        $order=Order::find($id);
        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back();
    }
    
    

    public function search(Request $request){
        $searchText=$request->search;
        $order=Order::where('name','LIKE',$searchText)->orWhere('phone','LIKE',$searchText)->get();
        $user=Auth::user();
        return view('admin.order',compact('order','user'));
    }
}