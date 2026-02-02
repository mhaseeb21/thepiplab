<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view ('admin.login');
    }


    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->passes()){        

            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {

                if(Auth::guard('admin')->user()->role != "admin")
                {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error','You are not authorized to access this page');
                }

                return redirect()->route('admin.dashboard');
            }
            else
            {
                return redirect()->route('admin.login')->with('error','Either Email or password is incorrect');
            }
        }
        else
        {
            return redirect()->route('admin.logiin')
            ->withInput()
            ->withErrors($validator);
        }
    }



    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }





}
