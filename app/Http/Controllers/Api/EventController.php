<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        $events = Event::where('user_id', '=', Auth::user()->id)
            ->where('startDate', '>=', $start)
            ->where('startDate', '<=', $end)
            ->get();
        $results = [];
        foreach ($events as $event) {
            $format = $event->fullDay ? 'Y-m-d' : 'c';
            $results[] = [
                "id" => $event->id,
                "title" => $event->title,
                "start" => $event->startDate()->format($format),
                "end" => $event->endDate()->format($format),
                "fullDay" => $event->fullDay,
                "recurring" => $event->recurring,
                "description" => $event->description,
            ];
        }

        return response()->json($results);
    }

    public function show(Event $event)
    {
        if($event->user_id != Auth::user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return response()->json($event);
    }
}
