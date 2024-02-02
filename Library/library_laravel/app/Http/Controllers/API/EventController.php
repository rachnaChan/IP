<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function create_event(Request $request)
    {

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string',
            'desription' => 'nullable|string',
            'start_date' => 'nullable|date',
            'description' => 'nullable|string',
            'end_date' => 'nullable|date',
        ]);

        try {

            // Create a new Event instance
            $events = new Events();
            $events->title = $request->input('title');
            $events->start_date = $request->input('start_date');
            $events->end_date = $request->input('end_date');
            $events->description = $request->input('description');
            $events->user_event_id = auth()->id();

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('uploads', $imageName, 'public');
                $events->image = $imagePath;
            }

            // Save the events details to the database
            $events->save();

            return response()->json([
                'message' => 'Event uploaded successfully',
                'events' => $events,
            ], 200);
        } catch (\Exception $e) {
            // Handle exceptions and return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function get_events()
    {
        $events = Events::where('user_event_id', auth()->id())->get();
        return response()->json($events);
    }

    public function get_events_pub()
    {
        try {
            $events = Events::with('UserEvent')->get();

            return response()->json($events);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve events'], 500);
        }
    }

    public function update_event(Request $request, $id)
    {
        $event = Events::findOrFail($id);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $path = $event->image;

        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'image' => $path,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return $event;
    }

    public function delete_event($id)
    {
        $events = Events::findOrFail($id);
        $oldimage = $events->image;

        if ($oldimage) {
            // Check if the image path is in the public disk
            if (Storage::disk('public')->exists($oldimage)) {
                Storage::disk('public')->delete($oldimage);
            } else {
                // If the image path is in the private disk, delete it from there
                Storage::disk('private')->delete($oldimage);
            }
        }

        // Delete the events record from the database
        $events->delete();

        return response()->json(['message' => 'Events deleted successfully']);
    }

    //search book by author isbn categories
    public function searchEvent($query)
    {
        $books = Events::where(function ($q) use ($query) {
            $q->where('title', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%")
                ->orWhere('end_date', 'like', "%$query%")
                ->orWhere('start_date', 'like', "%$query%");
        })->get();

        return response()->json($books);
    }
}
