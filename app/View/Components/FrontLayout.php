<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    /**
     * Create a new component instance.
     */

    public $title;
    public function __construct()
    {
        // $this->title = $title ?? config('app.name');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front');
    }
}
