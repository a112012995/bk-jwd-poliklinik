<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBar extends Component
{
    /**
     * The type of the navbar.
     */
    public string $type;

    /**
     * Create a new component instance.
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }
}
