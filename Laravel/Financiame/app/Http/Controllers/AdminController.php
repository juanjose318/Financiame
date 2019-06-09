<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Project;
use App\Category;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        return view('admin.index');
    }

    /**
     * Displays users
     * 
     * @return \admin\users
     */
    public function showUsers()
    {   
        $users = User::all();
        return view('admin.users',compact('users'));
    }

    /**
     * Deletes users
     * 
     * @return \admin\users
     */
    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }
    
    public function editUser(User $user){

        return view('admin.usersEdit',compact('user'));
    }


    public function updateUser(Request $request, User $user)
    {   
        $rules = [
            'name' => 'required',
            'email'=>'email|required',
            'password'=>'required|min:6'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) 
        {
           return Redirect::back()
           ->withInput()
           ->with(
               [
                   'notification'=>'danger',
                   'message'=>'Something went wrong'
               ]
           )
           ->withErrors($validator);
        }
        
        $user->update(request(['name','email','password']));

        return redirect('admin/users');        
       
    }

    public function showUserProjects(User $user)
    {
        return view('admin.usersProjects',compact('user'));

    }

    public function deleteUserProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->back();  
    }  

    public function editUserProject(Project $project)
    {    
        return view('projects.edit',compact('project','categories'));
    }

    public function showPosts(){
        $posts = Post::all();
        return view('admin.posts',compact('posts'));
    }

    public function editPost(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    public function deletePost($id)
    {
        $post= Post::findOrFail($id);
        $post->delete();
        
        return redirect('admin/posts');
    }

    public function showCategories(){

        $categories = Category::all();
        return view('admin.categories', compact('categories'));

    }

    public function deleteCategory($id)
    {
    
        Category::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function storeCategory(Request $request)
    {
        $rule = ['name'=>'required|min:3'];

        $request->validate($rule);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();


        return redirect()->back()->with([
            'notification'=>'succes',
            'message'=>'New category added'
        ]);
    }   

    public function editCategory(Category $category){

        return view('admin.editCategory',compact($category));

    }

}
