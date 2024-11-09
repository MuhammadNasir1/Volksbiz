<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileUploader extends Component
{
    public $name;
    public $id;
    public $title;
    public $requirements;
    public function __construct($name, $id, $title, $requirements)
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->requirements = $requirements;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-uploader');
    }
}
