<?php

namespace App\Http\Controllers\Api\Regular\Positions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Regular\Positions\StorePositionRequest;
use App\Http\Requests\Api\Regular\Positions\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{
    public function index()
    {
        return(
        Auth::user()->positions()->get()
        );
    }

    public function show(
        Position $position
    )
    {
        return ($position);
    }
    public function store(
        StorePositionRequest $request
    )
    {
        return(
            Auth::user()->positons()->create($request->validated())
        );
    }
    public function update(
        UpdatePositionRequest $request,
        Position $position
    )
    {
        return(
        $position->update($request->validated())
        );
    }
    public function destroy(
        StorePositionRequest $request,
        Position $position
    )
    {
        $position->delete();
        return('deleted successfully');
    }
}
