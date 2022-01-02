<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\DurationService;

class TimeEntry extends Model
{
  use HasFactory;
    
  public function setDurationAttribute($value)
  {
    $this->attributes['duration'] = (new DurationService())->convertToMinutes($value);
  }
}
