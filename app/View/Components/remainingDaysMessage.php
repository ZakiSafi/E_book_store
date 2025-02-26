<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class remainingDaysMessage extends Component
{
    public $dueDate;
    public $daysRemaining;

    /**
     * Create a new component instance.
     *
     * @param string $dueDate
     */
    public function __construct($dueDate)
    {
        $this->dueDate = Carbon::parse($dueDate);
        $this->daysRemaining = Carbon::now()->diffInDays($this->dueDate, false);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.remaining-days-message');
    }
}
