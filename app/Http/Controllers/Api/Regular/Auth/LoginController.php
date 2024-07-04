<?php

namespace App\Http\Controllers\Api\Regular\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Regular\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        LoginRequest $request
    )
    {
        $user = User::where('email',$request->email)->whereHas('contexts', function($query){
                $query->where('name','regular');
            })->first();
        if($user && Hash::check($request->password , $user->password)){
            $token = $user->createToken($user->id)->plainTextToken;
            return response()->json([
                'token'=>$token,
                'message' => __("Loged in Successfully"),
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => __("wrong password Or username"),
            'status' => Response::HTTP_BAD_REQUEST
        ], Response::HTTP_BAD_REQUEST);
    }
}
