<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->query('per_page', 15), 1), 100);

        $events = Event::query()
            ->withCount('registrations')
            ->orderBy('starts_at')
            ->paginate($perPage);

        return response()->json($events);
    }

    public function show(Event $event): JsonResponse
    {
        $event->load(['registrations.participant']);

        return response()->json($event);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'venue' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:0'],
        ]);

        $event = Event::query()->create($data);

        return response()->json($event, Response::HTTP_CREATED);
    }
}
