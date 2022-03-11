<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\StringFormatService;

class Client extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','code','phone','address'];

    public function projects() 
    {
      return $this->hasMany(Project::class);
    }

    public function getPhoneDisplayAttribute()
    {
      return (new StringFormatService())->phoneDisplayFormat($this->phone);
    }
}
