<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class signInController extends Controller {

    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        return view('client-layouts.signin');
    }

    public function login(Request $request) {
        //dd($request->all());
        $user = User::where('user_email', $request->form_email)
                ->where('user_password', $request->form_password)
                ->first();
          Auth::loginUsingId($user->id);
          // -- OR -- //
          Auth::login($user);
        if ($user) {
            $tax_year = $request->form_tax_year;
            $query = DB::table('tbl_user_tax_year')->select('user_tax_year')->where("user_id", Auth::User()->id)->where("tax_year_id", $tax_year)->get(); 
            if (count($query) == 0) {
                $data = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => $tax_year,
                );
                $insert = $insert = DB::table("tbl_user_tax_year")->insert($data);
                if ($insert) {
                    Session::put('tax_year_id', $tax_year);
                }
            } else {
                Session::put('tax_year_id', $tax_year);
            }
        }
          if ($user) {
          Auth::loginUsingId($user->id);
          // -- OR -- //
          Auth::login($user);
          return redirect()->route('basicinfo')->with('success', 'You are successfully logged in');;
          //print_r(Auth::User());
          } else {
          return redirect()->back()->with('message', 'Your credencial information is incorrect');
          }
     
    }

    public function logout(Request $request) {
        session_start();
        session_unset();
        session_destroy();
        Auth::logout();
        Session::flash('forcedRefresh', '1');
        Session::flush();
        //Redirect::back();
        return redirect('/');
    }

}
