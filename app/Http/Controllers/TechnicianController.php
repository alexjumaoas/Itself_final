<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    //
    // public function __construct(){
    //     $this->middleware('auth');
    //     $this->middleware('technician');
    // }

    public function technicians() {
        $user = Auth::guard('custom_users')->user();
     
        $getrequest = RequestModel::where('status', 'Pending')
            ->orderby('id','desc')
            ->get();
      
        return view('technician.index', [
            'request' =>  $getrequest,
            'user' => $user
        ]);
    }

    public function techaccepted($reqid){
        
    }
}
