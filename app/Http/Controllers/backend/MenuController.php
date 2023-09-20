<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_menu= Menu::where('status','!=',0)->get();
        return view('backend.menu.index',compact('list_menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_menu= Menu::where('status','!=',0)->get();

        $http_parent_id ='';
        $http_table_id ='';
        foreach($list_menu as $item)
        {

            $http_parent_id .='<option value="'.$item->id.'">'.$item->name.'</option>';
            $http_table_id .='<option value="'.$item->table_id.'">'.$item->name.'</option>';

        }

        return view('backend.menu.create',compact('http_parent_id','http_table_id'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuStoreRequest $request)
    {
        $list_menu= new Menu;
        $list_menu->name= $request->name;
        $list_menu->link= $request->link;
        $list_menu->position= $request->position;


        $list_menu->table_id= $request->table_id;

        $list_menu->parent_id= $request->parent_id;
        $list_menu->type= $request->type;

        // $file = $request->file('image');
        // if ($file != NULL) {
        //     $extention = $file->getClientOriginalExtension();
        //         $fileName = $list_menu->slug.'.'.$extention;
        //         $file->move(public_path('images/'),$fileName);
        //         $list_menu->image = $fileName;
        // }


        $list_menu->status= $request->status;
        if($list_menu->save())
        {
            return redirect()->route('menu.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('menu.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        if($menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.menu.show',compact('menu','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_menu= Menu::where('status','!=',0)->get();
        $http_parent_id ='';
        $http_table_id ='';
        foreach($list_menu as $item)
        {

            $http_parent_id .='<option value="'.$item->id.'">'.$item->name.'</option>';
            $http_table_id .='<option value="'.$item->table_id.'">'.$item->name.'</option>';

        }
        $menu=Menu::find($id);
        if($menu==null)
        {
            return redirect()->route('menu.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list = Menu::all();
        return view("backend.menu.edit",compact("menu","http_parent_id","http_table_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuUpdateRequest $request,  $id)
    {


        $list_menu = Menu::find($id);
        $list_menu->name= $request->name;
        $list_menu->link= $request->link;
        $list_menu->position= $request->position;


        $list_menu->table_id= $request->table_id;

        $list_menu->parent_id= $request->parent_id;
        $list_menu->type= $request->type;
        $list_menu->updated_at =date('Y-m-d H:i:s');

        $list_menu->status = $request->status;
        // //up load file
        // $file = $request->file('image');
        // if ($file != NULL) {
        //     $extention = $file->getClientOriginalExtension();
        //     if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
        //         $fileName = $list_menu->slug.'.'.$extention;
        //         $file->move(public_path('images/menu'), $fileName);
        //         $list_menu->image = $fileName;
        //     }
        // }
        //$list_menu->image=$request->image;
        if ($list_menu->save()){

            return redirect()->route('menu.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_menu = Menu::find($id);
        if($list_menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_menu->delete()){


        return redirect()->route('menu.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_menu = Menu::where('status', '=', '0')->get();
        return view('backend.menu.trash', compact('list_menu'));
    }



    public function delete($id)
    {

        $menu = Menu::find($id);
        if($menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $menu->status = 0;
         $menu->updated_at =date('Y-m-d H:i:s');

         $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_menu = Menu::find($id);
        if($list_menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_menu->status = 2;

            $list_menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_menu = Menu::find($id);
        if($list_menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_menu->status = ($list_menu->status==1)?2:1;

        $list_menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}
