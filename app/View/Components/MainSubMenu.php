<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainSubMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $menu_row=null;
    public function __construct($menu)
    {
        $this->menu_row=$menu;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menurow=$this->menu_row;
        $arg=[
            ['status','=','1'],
            ['position','=','mainmenu'],
            ['parent_id','=',$menurow->id]
        ];
        $menus=Menu::where($arg)->get();


        return view('components.main-sub-menu',compact('menurow','menus'));
    }
}
