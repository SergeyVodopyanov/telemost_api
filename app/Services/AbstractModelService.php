<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractModelService
{
    protected Model $model;
    protected $filter;

    public function __construct()
    {
        $this->model = app(static::getModelClass());
        $this->filter = app(static::getFilterClass());
    }

    abstract protected static function getModelClass(): string;

    abstract protected static function getFilterClass(): string;

    public function findBy(int $limit): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->applyFilter()->paginate($limit);
    }

    public function findById(int $id): Collection|Model
    {
        return $this->model->findOrFail($id);
    }

    protected static function prepareParams(array &$params): void {}

    public function create(array $params): Model
    {
        return DB::transaction(function () use ($params) {
            static::prepareParams($params);

            $createdModel = $this->performCreate($params);

            $this->afterCreate($createdModel, $params);

            return $createdModel;
        });
    }

    protected function performCreate(array $params): Model
    {
        return $this->model->create($params);
    }

    protected function afterCreate($model,  $params): void {}

    public function update(int $id, array $params): Model
    {
        return DB::transaction(function () use ($id, $params) {
            $model = $this->findById($id);

            static::prepareParams($params);
            $model->update($params);

            return $model;
        });
    }

    public function destroy(int $id): bool
    {
        return $this->model->destroy($id);
    }

    protected function applyFilter(): Builder
    {
        return $this->model->filter($this->filter);
    }
}
