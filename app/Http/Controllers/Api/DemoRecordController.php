<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DemoRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DemoRecordController extends Controller
{
    /**
     * Example protected resource: paginated rows tied to the authenticated user (Basic Auth).
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->query('per_page', 15), 1), 100);

        $records = DemoRecord::query()
            ->where('user_id', $request->user()->id)
            ->orderBy('id')
            ->paginate($perPage);

        return response()->json($records);
    }
}
