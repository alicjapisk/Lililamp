<?php

namespace App\Http\Controllers;
use App\Models\Products;
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
    public function index(){
        $products = Products::all();
        $categories = Products::select('category')->distinct()->get();
        return view('products.list',['products'=>$products, 'categories' => $categories]);
    }

    public function search(Request $request){
        $category = $request->input('category');
        $products = Products::where('category', $category)->get();
        $categories = Products::select('category')->distinct()->get();
        return view('products.list', ['categories' => $categories, 'category'=>$category, 'products'=>$products]);
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
            $prod->description = $request->description;
            $prod->pictureURL = $request->pictureURL;
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
        $myProd=Products::find($id);
        if($myProd == null){
            $error_message = "Product id=".$id." not find";
            return view('products.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if ($myProd->count()>0)
        return view('products.show',['products'=>$myProd]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $myProd = Products::find($id);
        if ($myProd == null){
            $error_message = "Product id=".$id." not find";
            return view('products.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if($myProd->count()>0)
        return view('products.edit',['products'=>$myProd]);
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
            'name'=>'required',
            'category'=>'required',
            'price'=>'required',
            'condition'=>'required|integer',
            'description'=>'required',
            'pictureURL'=>'required',
           ]);
            if($validated){
                $products=Products::find($id);
                if($products != null){
                    $products->id = $request->id;
                    $products->name = $request->name;
                    $products->category = $request->category;
                    $products->price = $request->price;
                    $products->condition = $request->condition;
                    $products->description = $request->description;
                    $products->pictureURL = $request->pictureURL;
                    $products->save();
                    return redirect('/products/list');    
                }
                else{
                    $error_message = "Product id=".$id." not find";
                    return view('products.message',['message'=>$error_message,'type_of_message'=>'Error']);
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
        $products=Products::find($id);
        if($products != null){
            $products->delete();
            return redirect('/products/list');    
        }
        else{
            $error_message = "Product id=".$id." not find";
            return view('products.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
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

}

