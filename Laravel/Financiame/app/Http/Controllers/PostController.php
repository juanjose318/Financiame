<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage passing through two layer validation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validation Rules using Validator class
         */

        $rules = [
            /*'post_id'  =>   'required|numeric',*/
            'title'    =>   'required|min:3',
            'intro'    =>   'required|min:3',
            'content'  =>   'required|min:3',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'    
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
          
            return Redirect::back()
            ->withInput()
            ->with(
                [
                'notification' =>'danger',
                'message' => 'Something went wrong'
                ]
            )
            ->withErrors($validator);
            
        }        
               
        if ($request->hasFile('image'))
        {
            $fileNameWithExtension = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName .'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/posts',$fileNameToStore);
        }
        else {
            $fileNameToStore= 'noImage.jpg';
         
        }
        
        $post = new Post();
        $post->title = $request->input('title');
        $post->intro = $request->input('intro');
        $post->content = $request->input('content');
        $post->image_path = $fileNameToStore;

        $post->save();
        return redirect()->route('admin-posts')->with([
            'notification' => 'succes',
            'message' => 'You have created a new post'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post )
    {
     
            return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {  
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        $post->update(request(['title','content']));
        return redirect('/admin/posts');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post= Post::findOrFail($id);

        $post->delete();
        
        return redirect('admin/posts');
       
    }
}
