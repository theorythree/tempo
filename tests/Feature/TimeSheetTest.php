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

    $this->assertTrue(TimeSheet::all()->count() == 1);
  }

  public function test_timesheet_is_not_created_when_second_time_entry_is_created()
  {
    $timeEntry = TimeEntry::factory(2)->create([
      'time_sheet_id' => 1,
      'duration' => '1:30'
    ]);

    $this->assertTrue(TimeSheet::all()->count() == 1);
  }

  public function test_timesheet_is_deleted_when_last_time_entry_is_deleted()
  {
    $timeEntry = TimeEntry::factory()->create([
      'time_sheet_id' => 1,
      'duration' => '1:30'
    ]);

    $this->assertTrue(TimeSheet::all()->count() == 1);

    $timeEntry->delete();

    $this->assertTrue(TimeSheet::all()->count() == 0);
  }

  public function test_timesheet_is_not_deleted_when_stil_contains_a_time_entry()
  {
    $timeEntries = TimeEntry::factory(2)->create([
      'time_sheet_id' => 1,
      'duration' => '1:30'
    ]);

    $this->assertTrue(TimeSheet::all()->count() == 1);

    $timeEntries->first()->delete();

    $this->assertTrue(TimeSheet::all()->count() == 1);
  }

}
