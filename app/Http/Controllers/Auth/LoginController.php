<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::query()
            ->where('email', $request->get('email'))
            ->firstOr(function (){
                abort($this->failResponse("wrong email or password"));
            });

        if (Hash::check($request->get('password'), $user->password)) {
            return $this->successResponse([
                'token' => $user->createToken("PAT")->plainTextToken
            ]);
        }else {
            return $this->failResponse("wrong email or password");
        }
    }
}