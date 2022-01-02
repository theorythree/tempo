<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TimeEntry;
use App\Models\TimeSheet;

class TimeSheetTest extends TestCase
{
  use RefreshDatabase;

  public function test_timesheet_is_created_when_time_entry_is_created()
  {
    $timeEntry = TimeEntry::factory()->create([
      'time_sheet_id' => 1,
      'duration' => '1:30'
    ]);

    $this->assertDatabaseHas('time_entries', ['duration' => 90]);

    $timeSheets = TimeSheet::all();
    $this->assertTrue(TimeSheet::all()->count() == 1);
  }

}
