<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\DurationService;

class DurationServiceTest extends TestCase
{
  //use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
    $this->durationService = new DurationService();
  }

  public function test_storage_converts_to_minutes_correctly()
  {
    $value = "1:30";
    $this->assertTrue($this->durationService->convertToMinutes($value) == 90);

    $value = "0:32";
    $this->assertTrue($this->durationService->convertToMinutes($value) == 32);

    $value = "0:03";
    $this->assertTrue($this->durationService->convertToMinutes($value) == 3);

    $value = ":03";
    $this->assertTrue($this->durationService->convertToMinutes($value) == 3);

    $value = "1:";
    $this->assertTrue($this->durationService->convertToMinutes($value) == 60);
  }

  public function test_minutes_convert_to_display_correctly()
  {
    $value = "1";
    $this->assertTrue($this->durationService->convertToDisplay($value) == '0:01');

    $value = "10";
    $this->assertTrue($this->durationService->convertToDisplay($value) == '0:10');

    $value = "15";
    $this->assertTrue($this->durationService->convertToDisplay($value) == '0:15');

    $value = "61";
    $this->assertTrue($this->durationService->convertToDisplay($value) == '1:01');

    $value = "89";
    $this->assertTrue($this->durationService->convertToDisplay($value) == '1:29');

    $value = "149";
    $this->assertTrue($this->durationService->convertToDisplay($value) == '2:29');

  }
}
