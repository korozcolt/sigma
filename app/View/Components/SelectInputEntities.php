<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectInputEntities extends Component
{
    public $options;
    public $parent;
    public $exists_id;
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
        return view('components.select-input-entities');
    }
}