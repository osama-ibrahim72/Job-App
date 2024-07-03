<?php

namespace App\Http\Controllers\Api\Mgr\Positions;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return(
            Position::all()
        );
    }

    public function show(
        Position $position
    )
    {
        return ($position);
    }
}
