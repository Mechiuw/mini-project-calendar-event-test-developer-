<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Events; // Import the Event model

class FullCalenderController extends Controller {
    /**
     * Display the calendar view.
     *
     * @return \Illuminate\View\View
     */
    public function index(EventRequest $request)
    {
        if ($request->ajax()) {
            $data = Events::whereDate('start', '>=', $request->start)
                       ->whereDate('end', '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('fullcalendar');
    }

    /**
     * Handle AJAX requests for calendar events.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(EventRequest $request)
    {
        switch ($request->type) {
            case 'add':
                $event = Events::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);
                break;

            case 'update':
                $event = Events::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);
                break;

            case 'delete':
                $event = Events::find($request->id)->delete();
                return response()->json($event);
                break;

            default:
                return response()->json(['error' => 'Invalid action']);
                break;
        }
    }
}
