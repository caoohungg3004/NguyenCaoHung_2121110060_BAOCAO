<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Link;
use App\Http\Requests\sliderStoreRequest;
use App\Http\Requests\sliderUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_slider= Slider::where('status','!=',0)->get();
        return view('backend.slider.index',compact('list_slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_slider= Slider::where('status','!=',0)->get();

        $http_sort_order ='';
        foreach($list_slider as $item)
        {

            $http_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }

        return view('backend.slider.create',compact('http_sort_order'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderStoreRequest $request)
    {
        $list_slider= new Slider;
        $list_slider->name= $request->name;

        $list_slider->sort_order= $request->sort_order;
        $list_slider->link= $request->link;
        $list_slider->position= $request->position;
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
                $fileName = $list_slider->slug.'.'.$extention;
                $file->move(public_path('img/slider'),$fileName);
                $list_slider->image = $fileName;
        }


        $list_slider->status= $request->status;
        if($list_slider->save())
        {

            return redirect()->route('slider.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
        }
        return redirect()->route('slider.index')->with('message',['type'=>'success','mgs'=>'Thêm không thành công']);

        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $slider = Slider::find($id);
        if($slider==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.slider.show',compact('slider','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_slider= Slider::where('status','!=',0)->get();

        $http_sort_order ='';
        foreach($list_slider as $item)
        {

            $http_sort_order .='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        $slider=Slider::find($id);
        if($slider==null)
        {
            return redirect()->route('slider.index')->with("message",['type'=>'danger','msf'=>'không tồn tại mẫu tin này']);
        }
        $list = Slider::all();
        return view("backend.slider.edit",compact("slider","http_sort_order"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request,  $id)
    {


        $list_slider = Slider::find($id);
        $list_slider->name = $request->name;
        $list_slider->sort_order= $request->sort_order;
        $list_slider->link= $request->link;
        $list_slider->position= $request->position;
        $list_slider->sort_order = $request->sort_order;
        //$slider->level = $request->level;

        $list_slider->updated_at =date('Y-m-d H:i:s');

        $list_slider->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $list_slider->slug.'.'.$extention;
                $file->move(public_path('img/slider'), $fileName);
                $list_slider->image = $fileName;
            }
        }
        //$list_slider->image=$request->image;
        if ($list_slider->save()){

            return redirect()->route('slider.index')->with('message', ['type' => 'success','mgs' => 'Cập nhật mẫu tin thành công!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $list_slider = Slider::find($id);
        if($list_slider==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        if($list_slider->delete()){



        return redirect()->route('slider.trash')->with('message', ['type' => 'success','mgs' => 'Xóa mẫu tin thành công!']);
        }
    }
    public function trash()
    {


        $list_slider = Slider::where('status', '=', '0')->get();
        return view('backend.slider.trash', compact('list_slider'));
    }



    public function delete($id)
    {

        $slider = Slider::find($id);
        if($slider==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $slider->status = 0;
         $slider->updated_at =date('Y-m-d H:i:s');

         $slider->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success','mgs' => 'Xóa vào thùng rác thành công!']);
        }

    }
    public function restore($id)
    {
        $list_slider = Slider::find($id);
        if($list_slider==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $list_slider->status = 2;

            $list_slider->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success','mgs' => 'Khôi phục thành công!']);
        }

    }

    public function status($id)
    {
        $list_slider = Slider::find($id);
        if($list_slider==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','mgs' => 'Mẫu tin không tồn tại!']);
        }

        $list_slider->status = ($list_slider->status==1)?2:1;

        $list_slider->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success','mgs' => 'Thay đổi trạng thái thành công!']);


    }



}
