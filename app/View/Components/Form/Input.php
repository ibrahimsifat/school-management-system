<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name = '',
        public string $htmlFor = '',
        public string $type = 'text',
        public string $placeholder = '',
        public string $value = '',
        public string $label = '',
        public bool $required = false,
        public bool $disabled = false,
        public bool $readonly = false,
        public bool $autofocus = false,
        public bool $multiple = false,

    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
