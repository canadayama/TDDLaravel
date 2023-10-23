<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 */
class Author extends Model
{
    use HasFactory;

    protected $guarded = [];

    //protected $dates = ['dob'];

    // /**
    //  * Old 8.X
    //  */
    // public function setDobAttribute($dob)
    // {
    //     $this->attributes['dob'] = Carbon::parse($dob);
    // }

    protected function dob(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value),
        );
    }
}
