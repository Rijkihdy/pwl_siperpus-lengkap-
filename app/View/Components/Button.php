<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $href;
    public $bgColor;

    public function __construct($href, $bgColor)
    {
        $this->href = $href;
        $this->bgColor = $bgColor;
    }

    public function render()
    {
        return view('components.button');
    }
}
