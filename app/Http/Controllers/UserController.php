<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        //    $btn = '<button class="btn btn-sm btn-warning" click="editF('.$row['id'].')" type="button" data-toggle="modal" data-target="#facultyModal"><i class="mdi mdi-table-edit"></i>Edit</button>&nbsp;<a class="btn btn-sm btn-danger" href="/faculty/'.$row['id'].'/delete"><i class="mdi mdi mdi-delete"></i>Delete</a></td></tr>';
                           $btn = '<button class="btn btn-sm btn-warning" click="editF('.$row['id'].')" type="button" data-toggle="modal" data-target="#facultyModal"><i class="mdi mdi-table-edit"></i>Edit</button></td></tr>';


                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('usermanagement.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = $request->all();

        $user = User::updateOrCreate(['id'=> $request->uid],[
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json(['success' => true, "message" => 'Personnel Officers Added Successfully', 'data' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
