<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PackageController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $packages = auth()->user()->packages;
        
        return view('package.index',compact('packages'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user = auth()->id();
        
        $projects =DB::table('projects')
        ->select('*', \DB::raw('projects.id as projectId') )
        ->join('users','projects.user_id', '=', 'users.id')
        ->where('projects.user_id','=', $user)
        ->get();

        return view('package.create',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd('Hitting controller');

        
        $fields = request()->validate(array(
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'project_id' => 'required',
            'credit_price' => 'required'  
        )); 
           
        $fields['user_id'] = auth()->id();
        
        Package::create(
            $fields
        );

        return redirect()->route('packages-index')->with([
            'notification' => 'succes',
            'message' => 'You have created a new package'
        ]);;
    }

    public function destroy($id)
    {
        Package::findOrFail($id)->delete();
        
        return redirect()->back()->with([
            'notification' =>'succes',
            'message'=>'Package deleted'
        ]);
    }


}
