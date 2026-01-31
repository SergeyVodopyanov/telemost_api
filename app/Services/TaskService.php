<?php

namespace App\Services;

class TaskService extends AbstractModelService
{
    protected static function getModelClass(): string
    {
        return \App\Models\Task::class;
    }

    protected static function getFilterClass(): string
    {
        return \App\Filters\TaskFilter::class;
    }

    protected static function prepareParams(array &$params): void
    {
        $params["creator_id"] = auth('sanctum')->id();
    }


    protected function afterCreate($organization, $params): void {}
}
