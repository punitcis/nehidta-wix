<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEnglandState extends Model
{
    use HasFactory;
    protected $fillable = ['state', 'file_path'];

    public function NewEnglandPlaces()
    {
        return $this->hasMany(NewEnglandPlace::class);
    }
}
