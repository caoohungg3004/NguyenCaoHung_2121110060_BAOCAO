<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Link;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_brand= Brand::where('status','!=',0)->get();
        return view('backend.brand.index',compact('list_brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_brand= Brand::where('status','!=',0)->get();

        $http_sort_order ='';
        foreach($list_brand as $item)
        {

            $http_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }

        return view('backend.brand.create',compact('http_sort_order'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        $list_brand= new brand;
        $list_brand->name= $request->name;
        $list_brand->slug= Str::slug($list_brand->name= $request->name,'-');
        $list_brand->sort_order= $request->sort_order;
        $list_brand->metakey= $request->metakey;
        $list_brand->metadesc= $request->metadesc;
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
                $fileName = $list_brand->slug.'.'.$extention;
                $file->move(public_path('img/brand/'),$fileName);
                $list_brand->image = $fileName;
        }


        $list_brand->status= $request->status;
        if($list_brand->save())
        {

            $link= new Link();
            $link->slug= $list_brand->slug;
            $link->table_id= $list_brand->id;
            $link->type='brand';
            $link->save();

            return redirect()->route('brand.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('brand.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::find($id);
        if($brand==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.brand.show',compact('brand','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand=Brand::find($id);
        if($brand==null)
        {
            return redirect()->route('brand.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list = Brand::all();
        return view("backend.Brand.edit",compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request,  $id)
    {


        $list_brand = Brand::find($id);
        $list_brand->name = $request->name;
        $list_brand->slug = Str::of($request->name)->slug('-');
        $list_brand->sort_order = $request->sort_order;
        //$brand->level = $request->level;
        $list_brand->metakey = $request->metakey;
        $list_brand->metadesc = $request->metadesc;
        $list_brand->updated_at =date('Y-m-d H:i:s');

        $list_brand->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $list_brand->slug.'.'.$extention;
                $file->move(public_path('img/brand/'), $fileName);
                $list_brand->image = $fileName;
            }
        }
        //$list_brand->image=$request->image;
        if ($list_brand->save()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'brand']])->first();
            $link->slug=$list_brand->slug;
            $link->save();
            return redirect()->route('brand.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_brand = Brand::find($id);
        if($list_brand==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_brand->delete()){

            $link=Link::where([['table_id','=',$id],['type','=','brand']])->first();
            $link->delete();
        return redirect()->route('brand.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_brand = Brand::where('status', '=', '0')->get();
        return view('backend.brand.trash', compact('list_brand'));
    }



    public function delete($id)
    {

        $brand = Brand::find($id);
        if($brand==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $brand->status = 0;
         $brand->updated_at =date('Y-m-d H:i:s');

         $brand->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_brand = Brand::find($id);
        if($list_brand==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_brand->status = 2;

            $list_brand->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_brand = Brand::find($id);
        if($list_brand==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_brand->status = ($list_brand->status==1)?2:1;

        $list_brand->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}
