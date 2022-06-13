<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $scripts;
    public $title;

    public function __construct($scripts = [], $title)
    {
        $this->scripts = $scripts;
        $this->title= $title;
    }
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
