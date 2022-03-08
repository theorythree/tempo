<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\DurationService;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = ['client_id','name','description','budget'];

    public function client()
    {
      return $this->belongsTo(Client::class);
    }

    public function timeEntries()
    {
      return $this->hasMany(TimeEntry::class)->orderBy('date','desc');
    }

    public function getTotalTimeAttribute()
    {
      $total = 0;
      
      if($this->timeEntries()->count() > 0) {
        foreach ($this->timeEntries as $timeEntry) {
          $total += $timeEntry->duration;
        }
      }

      return (new DurationService())->convertToDisplay($total);

    }

    public function getTotalCostAttribute()
    {
      $total = 0;
      
      if($this->timeEntries()->count() > 0) {
        foreach ($this->timeEntries as $timeEntry) {
          $total += round(($timeEntry->task->rate) * (($timeEntry->duration / 60) + ($this->duration % 60)),2);
        }
      }

     return $total;
    }

    public function getTotalCostDisplayAttribute() {
      return number_format($this->totalCost, 2, '.', ',');
    }
}
