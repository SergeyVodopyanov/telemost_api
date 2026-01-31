<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFilter;

class Team extends Model
{
    use HasFilter;

    protected $fillable = [
        'title',
        'description',
        'organization_id'
    ];
}
