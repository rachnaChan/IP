<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return $user = User::all();
        $users = User::with('roleUser')->get();
        return response()->json(['allUser' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            // "image" => 'required',
            "first_name" => ['required', 'string'],
            "last_name" => ['required', 'string'],
            "gender" => ['required', 'string'],
            "dob" => ['required', 'date', 'date_format:d-m-Y'],
            "phone_number" => ['required', 'string'],
            'email' => 'required|unique:users',
            'password' => ['required', 'string', 'min:8'],
            'bio' => 'required',
            'role_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('uploads', 'public');
        }

        $dob = Carbon::createFromFormat('d-m-Y', $data['dob'])->format('Y-m-d');
        // Add the converted date to the validated data array
        $data['dob'] = $dob;

        return User::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());

        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
            $user->update(['image' => $path]);
        }

        //function to update role 

        // Check if role_id is included in the request and update role ID
        if ($request->has('role_id')) {
            $roleID = $request->input('role_id');
            $user->update(['role_id' => $roleID]);
        }

        // Reload the user with updated role information
        $user->load('roleUser');

        return $user;
    }

    public function search($query)
    {   
        // return User::where("username","like","%".$name."%")->get();
        $users = User::where(function ($q) use ($query) {
            $q->where('username', 'like', "%$query%")
                ->orWhere('phone_number', '=', "$query")
                ->orwhere('id', '=', $query)
                ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$query%");
        })

        //search based on role
        ->orWhereHas('roleUser', function ($q) use ($query){
            $q->where('name','like',"%$query%");
        })
        ->with('roleUser')
        ->get();

        return response()->json($users);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return User::destroy($id);
    }
}
