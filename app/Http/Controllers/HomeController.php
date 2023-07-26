<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatus;
use App\Models\Configuration\Department;
use App\Models\Configuration\Faculty;
use App\Models\PersonnelManagement\Application;
use App\Models\PersonnelManagement\Personnel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $total_no_of_personnels = count(Personnel::all());


        $total_no_of_pending_application = count(Application::where('status', ApplicationStatus::processing)->get());

        $no_of_faculties = count(Faculty::all());

        $no_of_departments = count(Department::all());

        return view('home', compact('total_no_of_personnels','total_no_of_pending_application','no_of_faculties', 'no_of_departments'));
    }
}
