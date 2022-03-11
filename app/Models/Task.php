<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\StringFormatService;

class Task extends Model
{
    use HasFactory;

    public function timeEntry()
    {
      return $this->hasOne(TimeEntry::class);
    }

    public function getDisplayRateAttribute()
    {
      return (new StringFormatService())->currencyDisplayFormat($this->rate);
    }
 }
