<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class CRUDProgramController extends Controller
{
    //add program
    public function addProgram(Request $request)
    {

        $path = '';
        if ($request->hasFile('image')) {
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

    //get program
    public function showPrograms()
    {
        $programs = Program::all();
        return response()->json($programs);
    }


    //delete program
    public function deleteProgram($id)
    {
        return Program::destroy($id);
    }

    //delete program
    public function updateProgram(Request $request, string $id)
    {
        $program = Program::find($id);
        $program->update($request->all());

        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
            $program->update(['image' => $path]);
        }

        return $program;
    }
}
