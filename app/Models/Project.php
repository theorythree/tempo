<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\DurationService;
use App\Services\StringFormatService;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = ['client_id','name','description','budget'];

    // ------------------------------------------------------------------------
    // Relationships
    // ------------------------------------------------------------------------

    public function client()
    {
      return $this->belongsTo(Client::class);
    }

    public function timeEntries()
    {
      return $this->hasMany(TimeEntry::class)->orderBy('date','desc');
    }

    // ------------------------------------------------------------------------
    // Accessors and Mutators
    // ------------------------------------------------------------------------

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
      return (new StringFormatService())->currencyDisplayFormat($this->totalCost);
    }

    public function getBudgetDisplayAttribute() {
      return (new StringFormatService())->currencyDisplayFormat($this->budget);
    }
}
