<?php

namespace App\View\Components;

use Illuminate\View\Component;

class alert extends Component
{
     /**
     * Create a new component instance.
     *
     * @return void
     */
    public $class;
    public $message;
    
    public function __construct($class,$message)
    {
        //
        $this->class=$class;
        $this->message=$message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}