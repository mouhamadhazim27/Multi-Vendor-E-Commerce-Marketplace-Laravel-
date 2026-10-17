<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class layout2 extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public function __construct($title = 'HazimPlat Marketplace')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout2');
    }
}
