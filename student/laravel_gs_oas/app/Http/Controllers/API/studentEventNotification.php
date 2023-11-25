<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EventInfo;
use Illuminate\Http\Request;

class studentEventNotification extends Controller
{
    public function store(Request $request)
    {
        $path = '';
        if ($request->hasFile('image')) {
            //public here is to clear laravel cache because we want path to autowrite and access publicly
            $path = $request->image->store('uploads', 'public');
        }

        return EventInfo::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'image' => $path,
            'deadline' => $request->deadline
        ]);
    }

    public function index()
    {
        return EventInfo::all();
    }
    public function destroy($id)
    {
        $event = EventInfo::findOrFail($id);

        // Delete the event
        $event->delete();

        // You can return a success message or response here if needed
        return response()->json(['message' => 'Event deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $event = EventInfo::findOrFail($id);

        $path = $event->image; // Keep the existing image path if not updated

        if ($request->hasFile('image')) {
            // Update the image if a new one is provided
            $path = $request->image->store('uploads', 'public');
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'image' => $path,
            'deadline' => $request->deadline
        ]);

        return $event;
    }
}
