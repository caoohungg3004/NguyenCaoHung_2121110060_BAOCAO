<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Link;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_category= Category::where('status','!=',0)->get();
        return view('backend.category.index',compact('list_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_category= Category::where('status','!=',0)->get();

        $http_sort_order ='';
        $http_parent_id ='';

        foreach($list_category as $item)
        {

            $http_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

            $http_parent_id .='<option value="'.$item->parent_id.'">Sau: '.$item->name.'</option>';

        }

        return view('backend.category.create',compact('http_sort_order','http_parent_id'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $list_category= new Category;
        $list_category->name= $request->name;
        $list_category->slug= Str::slug($list_category->name= $request->name,'-');

        $list_category->metakey= $request->metakey;
        $list_category->metadesc= $request->metadesc;

        //
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
                $fileName = $list_category->slug.'.'.$extention;
                $file->move(public_path('img/category/'),$fileName);
                $list_category->image = $fileName;
        }

        $list_category->sort_order= $request->sort_order;
        $list_category->parent_id= $request->parent_id;

        $list_category->status= $request->status;
        if($list_category->save())
        {

            $link= new Link();
            $link->slug= $list_category->slug;
            $link->table_id= $list_category->id;
            $link->type='category';
            $link->save();

            return redirect()->route('category.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('category.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if($category==NULL)
        {
            return redirect()->route('category.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.category.show',compact('category','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_category= Category::where('status','!=',0)->get();

        $http_sort_order ='';
        $http_parent_id ='';

        foreach($list_category as $item)
        {

            $http_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

            $http_parent_id .='<option value="'.$item->parent_id.'">Sau: '.$item->name.'</option>';

        }
        $category=Category::find($id);
        if($category==null)
        {
            return redirect()->route('category.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list_category = Category::all();
        return view("backend.category.edit",compact("category","http_sort_order","http_parent_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request,  $id)
    {


        $list_category = Category::find($id);
        $list_category->name = $request->name;
        $list_category->slug = Str::of($request->name)->slug('-');
        $list_category->sort_order = $request->sort_order;
        $list_category->parent_id = $request->parent_id;

        //$category->level = $request->level;
        $list_category->metakey = $request->metakey;
        $list_category->metadesc = $request->metadesc;
        $list_category->updated_at =date('Y-m-d H:i:s');

        $list_category->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $list_category->slug.'.'.$extention;
                $file->move(public_path('img/category/'), $fileName);
                $list_category->image = $fileName;
            }
        }
        //$list_category->image=$request->image;
        if ($list_category->save()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'category']])->first();
            $link->slug=$list_category->slug;
            $link->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_category = Category::find($id);
        if($list_category==NULL)
        {
            return redirect()->route('category.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_category->delete()){

            $link=Link::where([['table_id','=',$id],['type','=','category']])->first();
            $link->delete();
        return redirect()->route('category.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_category = Category::where('status', '=', '0')->get();
        return view('backend.category.trash', compact('list_category'));
    }



    public function delete($id)
    {

        $category = Category::find($id);
        if($category==NULL)
        {
            return redirect()->route('category.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $category->status = 0;
         $category->updated_at =date('Y-m-d H:i:s');

         $category->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_category = Category::find($id);
        if($list_category==NULL)
        {
            return redirect()->route('category.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_category->status = 2;

            $list_category->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_category = Category::find($id);
        if($list_category==NULL)
        {
            return redirect()->route('category.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_category->status = ($list_category->status==1)?2:1;

        $list_category->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}
