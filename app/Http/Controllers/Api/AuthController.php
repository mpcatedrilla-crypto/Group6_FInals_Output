<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /** Who am I? (proves Basic Auth succeeded — `users.email` + password matched.) */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'authenticated' => true,
            'scheme' => 'HTTP Basic',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * There is no server “logout” for Basic Auth — explain this during the demo.
     * The client simply stops sending the Authorization header.
     */
    public function logout(): JsonResponse
    {
        return response()->json([
            'message' => 'No session to destroy. Basic Auth sends credentials on each request; remove the Authorization header in your client to stop.',
        ]);
    }
}
