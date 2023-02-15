<?php

namespace App\View\Components\Pages;

use Illuminate\View\Component;

class Delivery extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $datadetail;
    public function __construct($datadetail)
    {
        //
        $this->datadetail = $datadetail;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pages.delivery');
    }
}
