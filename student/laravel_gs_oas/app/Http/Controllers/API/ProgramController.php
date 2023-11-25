<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Program::all();
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
        $path = '';
        if($request->hasFile('image')) {
            //public here is to clear laravel cache because we want path to autowrite and access publicly
            $path = $request->image->store('uploads', 'public');
        }

        return Program::create([
            'name' => $request->name,
            'description' => $request->description,
            'head_of_program_id' => $request->head_of_program_id,
            'image' => $path,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Program::find($id);
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
        $program = Program::find($id);
        $program->update($request->all());

        $path = '';
        if($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
            $program->update(['image' => $path]);
        }

        return $program;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Program::destroy($id);
    }
}
