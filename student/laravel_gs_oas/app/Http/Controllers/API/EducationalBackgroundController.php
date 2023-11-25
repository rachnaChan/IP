<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationalBackground;

class EducationalBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EducationalBackground::all();
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
        return EducationalBackground::create([
            'itc_graduate_year' => $request->itc_graduate_year, //need to change the database 
            'major' => $request->major,
            'high_school_grade' => $request->high_school_grade,
            'high_school_year' => $request->high_school_year,
            'high_school_name' => $request->high_school_name,
            'high_school_province' => $request->high_school_province,
            'high_school_country' => $request->high_school_country,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return EducationalBackground::find($id);
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
        $educationalBackground = EducationalBackground::find($id);
        $educationalBackground->update($request->all());
        return $educationalBackground;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return EducationalBackground::destroy($id);
    }
}