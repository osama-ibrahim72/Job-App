<?php

namespace App\Http\Controllers\Api\Mgr\Positions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Position\PositionResource;
use App\Models\Position;
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
            Position::all()
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
}
