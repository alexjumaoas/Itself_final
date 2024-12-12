<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ITRequestResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class TechnicianController extends Controller
{
    //
    // public function __construct(){
    //     $this->middleware('auth');
    //     $this->middleware('technician');
    // }

    public function technicians() {
        $user = Auth::guard('custom_users')->user();
     
        $pending = RequestModel::where('status', 'Pending')
            ->orderby('id','desc')
            ->get();

        $accepted = RequestModel::where('status', 'accepted')
            ->orderby('id','desc')
            ->get();

        $done = RequestModel::where('status', 'done')
            ->orderby('id','desc')
            ->get();

        return view('technician.index', [
            'pending' => $pending,
            'accepted' => $accepted,
            'done' =>   $done,
            'user' => $user
        ]);
    }

    public function techaccepted($reqid){

        $user = Auth::guard('custom_users')->user();

        $req = RequestModel::where('id', $reqid)->first();

        $req->status = "accepted";

        $response = new ITRequestResponse();
        $response->request_id = $reqid;
        $response->job_started = Carbon::now();
        $response->technician =  $user->fname . ' ' . $user->lname;
        $response->save();
        $req->save();

        return redirect::back();
    }
}
