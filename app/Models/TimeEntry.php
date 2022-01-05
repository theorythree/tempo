<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\DurationService;

class TimeEntry extends Model
{
  use HasFactory;

  protected $fillable = ['invoice_id','project_id','time_sheet_id','user_id','date','duration','invoiced'];
  
  public function timeSheet() {
    return $this->belongsTo(TimeSheet::class);
  }
  
  public function setDurationAttribute($value)
  {
    $this->attributes['duration'] = (new DurationService())->convertToMinutes($value);
  }
}
