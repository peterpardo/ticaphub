<?php

namespace App;

use Illuminate\View\Component;

class SidebarLink extends Component
{
    public $route;
    public $name;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $name, $icon)
    {
        $this->route = $route;
        $this->name = $name;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app.sidebar-link');
    }
}
