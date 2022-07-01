<?php

namespace App;

use Illuminate\View\Component;

class Button extends Component
{
    public $color;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color, $type)
    {
        $this->color = $color;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app.button');
    }
}
