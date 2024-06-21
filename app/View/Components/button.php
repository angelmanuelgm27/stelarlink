<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class button extends Component
{
    public $text;
    public $url;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($text, $url, $class)
    {
        //
        $this->text = $text;
        $this->url = $url;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
