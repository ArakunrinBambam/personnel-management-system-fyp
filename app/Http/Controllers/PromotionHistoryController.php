<?php

namespace App\Http\Controllers;

use App\Models\PersonnelManagement\Personnel;
use App\Models\PersonnelManagement\PromotionHistory;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PromotionHistoryController extends Controller
{

    public function getPersonnelPromotionHistory(Request $request, $id)
    {
        $phistories = PromotionHistory::where('personnel_id',$id)->get();

        return response()->json(['success' => true, "message" => 'List of Personnel Promotion History', 'data' => $phistories]);
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
            'previous_designation' => 'required|string',
            'new_designation' => 'required|string|different:previous_designation',
            'date' => 'required|date|date_format:Y-m-d',
            'effective_date' => 'required|date|date_format:Y-m-d',
            'personnel_id' => 'required|exists:personnels,id'
        ]);

        $personnel = Personnel::find($request->personnel_id);

        $phistory = $personnel->promotionHistory()->updateOrCreate(['id' => $request->phid, 'personnel_id' => $request->personnel_id],
        ['previous_designation'=>$request->previous_designation,'new_designation' => $request->new_designation,'date' => $request->date, 'effective_date' => $request->effective_date, "user_id" => Auth::user()->id]);

        return response()->json(['success' => true, "message" => 'Promotion History added Successfully', 'data' => $phistory]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\PromotionHistory  $promotionHistory
     * @return \Illuminate\Http\Response
     */
    public function show(PromotionHistory $promotionHistory)
    {
        return response()->json($promotionHistory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\PromotionHistory  $promotionHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(PromotionHistory $promotionHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonnelManagement\PromotionHistory  $promotionHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromotionHistory $promotionHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonnelManagement\PromotionHistory  $promotionHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromotionHistory $promotionHistory)
    {
        $promotionHistory->delete();

        return true;
    }

    public function promotion()
    {
        return view('personnel.promotion');
    }

    public function savePromotion(Request $request)
    {
        $request->validate([
            'staffno' => 'required',
            // 'previous_designation' => ['required','string',
            //     Rule::unique('promotion_histories')->where(fn (Builder $query) => $query->where('personnel_id', $request->personnel_id)),
            // ],
            'previous_designation' => 'required|string',
            'new_designation' => 'required|string|different:previous_designation',
            'date' => 'required|date|date_format:Y-m-d',
            'effective_date' => 'required|date|date_format:Y-m-d|after_or_equal:date',
            'personnel_id' => 'required|exists:personnels,id'
        ]);


        $data = $request->all();

        //call service that create the promotion letter

        // fire event to send email to the personnel


        $data['user_id'] = Auth::user()->id;
        $promotionHistory = PromotionHistory::create($data);

        $personnel = Personnel::find($request->personnel_id);

        $personnel->designation = $request->new_designation;
        $personnel->save();

        return redirect()->back()->with('success', "Promotion Successful");

    }
}
