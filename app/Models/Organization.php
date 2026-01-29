<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFilter;

class Organization extends Model
{
    use HasFilter;

    protected $fillable = [
        'title',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
