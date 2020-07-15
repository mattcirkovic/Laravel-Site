<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=> ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Archive';
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.archive')->with('page', $page)->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Create Post';
        return view('posts.create')->with('page', $page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_images.*' => 'image|mimes:jpeg,png,jpg|max:1999'
        ]);

        $files = array();

        $post = new Post;

        //Handle File Upload
        if($request->hasFile('post_images')){
            $images = $request->file('post_images');

            foreach ($images as $image) {
                //get filename with extension
                $fileNameWithExt = $image->getClientOriginalName();

                //Get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                //Get just extension
                $extension = $image->getClientOriginalExtension();

                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;

                //Upload image
                $path = $image->storeAs('public/post_images', $fileNameToStore);

                if(count($files) != 0){
                    array_push($files, ','.$fileNameToStore);
                }else{
                    array_push($files, $fileNameToStore);
                }
            }

        }else{
             $fileNameToStore = 'noimage.jpg';
        }
        
        $allImages = implode("",$files);
        
        //Create Post
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->post_images = $allImages;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Edit Post';
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post)->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_images.*' => 'image|mimes:jpeg,png,jpg|max:1999'
        ]);

        $files = array();

        //Handle File Upload
        if($request->hasFile('post_images')){
            $images = $request->file('post_images');
            foreach ($images as $image) {
                //get filename with extension
                $fileNameWithExt = $image->getClientOriginalName();

                //Get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                //Get just extension
                $extension = $image->getClientOriginalExtension();

                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;

                //Upload image
                $path = $image->storeAs('public/post_images', $fileNameToStore);

                if(count($files) != 0){
                    array_push($files, ','.$fileNameToStore);
                }else{
                    array_push($files, $fileNameToStore);
                }
            }
        }

        //Update Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('post_images')){
            $post_images = $post->post_images;
            if($post->post_images != 'noimage.jpg'){
                $imgs = explode(',', $post_images);
                foreach($imgs as $img){
                    Storage::delete('public/post_images/'.$img);
                }
            }
            $newImages = implode("",$files);
            $post->post_images = $newImages;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if($post->post_images != 'noimage.jpg'){
            $post_images = $post->post_images;
            $images = explode(',', $post_images);
            if(count($images) > 1){
                foreach($images as $image){
                    Storage::delete('public/post_images/'.$image);
                }
            if(count($images) > 1){
                Storage::delete('public/post_images/'.$images[0]);
            }

        }
    }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
