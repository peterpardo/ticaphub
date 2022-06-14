<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class ReportCard extends Component
{
    public $name;
    public $count;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $count)
    {
        $this->name = $name;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.report-card');
    }
}
