<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;

class OrganizationController extends Controller
{
    public function __construct(private OrganizationService $service) {}

    public function index(\App\Http\Requests\Organization\IndexRequest  $request): JsonResponse
    {
        $collection = $this->service->findBy($request->limit ?? 15);

        if ($collection->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()
            ->json(array_merge(
                [
                    'data' => OrganizationResource::collection($collection)
                ],
                $this->formatMetaData($collection)
            ), Response::HTTP_OK);
    }

    public function show(string $id): JsonResponse
    {
        $data = $this->service->findById((int) $id);

        return response()->json(
            new OrganizationResource($data),
            Response::HTTP_OK
        );
    }

    public function store(\App\Http\Requests\Organization\StoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->create(array_merge(
                $request->validated(),
                ['user_id' => auth('sanctum')->id()]
            )),
            Response::HTTP_CREATED
        );
    }

    public function update(\App\Http\Requests\Organization\UpdateRequest $request, string $id): JsonResponse
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
