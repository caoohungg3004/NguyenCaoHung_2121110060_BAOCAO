<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class Categorylist extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function render()
    {
        $list_category=Category::where([['parent_id', '=', 0], ['status', '=', 1]])->get();

        return view('components.categorylist',compact('list_category'));
    }
}
