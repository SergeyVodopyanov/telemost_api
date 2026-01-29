<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrganizationFilter extends AbstractFilter
{
    /**
     * Фильтрация по названию
     *
     * @param string $value
     * @return Builder
     */
    protected function title(string $value): Builder
    {
        return $this->builder->where('title', 'like', '%' . $value . '%');
    }
}
