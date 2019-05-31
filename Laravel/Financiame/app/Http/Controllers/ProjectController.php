<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

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

        $fields['user_id'] = Auth::id();

        Project::create(
           $fields
        );
        
        return redirect('/projects');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        return view('/projects.show',compact('project'));
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
     * @param  \Illuminate\Http\Request  $request
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
        
        return redirect('/projects');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        $project->delete();

        return redirect('/projects');
       
    }
}
