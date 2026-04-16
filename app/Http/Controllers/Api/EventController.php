<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /** List events (protected — requires Basic Auth on every request). */
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->query('per_page', 15), 1), 100);

        $events = Event::query()
            ->withCount('registrations')
            ->orderBy('starts_at')
            ->paginate($perPage);

        return response()->json($events);
    }

    /** Single event with registrations and each participant (Eloquent relationships). */
    public function show(Event $event): JsonResponse
    {
        $event->load(['registrations.participant']);

        return response()->json($event);
    }
}
