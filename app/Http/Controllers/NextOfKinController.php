<?php

namespace App\Http\Controllers;

use App\Models\PersonnelManagement\NextOfKin;
use Illuminate\Http\Request;

class NextOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required|string',
            'othernames' => 'required|string',
            'relationship' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'personnel_id' => 'required|exists:personnels,id'
        ]);

        $nok = NextOfKin::updateOrCreate(['id' => $request->id, 'personnel_id' => $request->personnel_id],
        ['surname'=>$request->surname,'othernames' => $request->othernames,'relationship' => $request->relationship, 'phone' => $request->phone, 'address' => $request->address]);

        return response()->json(['success' => true, "message" => 'Next of Kin added Successfully', 'data' => $nok]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function show(NextOfKin $nextOfKin)
    {
        return response()->json($nextOfKin);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function edit(NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonnelManagement\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonnelManagement\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function destroy(NextOfKin $nextOfKin)
    {
        //
    }
}
