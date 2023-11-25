<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CurrentContactInfo;

//current contact infos table crud

class CurrentContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CurrentContactInfo::all();
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
        return CurrentContactInfo::create([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'province' => $request->province,
            'country' => $request->country,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CurrentContactInfo::find($id);
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
        $currentContactInfo = CurrentContactInfo::find($id);
        $currentContactInfo->update($request->all());
        return $currentContactInfo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return CurrentContactInfo::destroy($id);
    }
}