<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'authenticated' => true,
            'auth' => 'http_basic',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function logout(): JsonResponse
    {
        return response()->json([
            'message' => 'HTTP Basic Authentication does not use a server-side session or token. '
                .'Stop sending the Authorization header (or clear stored credentials in your client) to end access.',
        ]);
    }
}
