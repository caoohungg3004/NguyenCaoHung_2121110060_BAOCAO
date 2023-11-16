<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MyCart5;

use App\Models\Product;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where([['status','!=',0],['roles','=','customer']])
            ->select('id','name','username','status','image','phone','email')
            ->orderBy('created_at')
            ->get();
        $products = Product::where('product.status','!=',0)
             ->join('category','category.id','=','product.category_id')
             ->join('brand','brand.id','=','product.brand_id')
             ->select('product.id','product.name','product.slug','product.status','product.image','category.name as categoryname' , 'brand.name as brandname' )
             ->orderBy('product.created_at')
             ->get();
             $cart_content = MyCart ::getContent('carts');
             return view('backend.export.index', compact('products','customers','cart_content'));     
    }
    public function selectproduct(Request $request)
    {
        $id = $request->productid;
        $product = Product::where('product.id',$id)
        ->join('category','category.id','product.category_id')
        ->join('brand','brand.id','=','product.brand_id')
        ->select('product.id','product.name','product.slug','product.status','product.image','category.name as categoryname' , 'brand.name as brandname' )
        ->first();
         $cart_item = [
            'id' => $id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'image' => $product->image,
            'categoryname' => $product->categoryname,
            'brandname' => $product->brandname
         ];
         MyCart::addCart($cart_item);
         $listcat = MyCart::getContent('carts');
         $result = '';
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
}
