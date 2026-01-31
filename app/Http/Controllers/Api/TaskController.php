<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(private TaskService $service) {}

    public function index(\App\Http\Requests\Task\IndexRequest  $request): JsonResponse
    {
        $collection = $this->service->findBy($request->limit ?? 15);

        if ($collection->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()
            ->json(array_merge(
                [
                    'data' => TaskResource::collection($collection)
                ],
                $this->formatMetaData($collection)
            ), Response::HTTP_OK);
    }

    public function show(string $id): JsonResponse
    {
        $data = $this->service->findById((int) $id);

        return response()->json(
            new TaskResource($data),
            Response::HTTP_OK
        );
    }

    public function store(\App\Http\Requests\Task\StoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->create($request->validated()),
            Response::HTTP_CREATED
        );
    }

    public function update(\App\Http\Requests\Task\UpdateRequest $request, string $id): JsonResponse
    {
        return response()->json(
            $this->service->update((int) $id, $request->validated()),
            Response::HTTP_OK
        );
    }

    public function destroy(string $id): JsonResponse
    {
        return response()->json(
            $this->service->destroy((int) $id),
            Response::HTTP_OK
        );
    }
}
