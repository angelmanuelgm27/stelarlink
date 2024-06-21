<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class map extends Component
{
    public $coords;
    /**
     * Create a new component instance.
     */
    public function __construct($coords)
    {
        //
        $this->coords = $coords;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.map');
    }
}
