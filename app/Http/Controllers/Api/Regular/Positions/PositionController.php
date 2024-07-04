<?php

namespace App\Http\Controllers\Api\Regular\Positions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Regular\Positions\StorePositionRequest;
use App\Http\Requests\Api\Regular\Positions\UpdatePositionRequest;
use App\Http\Resources\Position\PositionResource;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PositionController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PositionResource::collection(
            Auth::user()->positions()->get()
        )->additional([
            'message' => __('Positions retrieved successfully'),
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * @param Position $position
     * @return PositionResource
     */
    public function show(
        Position $position
    )
    {
        return PositionResource::make(
            $position
        )->additional([
            'message' => __('Position retrieved successfully'),
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * @param StorePositionRequest $request
     * @return PositionResource
     */
    public function store(
        StorePositionRequest $request
    )
    {
        return PositionResource::make(
            Auth::user()->positions()->create($request->validated())
        )->additional([
            'message' => __('Position created successfully'),
            'status' => Response::HTTP_CREATED
        ]);
    }

    /**
     * @param UpdatePositionRequest $request
     * @param Position $position
     * @return PositionResource
     */
    public function update(
        UpdatePositionRequest $request,
        Position $position
    )
    {
        return PositionResource::make(
        $position->update($request->validated())
        );
    }

    /**
     * @param Position $position
     * @return JsonResponse
     */
    public function destroy(
        Position $position
    )
    {
        if($position->delete())
        {
            return response()->json([
                'message' => __("Position deleted successfully."),
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => __("We couldn't delete the Position"),
            'status' => Response::HTTP_BAD_REQUEST
        ], Response::HTTP_BAD_REQUEST);
    }
}
