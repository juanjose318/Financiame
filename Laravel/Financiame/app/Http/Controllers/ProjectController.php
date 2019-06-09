<?php

namespace App\Http\Controllers;

use App\Project;
use App\Category;
use App\Image;
use App\ImageProject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        
        request()->validate([
            'title'=>'required|min:3',
            'content'=>'required|min:3',
            'intro'=>'required|min:3',
            'credit_goal'=>'required',
            'category_id'=>'required',
            'final_time'=>'required',
            'image[]' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        
        
        $user = auth()->user();
        $userId=$user->id;

        $project = new Project();
        $project->title = $request->input('title');
        $project->content = $request->input('content');
        $project->intro = $request->input('intro');
        $project->user_id = $userId;
        $project->category_id = $request->input('category_id');
        $project->credit_goal = $request->input('credit_goal');
        $project->final_time = $request->input('final_time');
        $project->save();
        
    
        if($request->hasFile('image')) {

            foreach($request->file('image') as $image) {

                $image = new Image();
                $filePath = Storage::put('img/projects/',$image);
                $pathName = basename($filePath);
                $image->path= 'img/projects/' . $pathName;
                $image->save();

                $projectImage = new ImageProject(); 
                $projectImage ->project_id = $project->id;
                $projectImage->image_id= $image->id;
                $projectImage->save();
            }
        }
            return redirect('/packages')->with([
                'notification' => 'success',
                'message' => 'Project uploaded, time to make rewards for your funders'
            ]);
        
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

        $projectImages = DB::table('image_projects')
        ->select('image_id as imageId')
        ->where('image_projects.project_id', '=', $id)
        ->get()
        ->toArray();

        $images = array();

        if (!$images)
        {
            foreach($projectImages as $image)
            {
                $imageId = $image->imageId;
                $imageSelected = Image::find($imageId);   
                $images[] = str_replace('img/', '', $imageSelected->path);
            }
        }

        return view('/projects.show',compact('project','packages','categories','images'));
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
