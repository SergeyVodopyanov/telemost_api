<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFilter;

class Task extends Model
{
    use HasFilter;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'start_date',
        'completed_at',
        'team_id',
        'creator_id',
        'assignee_id'
    ];
}
