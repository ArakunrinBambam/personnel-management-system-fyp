<?php

namespace App\Http\Controllers;

use App\Models\PersonnelManagement\EmploymentHistory;
use App\Models\PersonnelManagement\Personnel;
use Illuminate\Http\Request;

class EmploymentHistoryController extends Controller
{

    public function getPersonnelEmploymentHistory(Request $request, $id)
    {
        $mhistories = EmploymentHistory::where('personnel_id',$id)->get();

        return response()->json(['success' => true, "message" => 'List of Personnel Employment History', 'data' => $mhistories]);
    }
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
            'employer' => 'required|string',
            'employer_address' => 'required|string',
            'designation' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'personnel_id' => 'required|exists:personnels,id'
        ]);

        $personnel = Personnel::find($request->personnel_id);

        $mhistory = $personnel->employmentHistory()->updateOrCreate(['id' => $request->mhid, 'personnel_id' => $request->personnel_id],
        ['employer'=>$request->employer,'employer_address' => $request->employer_address,'designation' => $request->designation, 'start_date' => $request->start_date, "end_date" => $request->end_date]);

        return response()->json(['success' => true, "message" => 'Employment History added Successfully', 'data' => $mhistory]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\EmploymentHistory  $employmentHistory
     * @return \Illuminate\Http\Response
     */
    public function show(EmploymentHistory $employmentHistory)
    {
        return response()->json($employmentHistory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\EmploymentHistory  $employmentHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(EmploymentHistory $employmentHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonnelManagement\EmploymentHistory  $employmentHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmploymentHistory $employmentHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonnelManagement\EmploymentHistory  $employmentHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmploymentHistory $employmentHistory)
    {
        $employmentHistory->delete();

        return true;
    }
}
