<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Console\View\Components\Line;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_product= Product::where('status','!=',0)->get();
        return view('backend.product.index',compact('list_product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list= Product::where('status','!=',0)->get();
        $list_category= Category::where('status','!=',0)->get();
        $list_brand= Brand::where('status','!=',0)->get();


        $html_category_id='';
        foreach($list_category as $item)
        {

            $html_category_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }

        $html_brand_id ='';
        foreach($list_brand as $item)
        {

            $html_brand_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }

        $html_sort_order ='';
        foreach($list as $item)
        {

            $html_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }

        return view('backend.product.create',compact('html_brand_id','html_category_id','html_sort_order'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $list_product= new Product;


        $list_product->name= $request->name;
        $list_product->slug= Str::slug($list_product->name= $request->name,'-');
        $list_product->category_id= $request->category_id;
        $list_product->brand_id= $request->brand_id;
        $list_product->price= $request->price;
        $list_product->price_sale= $request->price_sale;
        $list_product->qty= $request->qty;
        $list_product->detail= $request->detail;
        $list_product->metakey= $request->metakey;
        $list_product->metadesc= $request->metadesc;
        $list_product->status= $request->status;
        $list_product->sort_order= $request->sort_order;

        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
                $fileName = $list_product->slug.'.'.$extention;
                $file->move(public_path('img/product/'),$fileName);
                $list_product->image = $fileName;
        }
        if($list_product->save())
        {
            return redirect()->route('product.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('product.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if($product==NULL)
        {
            return redirect()->route('product.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.product.show',compact('product','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list= Product::where('status','!=',0)->get();
        $list_category= Category::where('status','!=',0)->get();
        $list_brand= Brand::where('status','!=',0)->get();


        $html_category_id='';
        foreach($list_category as $item)
        {

            $html_category_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }

        $html_brand_id ='';
        foreach($list_brand as $item)
        {

            $html_brand_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }

        $html_sort_order ='';
        foreach($list as $item)
        {

            $html_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        $product=Product::find($id);
        if($product==null)
        {
            return redirect()->route('product.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list = Product::all();
        return view("backend.product.edit",compact("product","html_sort_order","html_brand_id","html_category_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request,  $id)
    {

        $list_product = Product::find($id);
        $list_product->name= $request->name;
        $list_product->slug= Str::slug($list_product->name= $request->name,'-');
        $list_product->category_id= $request->category_id;
        $list_product->brand_id= $request->brand_id;
        $list_product->price= $request->price;
        $list_product->price_sale= $request->price_sale;
        $list_product->qty= $request->qty;
        $list_product->detail= $request->detail;
        $list_product->metakey= $request->metakey;
        $list_product->metadesc= $request->metadesc;
        $list_product->status= $request->status;
        $list_product->sort_order= $request->sort_order;
        $list_product->updated_at =date('Y-m-d H:i:s');
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
                $fileName = $list_product->slug.'.'.$extention;
                $file->move(public_path('img/product/'),$fileName);
                $list_product->image = $fileName;
        }
        if ($list_product->save()){

            return redirect()->route('product.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_product = Product::find($id);
        if($list_product==NULL)
        {
            return redirect()->route('product.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_product->delete()){


        return redirect()->route('product.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_product = Product::where('status', '=', '0')->get();
        return view('backend.product.trash', compact('list_product'));
    }



    public function delete($id)
    {

        $product = Product::find($id);
        if($product==NULL)
        {
            return redirect()->route('product.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $product->status = 0;
         $product->updated_at =date('Y-m-d H:i:s');

         $product->save();
        return redirect()->route('product.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_product = Product::find($id);
        if($list_product==NULL)
        {
            return redirect()->route('product.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_product->status = 2;

            $list_product->save();
        return redirect()->route('product.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_product = Product::find($id);
        if($list_product==NULL)
        {
            return redirect()->route('product.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_product->status = ($list_product->status==1)?2:1;

        $list_product->save();
        return redirect()->route('product.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}


