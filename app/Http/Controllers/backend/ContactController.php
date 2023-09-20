<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Console\View\Components\Line;



class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_contact= Contact::where('status','!=',0)->get();
        return view('backend.contact.index',compact('list_contact'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_contact= Contact::where('status','!=',0)->get();
        $list_user= User::where('status','!=',0)->get();



        $html_user_id='';
        foreach($list_user as $item)
        {

            $html_user_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }



        $html_sort_order ='';
        foreach($list_contact as $item)
        {

            $html_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }

        return view('backend.contact.create',compact('html_user_id','html_sort_order'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactStoreRequest $request)
    {
        $list_contact= new Contact;

        $list_contact->user_id= $request->user_id;
        $list_contact->name= $request->name;
        $list_contact->email= $request->email;
        $list_contact->phone= $request->phone;
        $list_contact->title= $request->title;
        $list_contact->content= $request->content;
        $list_contact->replay_id= $request->replay_id;
        $list_contact->metakey= $request->metakey;
        $list_contact->metadesc= $request->metadesc;
        $list_contact->status= $request->status;
        $list_contact->sort_order= $request->sort_order;

        if($list_contact->save())
        {
            return redirect()->route('contact.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('contact.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);
        if($contact==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.contact.show',compact('contact','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list= Contact::where('status','!=',0)->get();
        $list_user= User::where('status','!=',0)->get();
        $html_user_id='';
        foreach($list_user as $item)
        {

            $html_user_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }


        $html_sort_order ='';
        foreach($list as $item)
        {

            $html_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        $contact=Contact::find($id);
        if($contact==null)
        {
            return redirect()->route('contact.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list = Contact::all();
        return view("backend.contact.edit",compact("contact","html_sort_order","html_user_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactUpdateRequest $request,  $id)
    {

        $list_contact = Contact::find($id);
        $list_contact->name= $request->name;
        $list_contact->user_id= $request->user_id;
        $list_contact->email= $request->email;
        $list_contact->phone= $request->phone;
        $list_contact->title= $request->title;
        $list_contact->content= $request->content;
        $list_contact->replay_id= $request->replay_id;

        $list_contact->metakey= $request->metakey;
        $list_contact->metadesc= $request->metadesc;
        $list_contact->status= $request->status;
        $list_contact->sort_order= $request->sort_order;
        $list_contact->updated_at =date('Y-m-d H:i:s');

        if ($list_contact->save()){

            return redirect()->route('contact.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_contact = Contact::find($id);
        if($list_contact==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_contact->delete()){


        return redirect()->route('contact.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_contact = Contact::where('status', '=', '0')->get();
        return view('backend.contact.trash', compact('list_contact'));
    }



    public function delete($id)
    {

        $contact = Contact::find($id);
        if($contact==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $contact->status = 0;
         $contact->updated_at =date('Y-m-d H:i:s');

         $contact->save();
        return redirect()->route('contact.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_contact = Contact::find($id);
        if($list_contact==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_contact->status = 2;

            $list_contact->save();
        return redirect()->route('contact.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_contact = Contact::find($id);
        if($list_contact==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_contact->status = ($list_contact->status==1)?2:1;

        $list_contact->save();
        return redirect()->route('contact.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}


