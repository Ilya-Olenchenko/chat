<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        if(Auth::check()){
            $messages = Messages::all();
            return view('chat', ['messages' => $messages]);
        }else {
           return redirect('login');
        }
    }
    public function add(Request $req){
        
        if(!empty($req['message_text'])){
            $email = Auth::user()->email;
            DB::insert(
            'insert into messages (Email, Sms, Data) values (?, ? , current_timestamp())',
             [$email, $req['message_text']]); 
        }
    }
    public function get(){
        $messages = DB::select('select * from messages where Data >= date_sub(NOW(), interval 3 hour)');
      return view('data', ['messages' => $messages]);
    }
}
