<?php

namespace App\Http\Controllers;

use App\Post;
use App\Image;
use Illuminate\Http\Request;
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
        $posts = Post::all();

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
            // dd('validation fail');
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
        $post = new Post();
        $post->title = $request->input('title');
        $post->intro = $request->input('intro');
        $post->content = $request->input('content');
        $success = $post->save();


        /**
         * Handle image upload
         */

        if($request->hasfile('image') && $success){

            // dd($request->file('image'));

            $directory = '/storage/project-' . $post->id;

           // $image = $request->file('image');
            foreach($request->file('image') as $image) {

                $name = $image->getClientOriginalName();

                $extension = $image ->getClientOriginalExtension();

                $fileName = pathinfo($name,PATHINFO_FILENAME) . '-' . time() . '.' . $extension;

                $image->storeAs($directory,$fileName,'public');

                $image = new Image();
                $image->post_id = $post->id;
                $image->filename = $fileName;
                $image->filepath = $directory;
                $image->save();
            }

                return back()->with([
                    'notification' => 'succes',
                    'message' => 'You have created a new post'
                ]);

            }

        }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('/posts.show',compact('post'));
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
        return redirect('/posts');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $post->delete();

        return redirect('/posts');
       
    }
}
