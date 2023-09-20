<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use App\Http\Requests\orderStoreRequest;
use App\Http\Requests\orderUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Console\View\Components\Line;



class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_order= order::where('status','!=',0)->get();
        return view('backend.order.index',compact('list_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $list_order= order::where('status','!=',0)->get();
        // $list_user= User::where('status','!=',0)->get();



        // $html_user_id='';
        // foreach($list_user as $item)
        // {

        //     $html_user_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        // }



        // $html_sort_order ='';
        // foreach($list_order as $item)
        // {

        //     $html_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        // }

        // return view('backend.order.create',compact('html_user_id','html_sort_order'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(orderStoreRequest $request)
    {
        // $list_order= new order;

        // $list_order->user_id= $request->user_id;
        // $list_order->name= $request->name;
        // $list_order->email= $request->email;
        // $list_order->phone= $request->phone;
        // $list_order->title= $request->title;
        // $list_order->content= $request->content;
        // $list_order->replay_id= $request->replay_id;
        // $list_order->metakey= $request->metakey;
        // $list_order->metadesc= $request->metadesc;
        // $list_order->status= $request->status;
        // $list_order->sort_order= $request->sort_order;

        // if($list_order->save())
        // {
        //     return redirect()->route('order.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        // }
        // return redirect()->route('order.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        // ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = order::find($id);
        if($order==NULL)
        {
            return redirect()->route('order.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.order.show',compact('order','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $list= order::where('status','!=',0)->get();
        // $list_user= User::where('status','!=',0)->get();
        // $html_user_id='';
        // foreach($list_user as $item)
        // {

        //     $html_user_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        // }


        // $html_sort_order ='';
        // foreach($list as $item)
        // {

        //     $html_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        // }
        // $order=order::find($id);
        // if($order==null)
        // {
        //     return redirect()->route('order.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        // }
        // $list = order::all();
        // return view("backend.order.edit",compact("order","html_sort_order","html_user_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(orderUpdateRequest $request,  $id)
    {

        // $list_order = order::find($id);
        // $list_order->name= $request->name;
        // $list_order->user_id= $request->user_id;
        // $list_order->email= $request->email;
        // $list_order->phone= $request->phone;
        // $list_order->address= $request->address;
        // $list_order->content= $request->content;
        // $list_order->replay_id= $request->replay_id;
        // $list_order->status= $request->status;
        // $list_order->sort_order= $request->sort_order;
        // $list_order->updated_at =date('Y-m-d H:i:s');

        // if ($list_order->save()){

        //     return redirect()->route('order.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_order = order::find($id);
        if($list_order==NULL)
        {
            return redirect()->route('order.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_order->delete()){


        return redirect()->route('order.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_order = order::where('status', '=', '0')->get();
        return view('backend.order.trash', compact('list_order'));
    }



    public function delete($id)
    {

        $order = order::find($id);
        if($order==NULL)
        {
            return redirect()->route('order.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $order->status = 0;
         $order->updated_at =date('Y-m-d H:i:s');

         $order->save();
        return redirect()->route('order.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_order = order::find($id);
        if($list_order==NULL)
        {
            return redirect()->route('order.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_order->status = 2;

            $list_order->save();
        return redirect()->route('order.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_order = order::find($id);
        if($list_order==NULL)
        {
            return redirect()->route('order.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_order->status = ($list_order->status==1)?2:1;

        $list_order->save();
        return redirect()->route('order.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}


