<?php

namespace App\Http\Controllers;
use App\Models\Personalized;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myProd = Products::all();
        return view('products.list',['prod'=>$myProd]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required',
            'category'=>'required',
            'price'=>'required',
            'condition'=>'required|integer',
           ]);
           if($validated){
            $prod=new Products();
            $prod->name = $request->name;
            $prod->category = $request->category;
            $prod->price = $request->price;
            $prod->condition = $request->condition;
            $prod->save();
            return redirect('/products/list');
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    public function lampkiList()
    {
        $myProd = Products::where('category','lampka')->get();
            return view('products.lampki',['prod'=>$myProd]);
    }
    public function dywanyList()
    {
        $myProd = Products::where('category','dywan')->get();
            return view('products.dywany',['prod'=>$myProd]);
    }
    public function tapetyList()
        {
        $myProd = Products::where('category','tapeta')->get();
            return view('products.tapety',['prod'=>$myProd]);
        }
    
    public function productShow($id){
        $myProd = Products::all()->where('id',$id);
            return view('products.product',['prod'=>$myProd]);
        }
    
        public function getAddToCart(Request $request, $id)
        {
            $product = Products::find($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $product->id);
            $request->session()->put('cart', $cart);
            $myProd = Products::all()->where('id',$id);
            return view('products.product',['prod'=>$myProd]);
        }
        public function getReduceByOne($id) {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->reduceByOne($id);
    
            if (count($cart->items) > 0) {
                Session::put('cart', $cart);
            } else {
                Session::forget('cart');
            }
            return redirect()->route('product.shoppingCart');
        }
    
        public function getRemoveItem($id) {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->removeItem($id);
    
            if (count($cart->items) > 0) {
                Session::put('cart', $cart);
            } else {
                Session::forget('cart');
            }
    
            return redirect()->route('product.shoppingCart');
        }
    
        public function getCart()
        {
            if (!Session::has('cart')) {
                return view('shopping-cart');
            }
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            return view('shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        }

        public function getCheckout()
        {
            if (!Session::has('cart')) {
                return view('shopping-cart');
            }
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $total = $cart->totalPrice;
            return view('checkout', ['total' => $total]);
        }
}

