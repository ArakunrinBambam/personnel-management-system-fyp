<?php

namespace App\Http\Controllers;

use App\Models\Configuration\Department;
use App\Models\Configuration\Faculty;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $faculties = Faculty::all();
        if ($request->ajax()) {
            $data = Department::with('faculty');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        //    $btn = '<button class="btn btn-sm btn-warning" click="editF('.$row['id'].')" type="button" data-toggle="modal" data-target="#facultyModal"><i class="mdi mdi-table-edit"></i>Edit</button>&nbsp;<a class="btn btn-sm btn-danger" href="/faculty/'.$row['id'].'/delete"><i class="mdi mdi mdi-delete"></i>Delete</a></td></tr>';
                           $btn = '<button class="btn btn-sm btn-warning" click="editF('.$row['id'].')" type="button" data-toggle="modal" data-target="#departmentModal"><i class="mdi mdi-table-edit"></i>Edit</button>&nbsp;<a class="btn btn-sm btn-danger" click="delF('.$row['id'].')"><i class="mdi mdi mdi-delete"></i>Delete</a></td></tr>';


                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('configuration.department', compact('faculties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|unique:departments'
        ]);


        $department = Department::updateOrCreate(['id'=> $request->did, 'faculty_id' => $request->faculty_id],['name' => $request->name]);

        return response()->json(['success' => true, "message" => 'Department Added Successfully', 'data' => $department]);
    }


    public function show(Department $department)
    {
        $department = Department::with('faculty')->find($department->id);
        return response()->json($department);
    }


    public function destroy(Department $department)
    {
        $department->delete();

        return true;
    }

}
