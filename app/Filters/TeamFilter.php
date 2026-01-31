<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TeamFilter extends AbstractFilter
{
    protected function title(string $value): Builder
    {
        return $this->builder->where('title', 'like', '%' . $value . '%');
    }

    protected function description(string $value): Builder
    {
        return $this->builder->where('description', 'like', '%' . $value . '%');
    }
}
