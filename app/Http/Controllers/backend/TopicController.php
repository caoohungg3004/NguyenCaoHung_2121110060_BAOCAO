<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Link;
use App\Http\Requests\topicStoreRequest;
use App\Http\Requests\topicUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_topic= Topic::where('status','!=',0)->get();
        return view('backend.topic.index',compact('list_topic'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_topic= Topic::where('status','!=',0)->get();
        $http_parent_id ='';

        foreach($list_topic as $item)
        {
            $http_parent_id .='<option value="'.$item->id.'">'.$item->name.'</option>';


        }

        return view('backend.topic.create',compact('http_parent_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicStoreRequest $request)
    {

        $list_topic= new Topic;
        $list_topic->name= $request->name;
        $list_topic->slug= Str::slug($list_topic->name= $request->name,'-');
        $list_topic->parent_id= $request->parent_id;
        $list_topic->metakey= $request->metakey;
        $list_topic->metadesc= $request->metadesc;
        // $file = $request->file('image');
        // if ($file != NULL) {
        //     $extention = $file->getClientOriginalExtension();
        //         $fileName = $list_topic->slug.'.'.$extention;
        //         $file->move(public_path('images/'),$fileName);
        //         $list_topic->image = $fileName;
        // }


        $list_topic->status= $request->status;
        if($list_topic->save())
        {

            $link= new Link();
            $link->slug= $list_topic->slug;
            $link->table_id= $list_topic->id;
            $link->type='topic';
            $link->save();

            return redirect()->route('topic.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('topic.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::find($id);
        if($topic==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.topic.show',compact('topic','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_topic= Topic::where('status','!=',0)->get();
        $http_parent_id ='';

        foreach($list_topic as $item)
        {
            $http_parent_id .='<option value="'.$item->id.'">'.$item->name.'</option>';


        }
        $topic=Topic::find($id);
        if($topic==null)
        {
            return redirect()->route('topic.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list = Topic::all();
        return view("backend.topic.edit",compact("topic",'http_parent_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicUpdateRequest $request,  $id)
    {


        $list_topic = Topic::find($id);
        $list_topic->name = $request->name;
        $list_topic->slug = Str::of($request->name)->slug('-');
        $list_topic->parent_id = $request->parent_id;
        //$topic->level = $request->level;
        $list_topic->metakey = $request->metakey;
        $list_topic->metadesc = $request->metadesc;
        $list_topic->updated_at =date('Y-m-d H:i:s');

        $list_topic->status = $request->status;
        //up load file
        // $file = $request->file('image');
        // if ($file != NULL) {
        //     $extention = $file->getClientOriginalExtension();
        //     if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
        //         $fileName = $list_topic->slug.'.'.$extention;
        //         $file->move(public_path('images/topic'), $fileName);
        //         $list_topic->image = $fileName;
        //     }
        // }
        //$list_topic->image=$request->image;
        if ($list_topic->save()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'topic']])->first();
            $link->slug=$list_topic->slug;
            $link->save();
            return redirect()->route('topic.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_topic = Topic::find($id);
        if($list_topic==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_topic->delete()){

            $link=Link::where([['table_id','=',$id],['type','=','topic']])->first();
            $link->delete();
        return redirect()->route('topic.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_topic = Topic::where('status', '=', '0')->get();
        return view('backend.topic.trash', compact('list_topic'));
    }



    public function delete($id)
    {

        $topic = Topic::find($id);
        if($topic==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $topic->status = 0;
         $topic->updated_at =date('Y-m-d H:i:s');

         $topic->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_topic = Topic::find($id);
        if($list_topic==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_topic->status = 2;

            $list_topic->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_topic = Topic::find($id);
        if($list_topic==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_topic->status = ($list_topic->status==1)?2:1;

        $list_topic->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}
