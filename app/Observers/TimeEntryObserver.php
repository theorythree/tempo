<?php

namespace App\Observers;

use App\Models\TimeEntry;
use App\Models\TimeSheet;

class TimeEntryObserver
{

  public function creating(TimeEntry $timeEntry) 
  {  
    if (!$timeEntry->timeSheet()->exists()) {
      $timeSheet = new TimeSheet();
      $timeSheet->date = Date("Y-m-d");
      $timeSheet->user_id = $timeEntry->user_id;
      $timeSheet->save();

      $this->time_sheet_id = $timeSheet->id;
    }
  }

  public function deleted(TimeEntry $timeEntry)
  {
    if ($timeEntry->timeSheet->timeEntries()->count() == 0) {
      $timeEntry->timeSheet->delete();
    }
  }

}
