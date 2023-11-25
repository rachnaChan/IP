<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecondaryContactInfo;

class SecondaryContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SecondaryContactInfo::all();
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
        return SecondaryContactInfo::create([
            'contact_person_name' => $request->contact_person_name,
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
        return SecondaryContactInfo::find($id);
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
        $secondaryContactInfo = SecondaryContactInfo::find($id);
        $secondaryContactInfo->update($request->all());
        return $secondaryContactInfo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return SecondaryContactInfo::destroy($id);
    }
}