<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{   

    public function __construct()
    {

        $this->middleware('auth')->except(['show','index']);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);

        return view('projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage passing through two layer validation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        $fields =  request()->validate([
            'title'=>['required','min:3'],
            'content'=>['required','min:3'],
            'intro'=>['required','min:3'],
            'credit_goal'=>['required'],
            'category_id'=>['required'],
            'final_time'=>['required'],
        ]);

        $fields['user_id'] = auth()->id();

        Project::create(
           $fields
        );
        
        return redirect('/packages');

    }


    public function show($id)
    {   
        $project= DB::table('projects')
        ->select('*',\DB::raw('projects.user_id as userId, projects.final_time as finalTime, projects.id as projectId'))
        ->where('projects.id', '=',$id)
        ->first();

        $packages = DB::table('packages')
        ->select('*', \DB::raw("packages.id as packageId"))
        ->where('packages.project_id','=', $id)
        ->get();

        $categories =DB::table('projects')
        ->select('*', \DB::raw("projects.id as projectId"))
        ->join('categories','projects.category_id', '=', 'categories.id')
        ->where('projects.category_id','=', $id)
        ->get();

        return view('/projects.show',compact('project','packages','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {  
        $categories = Category::all();
        return view('projects.edit',compact(['project','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {
        
        
        $fields =  request()->validate([
            'title'=>['required','min:3'],
            'content'=>['required','min:3'],
            'intro'=>['required','min:3'],
            'credit_goal'=>['required'],
            'category_id'=>['required'],
            'final_time'=>['required'],
        ]);

        Project::whereId($project->id)->update(
           $fields
        );
        
        return redirect('/packages');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        abort_if($project->user_id !== auth()->id(),403);

        $project->delete();

        return redirect('/projects');
       
    }

    public function showUserProjects ()
    {   
        
        $projects = Project::where('user_id', auth()->id())->get();
        
        

        return view('dashboard', compact('projects'));
    }   

    public function showPackages(Project $project){
    
    
        return view('projects.payment',compact('project'));
    }
}
