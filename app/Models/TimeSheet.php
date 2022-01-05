<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
  use HasFactory;

  protected $fillable = ['user_id', 'date'];

  public function timeEntries()
  {
    return $this->hasMany(TimeEntry::class);
  }
}
