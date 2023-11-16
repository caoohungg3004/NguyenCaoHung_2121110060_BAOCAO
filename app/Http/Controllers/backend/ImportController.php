<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product:: where('product.status','!=', 0)
           ->join ('category','category.id','=','product.category_id')
           ->join('brand','brand.id','=','product.brand_id')
           ->join('productstore','productstore.product_id','=','product.id')
           ->select('product.id','product.name','product.slug','product.status','product.image','category.name as categoryname','brand.name as brandname','productstore.price as priceroot','productstore.qty as quantity')
           ->orderBy('product.created_at')
           ->get();
        $listproduct = MyCart::getContent('listproduct');
        return view('backend.import.index', compact('products','listproduct'));
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
    public function storeimport(Request $request)
    {
        $arr_qty = $request->qty;
        $arr_price = $request->price;
        foreach ($arr_price as $productid => $price){
            $productstore = new $productstore();
            $productstore->product_id = $productid;
            $productstore->price = $price;
            $productstore->qty = $arr_qty[ $productid ];
            $productstore->created_at = date('Y-m-d H:i:s');
            $productstore->created_by = Auth ::id() ?? 1;
            $productstore -> save ();
        }
        session() ->forget('listproduct');
        toastr() ->success ('Thành Công!','Thông Báo');
        return redirect() -> route('import.index');

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
