<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationCategory;
use App\Enums\ApplicationStatus;
use App\Models\PersonnelManagement\Application;
use App\Models\PersonnelManagement\Personnel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\File;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Application::with(['personnel','user']);
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="/application/'.$row['id'].'/edit" class="edit btn btn-primary btn-sm">Update</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('application.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('application.create');
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
            'staffno' => 'required|exists:personnels,staffno',
            'personnel_id' => 'required|exists:personnels,id',
            'category' => ['required',new Enum(ApplicationCategory::class)],
            'title' => 'required|string',
            'document' => ['required', File::types(['doc', 'docx', 'pdf', 'jpg','png'])->max(12* 1024)]
        ]);

        $data = $request->all();

        try {

            if($request->hasFile('document')){

                $docname = str_replace(" ","_",(time().$request->title.'.'.$request->document->extension()));
                $request->document->move(public_path('documents'), $docname);
                $data['supporting_document'] =  $docname;

            }




        }
        catch(Exception $ex){

        }

        $data['user_id'] = Auth::user()->id;

        $data['status'] = ApplicationStatus::processing;

        $application = Application::create($data);

        return redirect()->back()->with('success', "Application Logged Successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // return Application::with('personnel')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Application::with('personnel')->find($id);

        return view('application.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        $request->validate([
            'personnel_id' => 'required|exists:personnels,id',
            'category' => ['required',new Enum(ApplicationCategory::class)],
            'title' => 'required|string',
            'document' => [File::types(['doc', 'docx', 'pdf', 'jpg','png'])->max(12* 1024)],
            'remark' => 'string',
            'status' => ['required',new Enum(ApplicationStatus::class)],
        ]);

        $data = $request->all();

        try {

            if($request->hasFile('document')){

                $docname = str_replace(" ","_",(time().$request->title.'.'.$request->document->extension()));
                $request->document->move(public_path('documents'), $docname);
                $data['supporting_document'] =  $docname;

            }else {
                $data['supporting_document'] = $application->supporting_document;
            }




        }
        catch(Exception $ex){

        }

        $data['user_id'] = Auth::user()->id;


        $application = $application->update($data);

        return redirect('/application')->with('success', "Application Updated Successfully");




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


    private function types(){

    }
}
