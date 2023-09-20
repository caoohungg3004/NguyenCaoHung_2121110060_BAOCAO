<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Link;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class postController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_post= Post::where('status','!=',0)->get();
        return view('backend.post.index',compact('list_post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_post= Post::where('status','!=',0)->get();
        $list_topic= Topic::where('status','!=',0)->get();
        $http_topic_id ='';
        foreach($list_topic as $item)
        {

            $http_topic_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }

        return view('backend.post.create',compact('http_topic_id','list_post'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $list_post= new Post;

        $list_post->slug= Str::slug($list_post->title= $request->title,'-');

        $list_post->metakey= $request->metakey;
        $list_post->metadesc= $request->metadesc;
        $list_post->type= $request->type;
        $list_post->detail= $request->detail;
        $list_post->title= $request->title;
        $list_post->topic_id= $request->topic_id;


        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
                $fileName = $list_post->slug.'.'.$extention;
                $file->move(public_path('img/post/'),$fileName);
                $list_post->image = $fileName;
        }


        $list_post->status= $request->status;
        if($list_post->save())
        {

            $link= new Link();
            $link->slug= $list_post->slug;
            $link->table_id= $list_post->id;
            $link->type='post';
            $link->save();

            return redirect()->route('post.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('post.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if($post==NULL)
        {
            return redirect()->route('post.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.post.show',compact('post','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_topic= Topic::where('status','!=',0)->get();
        $http_topic_id ='';
        foreach($list_topic as $item)
        {

            $http_topic_id .='<option value="'.$item->id.'">'.$item->name.'</option>';

        }
        $post=Post::find($id);
        if($post==null)
        {
            return redirect()->route('post.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list = Post::all();
        return view("backend.post.edit",compact("post","http_topic_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request,  $id)
    {


        $list_post = Post::find($id);

        $list_post->slug = Str::of($request->title)->slug('-');
        $list_post->type= $request->type;
        $list_post->detail= $request->detail;
        $list_post->title= $request->title;
        $list_post->topic_id= $request->topic_id;
        //$post->level = $request->level;
        $list_post->metakey = $request->metakey;
        $list_post->metadesc = $request->metadesc;
        $list_post->updated_at =date('Y-m-d H:i:s');

        $list_post->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $list_post->slug.'.'.$extention;
                $file->move(public_path('img/post/'), $fileName);
                $list_post->image = $fileName;
            }
        }
        //$list_post->image=$request->image;
        if ($list_post->save()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'post']])->first();
            $link->slug=$list_post->slug;
            $link->save();
            return redirect()->route('post.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_post = Post::find($id);
        if($list_post==NULL)
        {
            return redirect()->route('post.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_post->delete()){

            $link=Link::where([['table_id','=',$id],['type','=','post']])->first();
            $link->delete();
        return redirect()->route('post.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_post = Post::where('status', '=', '0')->get();
        return view('backend.post.trash', compact('list_post'));
    }



    public function delete($id)
    {

        $post = Post::find($id);
        if($post==NULL)
        {
            return redirect()->route('post.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $post->status = 0;
         $post->updated_at =date('Y-m-d H:i:s');

         $post->save();
        return redirect()->route('post.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_post = Post::find($id);
        if($list_post==NULL)
        {
            return redirect()->route('post.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_post->status = 2;

            $list_post->save();
        return redirect()->route('post.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_post = Post::find($id);
        if($list_post==NULL)
        {
            return redirect()->route('post.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_post->status = ($list_post->status==1)?2:1;

        $list_post->save();
        return redirect()->route('post.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}
