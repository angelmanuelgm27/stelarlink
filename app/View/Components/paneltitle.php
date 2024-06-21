<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class paneltitle extends Component
{
    public $titleName;
    /**
     * Create a new component instance.
     */
    public function __construct($titleName)
    {
        //
        $this->titleName = $titleName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.paneltitle');
    }
}
