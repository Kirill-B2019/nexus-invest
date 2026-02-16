<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FaqAccordion extends Component
{
    public string $accordionId;

    /**
     * @param  array<int, array{question: string, answer: string|array, open?: bool}>  $items
     */
    public function __construct(
        public array $items = [],
        ?string $accordionId = null
    ) {
        $this->accordionId = $accordionId ?? 'accordionFAQS';
    }

    public function render(): View
    {
        return view('components.faq-accordion');
    }
}
