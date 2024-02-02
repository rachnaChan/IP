<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function get_users()
    {
        $users = User::with('roleUser')->where('role_id', 2)->get();

        return response()->json(['users' => $users], 200);
    }

    public function update_user(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $updatableFields = ['first_name', 'last_name', 'username', 'phone_number', 'bio', 'dob'];


        // Check if any data has been modified
        $isProfileModified = false;

        foreach ($updatableFields as $field) {
            if ($request->has($field) && $request->$field !== $users->$field) {
                $isProfileModified = true;
                $users->$field = $request->$field;
            }
        }

        if ($request->hasFile('image')) {
            $isProfileModified = true;
            $path = $request->file('image')->store('uploads', 'public');
            if ($users->image) {
                Storage::disk('public')->delete($users->image);
            }
            $users->image = $path;
        }

        // If no data has been modified, return a response with a message
        if (!$isProfileModified) {
            return response()->json(['message' => 'No changes were made to your profile.']);
        }

        $users->save();

        return response()->json([
            'message' => 'users information updated successfully',
            'users' => $users, // Include the updated user data
        ]);
    }

    //search user by info
    public function searchUser($query)
    {
        $users = User::where(function ($q) use ($query) {
            $q->where('first_name', 'like', "%$query%")
                ->orWhere('last_name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('username', 'like', "%$query%");
        })->get();

        return response()->json($users);
    }

    public function userDetail($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found'], 500);
        }
    }

    //delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $oldimage = $user->image;

        if ($oldimage) {
            // Check if the image path is in the public disk
            if (Storage::disk('public')->exists($oldimage)) {
                Storage::disk('public')->delete($oldimage);
            } else {
                // If the image path is in the private disk, delete it from there
                Storage::disk('private')->delete($oldimage);
            }
        }

        // Delete the book record from the database
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
