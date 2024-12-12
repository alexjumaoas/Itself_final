<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index(){

    }

    public function loginusers(){

        return view('forms.login');
    }

    public function userLogin(Request $req){
      
            $user = DB::connection('mysqlDtr')
            ->table('users')
            ->where('username', $req->username)
            ->first();

            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found');
            }

            if (!Hash::check(trim($req->password), $user->password)) {
                return redirect()->route('login')->with('error', 'Invalid username or password');
            }

            // Log in the user using their ID
            Auth::guard('custom_users')->loginUsingId($user->id);

            session(['user' => $user]);

            // Redirect based on user type
            switch ($user->usertype) {
                case 1: // Admin
                    return redirect()->route('dashboard');
                case 3: // Technician
                    return redirect()->route('technician.dashboard');
                case 0: // Requester
                    return redirect()->route('requester.dashboard');
                   
                default:
                    return redirect()->route('unauthorized');
            }

           
    }

    public function registeruser(){

        return view('forms.register');
    }

    public function logout(Request $request){

        Auth::guard('custom_users')->logout();

        $request->session()->invalidate();

        $request->session()->invalidate();

        return redirect('login')->with('success', 'You have been logged out successfully.');
    }
}
