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

    public function getTotalAttribute()
    {
      $total = 0;
      if($this->timeEntries()->count() > 0) {
        foreach ($this->timeEntries as $timeEntry) {
          $total += $timeEntry->duration;
        }
      }

      return (new DurationService())->convertToDisplay($total);

    }
}
