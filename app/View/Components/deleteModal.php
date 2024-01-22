<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class deleteModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $props = ['href'];
    public function __construct(
        public string $href
    ) {

        $this->props = [
            'href' => $href,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-modal');
    }
}