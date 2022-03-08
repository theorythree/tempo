<?php

namespace App\Services;

class DurationService
{
  public function convertToMinutes($value)
  {
    $duration = $value;

    if (str_contains((String) $value, ':')) {
      $durationParts = explode(":",$value);
      $duration = ($durationParts[0] * 60) + $durationParts[1];
    }

    if (str_contains((String) $value, '.')) {
      $duration = ($value * 60);
    }
    return $duration;
  }

  public function convertToDisplay($value) 
  {
    $hours = floor($value / 60);
    $mins = $value % 60;
    $mins = strlen($mins) <= 1 ? '0'.$mins : $mins;
    return $hours.':'.$mins;
  }
}
