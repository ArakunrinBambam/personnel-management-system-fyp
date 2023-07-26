<?php

namespace App\Http\Controllers;

use App\Models\Configuration\LGA;
use Illuminate\Http\Request;

class LGAController extends Controller
{

    public function getLocalGovernmentsByStateId(Request $request, $id)
    {
        $lgas = LGA::where('state_id',$id)->orderBy('name', 'ASC')->get();

        return response()->json($lgas);

    }
}
