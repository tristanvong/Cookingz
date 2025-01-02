<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SuccessMessage extends Component
{
    public $message;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->message = session('success');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.success-message');
    }
}
