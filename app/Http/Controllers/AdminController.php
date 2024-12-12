<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;
use App\Services\TechnicianService;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    
    protected $technicianService;

    public function __construct(TechnicianService $technicianService)
    {
        $this->technicianService = $technicianService;
        // $this->middleware('auth');
        // $this->middleware('admin');
    }

    public function index(){

        return view('admin/index');
    }

    public function formIndex(){

        return view('home/validationforms');
    }

    public function techlist($usertype = null){

        // $users = DB::connection('mysqlDtr')
        //     ->table('users')
        //     ->join(DB::connection('mysqlDts')->getDatabaseName() . '.users as dts_users', 'users.userid', '=', 'dts_users.username')
        //     ->join(DB::connection('mysqlDts')->getDatabaseName() . '.division as dts_division', 'dts_division.id', '=', 'dts_users.division')
        //     ->join(DB::connection('mysqlDts')->getDatabaseName() . '.section as dts_section', 'dts_section.id', '=', 'dts_users.section')
        //     ->join(DB::connection('mysqlDts')->getDatabaseName() . '.designation as dts_designation', 'dts_designation.id', '=', 'dts_users.designation')
        //     ->select(
        //         'users.username',
        //         'users.password',
        //         DB::raw("concat(users.fname,' ',users.lname) as name"),
        //         'users.fname',
        //         'users.lname',
        //         'users.mname',
        //         'users.userid',
        //         'users.id',
        //         'dts_division.description as division',
        //         'dts_section.description as section',
        //         'dts_designation.description as designation'
        //     )
        //     ->where('dts_section.id', 42)
        //     ->paginate(10);

        $users = $this->technicianService->getTechnicians($usertype);
    
        return view('admin.tech.technician',compact('users'));
    }

    public function searchEmp(Request $req, $usertype = null){

    //     $search = $req->get('search');

    //     $employees = DB::connection('mysqlDtr')
    //         ->table('users')
    //         ->join(DB::connection('mysqlDts')->getDatabaseName() . '.users as dts_users', 'users.userid', '=', 'dts_users.username')
    //         ->join(DB::connection('mysqlDts')->getDatabaseName() . '.division as dts_division', 'dts_division.id', '=', 'dts_users.division')
    //         ->join(DB::connection('mysqlDts')->getDatabaseName() . '.section as dts_section', 'dts_section.id', '=', 'dts_users.section')
    //         ->select(
    //             'users.username',
    //             'users.password',
    //             'users.fname',
    //             'users.lname',
    //             'users.mname',
    //             'users.userid',
    //             'dts_users.section as section_id',
    //             'dts_section.description'
    //         )
    //         ->where('users.userid', 'LIKE', "%{$search}%")
    //         ->orWhere('users.fname', 'LIKE', "%{$search}%")
    //         ->limit(10)
    //         ->get();
                    
    //     return response()->json($employees);
        $search = $req->get('search');
        
        if(is_numeric($search)){
            $search = (int) $search;  
        }

        $users = $this->technicianService->getTechnicians($usertype, $search);
        
        return view('admin.tech.viewTech', compact('users'));  
    }

    public function addTechnician(Request $req){

        $emp_id = $req->input('emp_id');
        $usertype = $req->input('usertype');

        DB::connection('mysqlDtr')
                ->table('users')
                ->where('id', $emp_id)
                ->update(['usertype' => $usertype]);

        return redirect()->route('viewtech');
     
    }

    public function viewTechnicians($usertype = 3){

        $users = $this->technicianService->getTechnicians($usertype);

        return view('admin.tech.viewTech', compact('users'));
    }

    public function removetech(Request $req){

        $emp_id = $req->input('emp_id');
        $usertype = $req->input('usertype');

        DB::connection('mysqlDtr')
            ->table('users')
            ->where('id', $emp_id)
            ->update(['usertype' => $usertype]);

        return redirect::back();
    }
}
