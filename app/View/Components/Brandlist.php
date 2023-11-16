<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Brand;
class Brandlist extends Component
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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list_brand=Brand::where('status',1)->get();

        
        return view('components.brandlist',compact('list_brand'));
    }
}
