<?php

namespace App\Http\Controllers;

use App\Models\PersonnelManagement\Personnel;
use App\Models\PersonnelManagement\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function getPersonnelPublication(Request $request, $id)
    {
        $publications = Publication::where('personnel_id',$id)->get();

        return response()->json(['success' => true, "message" => 'List of Personnel Publications', 'data' => $publications]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'year_of_publication' => 'required|string',
            'authors' => 'required|string',
            'link' => 'string',
            'personnel_id' => 'required|exists:personnels,id'
        ]);

        $personnel = Personnel::find($request->personnel_id);

        $publication = $personnel->publications()->updateOrCreate(['id' => $request->pubid, 'personnel_id' => $request->personnel_id],
        ['title'=>$request->title,'year_of_publication' => $request->year_of_publication,'authors' => $request->authors, 'link' => $request->link]);

        return response()->json(['success' => true, "message" => 'Publication added Successfully', 'data' => $publication]);
    }

    public function show(Publication $publication)
    {
        return response()->json($publication);
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return true;
    }



}
