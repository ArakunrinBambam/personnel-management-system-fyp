<?php

namespace App\Http\Controllers;

use App\Models\PersonnelManagement\EducationHistory;
use App\Models\PersonnelManagement\Personnel;
use Illuminate\Http\Request;

class EducationHistoryController extends Controller
{

    public function getPersonnelEducationHistory(Request $request, $id)
    {
        $ehistories = EducationHistory::where('personnel_id',$id)->orderBy('year', "DESC")->get();

        return response()->json(['success' => true, "message" => 'List of Personnel Education History', 'data' => $ehistories]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            'school_name' => 'required|string',
            'qualification_obtained' => 'required|string',
            'year' => 'required|numeric',
            'personnel_id' => 'required|exists:personnels,id'
        ]);

        $personnel = Personnel::find($request->personnel_id);

        $ehistory = $personnel->educationHistory()->updateOrCreate(['id' => $request->ehid, 'personnel_id' => $request->personnel_id],
        ['school_name'=>$request->school_name,'qualification_obtained' => $request->qualification_obtained,'year' => $request->year]);

        return response()->json(['success' => true, "message" => 'Education History added Successfully', 'data' => $ehistory]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\EducationHistory  $educationHistory
     * @return \Illuminate\Http\Response
     */
    public function show(EducationHistory $educationHistory)
    {
        return response()->json($educationHistory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\EducationHistory  $educationHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationHistory $educationHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonnelManagement\EducationHistory  $educationHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationHistory $educationHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonnelManagement\EducationHistory  $educationHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationHistory $educationHistory)
    {
        $educationHistory->delete();

        return true;
    }
}
