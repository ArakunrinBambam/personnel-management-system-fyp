<?php

namespace App\Http\Controllers;

use App\Enums\PersonnelMaritalStatus;
use App\Models\Configuration\Establishment;
use App\Models\Configuration\Faculty;
use App\Models\Configuration\State;
use App\Models\PersonnelManagement\NextOfKin;
use App\Models\PersonnelManagement\Personnel;
use App\Models\Title;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Contracts\Validation\Rule as ValidationRule;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Personnel::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="/personnel/show/'.$row['id'].'" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('personnel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::orderBy('name')->get();
        $establishments = Establishment::all();
        $faculties = Faculty::all();
        $titles = ['Mr','Mrs', 'Miss', 'Ms', 'Dr', 'Engr', 'Prof'];
        $designations = $this->designations();

        return view('personnel.create', compact('states','establishments', 'faculties', 'titles', 'designations'));
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
            'firstname' => 'required|string',
            'surname' => 'required|string',
            'middlename' => 'string',
            'staffno' => 'required|string|unique:personnels,staffno',
            'nationality' => 'required|string',
            'state' => 'required|exists:states,id',
            'lga_id' => 'required|exists:l_g_a_s,id',
            'address' => 'required|string',
            'hometown' => 'required|string',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'sex' => 'required',
            'title' => 'required|array',
            'designation' => 'required|string',
            'phone' => 'required|string|unique:personnels',
            'email' => 'required|email|unique:personnels',
            'faculty' => 'required|exists:faculties,id',
            'marital_status' => [
                'required',
                new Enum(PersonnelMaritalStatus::class)
            ],
            'department_id' => 'required|exists:departments,id',
            'establishment_id' => 'required|exists:establishments,id',
            'appointment_type' => 'required',
            'passport_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'signature_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date_of_first_appointment' => 'required|date|date_format:Y-m-d',
            'date_of_confirmation' => 'required|date|date_format:Y-m-d'

        ]);

        $data = $request->all();

        $passportname = null;
        $signaturename = null;

        try {

            if($request->hasFile('passport_image')){

                $passportname = str_replace(" ","_",(time().$request->firstname.'.'.$request->passport_image->extension()));
                $request->passport_image->move(public_path('passports'), $passportname);
                $data['passport'] = $passportname;

            }

            if($request->hasFile('signature_image')){

                $signaturename = str_replace(" ","_",(time().$request->firstname.'.'.$request->signature_image->extension()));
                $request->signature_image->move(public_path('signatures'), $signaturename);
                $data['signature']= $signaturename;

            }




        }
        catch(Exception $ex){

        }


        $data['user_id'] = Auth::user()->id;
        $personnel =  Personnel::create($data);


        return redirect()->back()->with('success', "Personnel Basic Detail Added Successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $personnel)
    {
        $personnel = Personnel::with('educationHistory', 'nextOfKin', 'employmentHistory', 'promotionHistory', 'department.faculty','establishment', 'lga')->find($personnel->id);
        return view('personnel.show', compact('personnel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonnelManagement\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnel $personnel)
    {
        $titles = ['Mr','Mrs', 'Miss', 'Ms', 'Dr', 'Engr', 'Prof'];
        $states = State::orderBy('name')->get();
        $establishments = Establishment::all();
        $faculties = Faculty::all();
        $designations = $this->designations();
        return view('personnel.edit', compact('personnel','titles','establishments','faculties','states','designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonnelManagement\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personnel $personnel)
    {
        $request->validate([
            'firstname' => 'required|string',
            'surname' => 'required|string',
            'middlename' => 'string',
            'staffno' => ['required','string', Rule::unique('personnels')->ignore($personnel->id)],
            'nationality' => 'required|string',
            'state' => 'required|exists:states,id',
            'lga_id' => 'required|exists:l_g_a_s,id',
            'address' => 'required|string',
            'hometown' => 'required|string',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'sex' => 'required',
            'title' => 'required|array',
            'designation' => 'required|string',
            'phone' => ['required','string', Rule::unique('personnels')->ignore($personnel->id)],
            'email' => ['required', 'email', Rule::unique('personnels')->ignore($personnel->id)],
            'faculty' => 'required|exists:faculties,id',
            'marital_status' => [
                'required',
                new Enum(PersonnelMaritalStatus::class)
            ],
            'department_id' => 'required|exists:departments,id',
            'establishment_id' => 'required|exists:establishments,id',
            'appointment_type' => 'required',
            'passport_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'signature_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'date_of_first_appointment' => 'required|date|date_format:Y-m-d',
            'date_of_confirmation' => 'required|date|date_format:Y-m-d',

        ]);

        $data = $request->all();

        $passportname = null;
        $signaturename = null;

        try {

            if($request->hasFile('passport_image')){

                $passportname = time().$request->firstname.'.'.$request->passport_image->extension();
                $request->passport_image->move(public_path('passports'), $passportname);
                $data['passport'] = $passportname;

            }else {

                $passportname = $personnel->passport;
                $data['passport'] = $passportname;

            }

            if($request->hasFile('signature_image')){

                $signaturename = time().$request->firstname.'.'.$request->signature_image->extension();
                $request->signature_image->move(public_path('signatures'), $signaturename);
                $data['signature']= $signaturename;

            }else {

                $signaturename = $personnel->signature;
                $data['signature']= $signaturename;

            }




        }
        catch(Exception $ex){

        }


        $data['user_id'] = Auth::user()->id;
        $updatePersonnel = $personnel->update($data);


        return redirect('/personnel/show/'.$personnel->id)->with('success', "Personnel Basic Detail Updated Successfully");




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonnelManagement\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personnel $personnel)
    {
        //
    }

    public function addNextOfKin(Request $request)
    {
        $request->validate([
            'surname' => 'required|string',
            'othernames' => 'required|string',
            'relationship' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'personnel_id' => 'required|exists:personnels,id'
        ]);


        $personnel = Personnel::find($request->personnel_id);

        $nextofkin = new NextOfKin();
        $nextofkin->surname = $request->surname;
        $nextofkin->othernames = $request->othernames;
        $nextofkin->relationship = $request->relationship;
        $nextofkin->phone = $request->phone;
        $nextofkin->address = $request->address;

        $personnel->nextOfKin()->save($nextofkin);


    }

    private function designations()
    {
        return ["Lecturer II","Lecturer I","Senior Lecturer","Reader","Professor","Technologist II","Technologist I","Senior Technologist II","Senior Technologist I","Principal Technologist","Assistant Chief Technologist","Chief Technologist","Senior Secretarial Assistant II","Senior Secretarial Assistant I","Chief Secretarial Assistant","Chief Library Assistant/Library Officer","Higher Library Officer","Senior Library Officer II","Senior Library Officer I","Principal Library Officer II","Principal Library Officer I","Asst. Chief Library Officer","Chief Library Officer","Accountant II","Accountant I","Senior Accountant","Principal Accountant","Chief Accountant","Deputy Bursar","Bursar","Engineer II","Engineer I","Senior Engineer","Principal Engineer","Chief Engineer","Deputy Director","Medical Officer II","Medical Officer I","Senior Medical Officer II","Senior Medical Officer I","Principal Medical Officer","Deputy Chief Medical Officer","Chief Medical Officer","Director of Health Services","Confidential Secretary II","Confidential Secretary I","Personal Secretary II","Personal Secretary I","Senior Personal Secretary II","Senior Personal Secretary I","Principal Personal Secretary","Chief Principal Secretary","Administrative Assistant","Administrative Officer","Assistant Registrar","Senior Assistant Registrar","Principal Assistant Registrar","Deputy Registrar","Director","Registrar"];

    }

    public function getByStaffNo(Request $request)
    {
        $personnel = Personnel::Where("staffno",$request->staffno)->first();

        if($personnel){

            return response()->json(['success' => true, "message" => "Personnel Found", "data" => $personnel]);
        }
            return response()->json(['success' => false, "message" => "Personnel Not Found", "data" => []]);
    }


    public function getRetiringPersonnel()
    {
        $from = Carbon::today()->subYear(58);

        $retiringbyage = Personnel::with('department.faculty','establishment')->where('date_of_birth','<=',$from)->get();


        $sfrom = Carbon::today()->subYear(33);

        $retiringbyservice = Personnel::with('department.faculty','establishment')->where('date_of_first_appointment','<=',$sfrom)->get();

        return view('personnel.retiring', compact(['retiringbyage', 'retiringbyservice']));




    }
}
