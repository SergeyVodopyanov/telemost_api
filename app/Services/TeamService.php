<?php

namespace App\Services;

class TeamService extends AbstractModelService
{
    protected static function getModelClass(): string
    {
        return \App\Models\Team::class;
    }

    protected static function getFilterClass(): string
    {
        return \App\Filters\TeamFilter::class;
    }

    protected function afterCreate($Team, $params): void {}
}
