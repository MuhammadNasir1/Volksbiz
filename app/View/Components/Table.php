<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{

    public $headers;
    public function __construct($headers)
    {

        $this->headers = $headers;
    }

    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
