<?php

namespace App\View\Components\vendor;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class stat extends Component
{
    /**
     * Create a new component instance.
     */
    public $store;
    public function __construct($store) {
        $this->store = $store;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.vendor.stat');
    }
}
