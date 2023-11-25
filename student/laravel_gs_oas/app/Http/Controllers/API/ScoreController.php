<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\ApplicantDetail;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Score::all();
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
        return Score::create([
            'transcript' => $request->transcript, 
            'language' => $request->language,
            'motivation_letter' => $request->motivation_letter,
            'recommendation_letter' => $request->recommendation_letter,
            'cv' => $request->cv,
            'related_experience' => $request->related_experience,
            'educational_background' =>$request->educational_background,
            'applicant_id' => $request->applicant_id,
            'head_of_program_id' => $request->head_of_program_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Score::find($id);
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
        $score = Score::find($id);
        $score->update($request->all());
        return $score;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Score::destroy($id);
    }

    public function score(string $id)
    {
        return Score::where('applicant_id', $id)->first();
    }
}
