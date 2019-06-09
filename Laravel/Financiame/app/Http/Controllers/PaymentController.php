<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Package;
use App\ProjectSponsor;
use App\Project;
use App\User;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        return redirect('/user/projects')->with([
            'notification' => 'succes',
            'message'  => 'You succesfully added credits to your account'
        ]);

    }


    /**
         * 10% of the purchase must go to the admin
         * @param $packagePrice presents the price of the package
         * @param $project Project to which the package belongs
         * @param $projectHolder is the user who made the project
     */

    public function fundProject(Request $request)
    {
       
         $actualCredits =auth()->user()->credits;
         $packagePrice = Package::findOrFail( $request->input('package_id'))
         ->select('credit_price')->where('id', '=', $request->input('package_id'))->first();
         

         $user = User::findOrFail(auth()->id());
 
         // Calculate user credits in proportion with the package price 

         if ($actualCredits >= $packagePrice->credit_price ) {
             $projectSponsor = new ProjectSponsor();
             $projectSponsor->package_id = $request->input('package_id');
             $projectSponsor->user_id = auth()->id();
        
             $projectSponsor->save();
           
             $user->credits = $actualCredits - $packagePrice->credit_price;
             $user->save();

             $admin = User::select('*')->where('role_type', '=', '1')->first();
             $admin->credits = $admin->credits + (($packagePrice->credit_price / 100) * 10);
             $admin->save();
 
             $project = Project::select('*',\DB::raw('user_id as userId'))
             ->where('id', '=', $request->input('project_id'))
             ->first();
             
             //dd($request->input('project_id'));

             $projectHolder = User::select('*')
             ->where('id', '=', $project->userId)
             ->first();

 
             $projectHolder->credits = $projectHolder->credits + ($packagePrice->credit_price - (($packagePrice->credit_price / 100) * 10));
             $projectHolder->save();

             return redirect()->back()->with([
                 'notification' => 'Succes',
                 'message' =>'Project supported'
             ]);

            }  

         return redirect()->back()->with([
             'notification' => 'error',
             'message' =>  'Insufficient credits'
         ]);
         
    }
}
