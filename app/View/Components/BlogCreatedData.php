<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogCreatedData extends Component
{
    public $blog;

    public function __construct($blog)
    {
        $this->blog = $blog;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.blog-created-data');
    }
}
