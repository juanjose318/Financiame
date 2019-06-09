<?php

namespace App\Http\Controllers;

use \app\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }
    
    public function create(User $user)
    {   
        return view('credits',compact('user'));
    }

    public function store(Request $request)
    {

        $id = auth()->id();

        $user = User::findOrFail($id);
        
        $currentCredits= $user->credits;

        request()->validate(['credits'=>['required','integer']]);
     
        $totalCredits =  $request->input('credits') + $currentCredits;

        $user->credits = $totalCredits;

        $user->save();

        return redirect('/user/projects');

    }
}
