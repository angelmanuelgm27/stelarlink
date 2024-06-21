<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class plans extends Component
{
    public $class;
    public $planName;
    public $planPrice;
    public $planVelocityLoad;
    public $planVelocityDownload;

    public $image;

    /**
     * Create a new component instance.
     */
    public function __construct($planName, $planPrice, $planVelocityDownload, $planVelocityLoad, $class, $image)
    {
        //
        $this->planName = $planName;
        $this->planPrice = $planPrice;
        $this->planVelocityDownload = $planVelocityDownload;
        $this->planVelocityLoad = $planVelocityLoad;
        $this->class = $class;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.plans');
    }
}
