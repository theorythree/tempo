<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\DurationService;
use App\Services\StringFormatService;

class TimeEntry extends Model
{
  use HasFactory;

  protected $fillable = ['invoice_id','project_id','task_id','user_id','date','duration','invoiced'];
  protected $casts = ['date' => 'date'];
  
  public function project() {
    return $this->belongsTo(Project::class);
  }
  
  public function task() {
    return $this->belongsTo(Task::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }
  
  public function setDurationAttribute($value)
  {
    $this->attributes['duration'] = (new DurationService())->convertToMinutes($value);
  }

  public function getDisplayDurationAttribute()
  {
    return (new DurationService())->convertToDisplay($this->duration);
  }

  public function getTotalAttribute()
  {
    return round(($this->task->rate) * ($this->duration / 60),2);
  }

  public function getTotalDisplayAttribute()
  {
    return (new StringFormatService())->currencyDisplayFormat($this->total);
  }
}
