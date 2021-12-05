<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class AutController extends Controller
{
    public function reg_index()
    {
       return view('signup');
    }
    public function login_index()
    {
       return view('login');
    }
    public function save(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validated){
            $usert = DB::select('select * from users where email = :email LIMIT 1',
            [
                'email' => $request['email'],
            ]);

            if($usert){
                return redirect('/reg')->withErrors(['FormError' => 'User with this email does exist']);
            }else{

                $validated['password'] = Crypt::encryptString($validated['password']);
                $user = User::create($validated);
                if($user){
                        return redirect('login');
                }   
            }

        }else{
            return redirect('/reg')->withErrors(['FormError' => 'validate error']);
        }
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validated){
            $user = DB::select('select * from users where email = :email LIMIT 1', 
            [
             'email' => $request['email'],
            ]);
            if($user){
    
                if(Crypt::decryptString($user[0]->password) ==  $request['password']){     
                   
                    $us = User::find($user[0]->id);
                    Auth::login($us);
                    return redirect('/');
                }else{
                    return redirect('/login')->withErrors(['FormError' => 'Password is not correct']);
                }
            }else{
                return redirect('/login')->withErrors(['FormError' => 'User with this email not found']);
            }
        }else{
            return redirect('/login')->withErrors(['FormError' => 'validate error']);
        }
    }
    
    public function logout(){
      Auth::logout();
      return redirect('login');
    }
}
