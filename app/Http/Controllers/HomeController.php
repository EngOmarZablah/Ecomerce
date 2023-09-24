<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $product=Product::paginate(6);
        return view('home.userpage',compact('product'));
    }
    public function redirect(){
        if(Auth::user()){
            $usertype=Auth::user()->usertype;
            $user=Auth::user();
            if($usertype=='1'){
                $total_product=Product::all()->count();
                $total_orders=Order::all()->count();
                $total_customers=User::where('usertype',0)->count();
                
                $order=Order::all()->where('payment_status','Paid');
                $total_revenue=0;
                
                foreach($order as $order)
                {
                    $total_revenue=$total_revenue+$order->price;
                }

                $order_deliverd=Order::where('delivery_status','Delivered')->count();
                $order_processing=Order::where('delivery_status','processing')->count();

                
                return view('admin.home',
                compact('user','total_product','total_orders','total_customers',
                'total_revenue','order_deliverd','order_processing'));
            }
            else{
                $product=Product::paginate(6);
                return view('home.userpage',compact('product'));
            }
        }
        else {
            return redirect('login'); 
        }    
    }
    public function product_details($id){
        $product=Product::find($id);
        return view('home.product_details',compact('product'));
    }

    public function add_cart(Request $request ,$id){

        if(Auth::id())
        {
            $user=Auth::user();
            $product=Product::find($id);
            $cart=new Cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;
            $cart->product_title=$product->title;
            if ($product->discount_price) {
                $cart->price=$product->discount_price * $request->quantity;
            }
            else{
            $cart->price=$product->price * $request->quantity;
            }
            $cart->image=$product->image;
            $cart->product_id=$product->id;
            
            $cart->quantity=$request->quantity;
            $cart->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login'); 
        }
    
    }
    public function show_cart(){
        if(Auth::id()){
            $id=Auth::user()->id;
            $cart=Cart::where('user_id','=',$id)->get();
            return view('home.showCart',compact('cart'));
        }
        else {
            return redirect('login');
        }
    }
    public function remove_cart($id){
        Cart::destroy($id);
        return redirect()->back();
    }

    public function cash_order(){
        $user=Auth::user();
        $userid=$user->id;

        $data=Cart::where('user_id','=',$userid)->get();
        $order=new Order;
        // $order->product_title='';
        foreach($data as $data)
        {
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title .=$data->product_title;
            
            $order->product_title .= ' | ';
            
            $order->quantity .=$data->quantity;
            $order->quantity .=' | ';

            $order->price +=$data->price;
            
            $order->image=$data->image;

            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';
            
            

            $order->save();

            
            
            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }


        return redirect()->back()->with('message','We have Received Your Order. We will connect with you soon...');
        
    } 


    public function my_orders(){
        if(Auth::id()){
            $order=Order::where('user_id',Auth::id())->get();
            return view('home.orders',compact('order'));
        }
        else{
            return redirect('login');
        }
        
    }

    public function cancel_order($id){
        $order=Order::find($id);
        $order->delivery_status='canceled';
        $order->save();
        return redirect()->back();
    }
    
}