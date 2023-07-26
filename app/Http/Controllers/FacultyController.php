<?php

namespace App\Http\Controllers;

use App\Models\Configuration\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FacultyController extends Controller
{

    public function getDepartments($facultyId)
    {
        $faculty = Faculty::find($facultyId);

        $departments = $faculty->departments()->get();
        return response($departments);

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faculty::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        //    $btn = '<button class="btn btn-sm btn-warning" click="editF('.$row['id'].')" type="button" data-toggle="modal" data-target="#facultyModal"><i class="mdi mdi-table-edit"></i>Edit</button>&nbsp;<a class="btn btn-sm btn-danger" href="/faculty/'.$row['id'].'/delete"><i class="mdi mdi mdi-delete"></i>Delete</a></td></tr>';
                           $btn = '<button class="btn btn-sm btn-warning" click="editF('.$row['id'].')" type="button" data-toggle="modal" data-target="#facultyModal"><i class="mdi mdi-table-edit"></i>Edit</button>&nbsp;<a class="btn btn-sm btn-danger" click="delF('.$row['id'].')"><i class="mdi mdi mdi-delete"></i>Delete</a></td></tr>';


                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('configuration.faculties');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:faculties'
        ]);


        $faculty = Faculty::updateOrCreate(['id'=> $request->fid],['name' => $request->name]);

        return response()->json(['success' => true, "message" => 'Faculty Added Successfully', 'data' => $faculty]);
    }


    public function show(Faculty $faculty)
    {
        return response()->json($faculty);
    }


    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return true;
    }


}
