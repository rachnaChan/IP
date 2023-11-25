<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormalPersonalInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormalPersonalInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FormalPersonalInfo::all();
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
        $data = [
            'type_of_degree' => $request->type_of_degree,
            'study_pathway' => $request->study_pathway,
            'image' => $request->image,
            "family_name" => $request->family_name,
            "given_name" => $request->given_name,
            "gender" => $request->gender,
            "marital_status" => $request->marital_status,
            "place_of_birth" => $request->place_of_birth,
            "country_of_birth" => $request->country_of_birth,
            "nationality" => $request->nationality,
            "registration_level" => $request->registration_level,
            'khmer_name' => $request->khmer_name,
        ];

        if($request->dob !== null && $request->dob !== 'null') {
            $data["dob"] = Carbon::parse($request->dob)->format('Y-m-d');
        }

        return FormalPersonalInfo::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return FormalPersonalInfo::find($id);
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
        $formalPersonalInfo = FormalPersonalInfo::find($id);
        
        if($request->dob !== null && $request->dob !== 'null') {
            $formalPersonalInfo['dob'] = Carbon::parse($request->dob)->format('Y-m-d');
            $formalPersonalInfo->update($request->all());
        } else {
            $formalPersonalInfo['dob'] = null;
            $formalPersonalInfo->update($request->except('dob'));
        }

        return $formalPersonalInfo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return FormalPersonalInfo::destroy($id);
    }
}
