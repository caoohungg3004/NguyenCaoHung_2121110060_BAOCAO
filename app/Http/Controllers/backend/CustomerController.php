<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Link;
use App\Http\Requests\customerStoreRequest;
use App\Http\Requests\customerUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_customer= Customer::where('status','!=',0)->get();
        return view('backend.customer.index',compact('list_customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_customer= Customer::where('status','!=',0)->get();
        $list_user= User::where('status','!=',0)->get();
        $http_user_id ='';
        foreach($list_user as $item)
        {

            $http_user_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }

        return view('backend.customer.create',compact('http_user_id','list_customer'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $list_customer= new Customer;

        $list_customer->slug= Str::slug($list_customer->title= $request->title,'-');

        $list_customer->metakey= $request->metakey;
        $list_customer->metadesc= $request->metadesc;
        $list_customer->type= $request->type;
        $list_customer->detail= $request->detail;
        $list_customer->title= $request->title;
        $list_customer->user_id= $request->user_id;


        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
                $fileName = $list_customer->slug.'.'.$extention;
                $file->move(public_path('img/customer/'),$fileName);
                $list_customer->image = $fileName;
        }


        $list_customer->status= $request->status;
        if($list_customer->save())
        {

            $link= new Link();
            $link->slug= $list_customer->slug;
            $link->table_id= $list_customer->id;
            $link->type='customer';
            $link->save();

            return redirect()->route('customer.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('customer.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if($customer==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.customer.show',compact('customer','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_user= User::where('status','!=',0)->get();
        $http_user_id ='';
        foreach($list_user as $item)
        {

            $http_user_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }
        $customer=Customer::find($id);
        if($customer==null)
        {
            return redirect()->route('customer.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list = Customer::all();
        return view("backend.customer.edit",compact("customer","http_user_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request,  $id)
    {


        $list_customer = Customer::find($id);

        $list_customer->slug = Str::of($request->title)->slug('-');
        $list_customer->type= $request->type;
        $list_customer->detail= $request->detail;
        $list_customer->title= $request->title;
        $list_customer->user_id= $request->user_id;
        //$customer->level = $request->level;
        $list_customer->metakey = $request->metakey;
        $list_customer->metadesc = $request->metadesc;
        $list_customer->updated_at =date('Y-m-d H:i:s');

        $list_customer->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $list_customer->slug.'.'.$extention;
                $file->move(public_path('img/customer/'), $fileName);
                $list_customer->image = $fileName;
            }
        }
        //$list_customer->image=$request->image;
        if ($list_customer->save()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'customer']])->first();
            $link->slug=$list_customer->slug;
            $link->save();
            return redirect()->route('customer.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_customer = Customer::find($id);
        if($list_customer==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_customer->delete()){

            $link=Link::where([['table_id','=',$id],['type','=','customer']])->first();
            $link->delete();
        return redirect()->route('customer.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_customer = Customer::where('status', '=', '0')->get();
        return view('backend.customer.trash', compact('list_customer'));
    }



    public function delete($id)
    {

        $customer = Customer::find($id);
        if($customer==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $customer->status = 0;
         $customer->updated_at =date('Y-m-d H:i:s');

         $customer->save();
        return redirect()->route('customer.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_customer = Customer::find($id);
        if($list_customer==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_customer->status = 2;

            $list_customer->save();
        return redirect()->route('customer.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_customer = Customer::find($id);
        if($list_customer==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_customer->status = ($list_customer->status==1)?2:1;

        $list_customer->save();
        return redirect()->route('customer.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}
