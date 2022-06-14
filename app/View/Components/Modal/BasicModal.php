<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class BasicModal extends Component
{
    public $title;
    public $btnColor;
    public $closeModal;
    public $submitModal;
    public $btnName;
    public $isOpen;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = '', $btnColor = 'green', $btnName, $closeModal, $submitModal, $isOpen)
    {
        $this->title = $title;
        $this->btnColor = $btnColor;
        $this->closeModal = $closeModal;
        $this->submitModal = $submitModal;
        $this->btnName = $btnName;
        $this->isOpen = $isOpen;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.basic-modal');
    }
}
