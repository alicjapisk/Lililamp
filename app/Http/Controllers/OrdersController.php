<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use App\Models\Shipping;
use App\Models\OrderDetails;
use App\Models\Cart;
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myOrders = User::join('orders', 'orders.id_user','=','users.id')->orderBy('orders.id','asc')->get();
            return view('orders.list',['order'=>$myOrders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('checkout');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $myOrder=Orders::find($id);
        if($myOrder == null){
            $error_message = "Order id=".$id." not find";
            return view('orders.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if ($myOrder->count()>0)
        return view('orders.show',['orders'=>$myOrder]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $myOrder = Orders::find($id);
        if ($myOrder == null){
            $error_message = "Order id=".$id." not find";
            return view('orders.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if($myOrder->count()>0)
        return view('orders.edit',['orders'=>$myOrder]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated=$request->validate([
            'id'=>'required|integer|gt:0',
            'status'=>'required',
           ]);
            if($validated){
                $orders=Orders::find($id);
                if($orders != null){
                    $orders->id = $request->id;
                    $orders->status = $request->status;
                    $orders->save();
                    return redirect('/orders/list');    
                }
                else{
                    $error_message = "Order id=".$id." not find";
                    return view('order.message',['message'=>$error_message,'type_of_message'=>'Error']);
                }
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function showOrder()
    {
        $userId = Auth::id();
        $order = User::join('orders', 'orders.id_user','=','users.id')->where('users.id', $userId)->get();
        return view('orders.orderList', ['order' => $order]);
    }

    public function checkoutList(){
        $userId = Auth::id();
        $user = User::where('id', $userId)->first();
        $shipping = Shipping::all();
        $cart = Cart::join('products', 'products.id','=','cart.id_product')->join('users','users.id','=', 'cart.id_user')->where('users.id',$userId)->get();
        $total = Cart::join('products', 'products.id','=','cart.id_product')->join('users','users.id','=', 'cart.id_user')->where('users.id',$userId)->sum(DB::raw('products.price * cart.quantity'));
            return view('shop/checkout', ['user' => $user, 'shipping' => $shipping, 'cart'=>$cart, 'total'=>$total]);
    }

    public function makeCheckout(Request $request)
    {   
        $validated=$request->validate([
            'gift'=>'required',
            'address'=>'required',
            'zip_code'=>'required',
           ]);
        if($validated){
            $userId = Auth::id();
            $user = User::where('id', $userId)->first();
            $shipping = Shipping::find($request->id);
            $cart = Cart::join('products', 'products.id','=','cart.id_product')->join('users','users.id','=', 'cart.id_user')->where('users.id',$userId)->first();
            $total = Cart::join('products', 'products.id','=','cart.id_product')->join('users','users.id','=', 'cart.id_user')->where('users.id',$userId)->sum('products.price');
            $carts = Cart::join('products', 'products.id','=','cart.id_product')->join('users','users.id','=', 'cart.id_user')->where('users.id',$userId)->get();
                
            $order = new Orders;
            $order->id_user = $user->id;
            $order->id_shipping = $shipping->find($request->id)->id;
            $order->status = "nieopłacone";
            $order->if_paid = false;
            $order->order_date = now();
            $order->comment = $request->input('comment');
            $order->gift = $request->input('gift');
            $order->save();

            foreach($carts as $cart) {
                $orderDetails = new OrderDetails;
                $orderDetails->id_order = $order->id;
                $orderDetails->id_product = $cart->id_product;
                $orderDetails->quantity = $cart->quantity;
                $orderDetails->order_price = ($total*$cart->quantity)+$shipping->find($request->id)->shipping_price;
                $orderDetails->save(); 
            }
                
                $user->address = $request->input('address');
                $user->zip_code = $request->input('zip_code');
                $user->save();
                
                foreach($carts as $el) {
                    $product = Products::find($el->id_product);
                    if($product->condition >= $el->quantity){
                        $product->condition -= $el->quantity;
                        $product->save();
                    }
                }
        }
        Cart::where('id_user',$userId)->delete();
        return redirect('/orders/orderList');
    }
}