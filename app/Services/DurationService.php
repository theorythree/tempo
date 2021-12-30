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
}
