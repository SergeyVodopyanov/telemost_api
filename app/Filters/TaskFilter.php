<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractFilter
{
    protected function title(string $value): Builder
    {
        return $this->builder->where('title', 'like', '%' . $value . '%');
    }

    protected function description(string $value): Builder
    {
        return $this->builder->where('description', 'like', '%' . $value . '%');
    }

    protected function status(string $value): Builder
    {
        return $this->builder->where('status', $value);
    }

    protected function priority(string $value): Builder
    {
        return $this->builder->where('priority', $value);
    }

    protected function due_date(array $value): Builder
    {
        return $this->builder->whereBetween('due_date', [$value['min'], $value['max']]);
    }

    protected function start_date(array $value): Builder
    {
        return $this->builder->whereBetween('start_date', [$value['min'], $value['max']]);
    }

    protected function completed_at(array $value): Builder
    {
        return $this->builder->whereBetween('completed_at', [$value['min'], $value['max']]);
    }

    protected function team_id(string $value): Builder
    {
        return $this->builder->where('team_id', $value);
    }

    protected function creator_id(string $value): Builder
    {
        return $this->builder->where('creator_id', $value);
    }

    protected function assignee_id(string $value): Builder
    {
        return $this->builder->where('assignee_id', $value);
    }
}
