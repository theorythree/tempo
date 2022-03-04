<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\TimeEntry;

class TimeEntryItem extends Component
{

  public $timeEntry;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($timeEntry)
    {
     $this->timeEntry = $timeEntry;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.time-entry-item');
    }
}
