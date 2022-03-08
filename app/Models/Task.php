<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function timeEntry()
    {
      return $this->hasOne(TimeEntry::class);
    }

    public function getDisplayRateAttribute()
    {
      return number_format($this->rate, 2, '.', ',');
    }
 }
