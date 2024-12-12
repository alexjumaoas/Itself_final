<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RequestModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RequesterController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    //     $this->middleware('requester');
    // }
    
    public function requester(){
        return view('client.index');
    }

    public function homerequest(){

        $user = Auth::guard('custom_users')->user();

        $getrequest = RequestModel::where('requestor_userId', $user->username)
                                    ->where('status', 'Pending')
                                    ->orderby('id','desc')
                                    ->get();
        // $clientprocess = DB::connection('mysqlDts')
        //             ->table('users')
        //             ->where('username', $user->username)
        //             ->get();

        $clientprocess = RequestModel::where('requestor_userId', $user->username)
                        ->where('status', 'accepted')
                        ->orderby('id','desc')
                        ->get();

        return view('client.home', [
            'request' =>  $getrequest,
            'user' => $user,
            'process' => $clientprocess
        ]);
    }

    public function Addrequest(Request $req){
        $user = Auth::guard('custom_users')->user();
        
        $userdts = DB::connection('mysqlDts')
        ->table('users')
        ->where('username', $user->username)
        ->first();
      
        $requestor = new RequestModel();

        $requestor->requestor_userId =  $userdts->username;
        $requestor->status = "Pending";
        $requestor->request_date = \Carbon\Carbon::now();
        //$requestor->request_code = now()->format('YmHis') . '-' . strtoupper(str::random(6));
        $requestor->request_code = now()->format('YmHis') . '-' . $userdts->username;
        $requestor->section = $userdts->section;
        $requestor->division = $userdts->division;
        
        $request_summary = array_filter([
            $req->checkInternet,
            $req->checkComputer,
            $req->checkMonitor,
            $req->checkKeyboard,
            $req->installPrinter,
            $req->installSoftware,
        ]);

        $requestor->request_summary = implode('|', $request_summary);

        if($req->othersSpecify){
            $requestor->others = $req->othersSpecify;
            $requestor->specific_details = $req->detailsOfSpecify;
        }

        $requestor->save();


        return redirect()->route('request.home');
        // return redirect::back();
    }

    public function CancelRequest($reqId){
    
        $requestor = RequestModel::where('id', $reqId)->first();
        $requestor->status = "cancelled";
        $requestor->save();

        return redirect::back();

    }

}
