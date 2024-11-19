<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEnglandPlace extends Model
{
    use HasFactory;
    protected $fillable = [
        'new_england_state_id',
        'address',
        'lat',
        'lng',
        'project_name',
        'project_type',
        'description',
        'year',
        'contact',
        'project_link',
        'project_target',
        'city',
        'receipient_name',
        'project_target',
        'facebook_link',
        'youtube_link',

    ];


    public function NewEnglandStates()
    {
        return $this->belongsTo(NewEnglandState::class,'new_england_state_id');
    }
}
