<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart=Cart::find($id);
        if($cart == null){
            $error_message = "Cart id=".$id." not find";
            return view('cart.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if ($cart->count()>0)
        return view('shop.show',['cart'=>$cart]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart=Cart::find($id);
        if($cart != null){
            $cart->delete();
            return redirect('shop/shopping-cart');    
        }
        else{
            $error_message = "Cart id=".$id." not find";
            return view('cart.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
    }
    public function addToCart(Request $request, $id)
    {
        $product = Products::find($id);
        if ($product->condition < $request->input('quantity')) {
        return redirect()->back()->with('error', 'Niestety, nie mamy takiej ilości tego produktu na stanie. Dostępna ilość: ' . $product->condition);
        }
        $user = auth()->user();
        $cart = new Cart();
        $cart->id_product = $product->id;
        $cart->id_user = $user->id;
        $cart->quantity = $request->input('quantity');
        $cart->save();
        return redirect('/shop/shopping-cart');
    }
    public function showCart()
    {
    $userId = Auth::id();
    $cartItems = Cart::join('products', 'products.id','=','cart.id_product')->join('users','users.id','=', 'cart.id_user')->where('users.id',$userId)->get();
    if($cartItems->isEmpty()){
        return view('shop.shopping-cart', ['empty' => true]);
    }
    $total = Cart::join('products', 'products.id','=','cart.id_product')->join('users','users.id','=', 'cart.id_user')->where('users.id',$userId)->sum(DB::raw('products.price * cart.quantity'));
    
    return view('shop.shopping-cart',['cartItems'=>$cartItems, 'total'=>$total]);

    }
}