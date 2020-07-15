<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\BoardMember;

class BoardMembersController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=> ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boardMembers = BoardMember::all();
        return view('board.about')->with('boardMembers', $boardMembers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('board.create');
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
            'name' => 'required',
            'description' => 'required',
            'about_image' => 'image|nullable|mimes:jpeg,jpg,png|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('about_image')){
            //get filename with extension
            $fileNameWithExt = $request->file('about_image')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just extension
            $extension = $request->file('about_image')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('about_image')->storeAs('public/about_images', $fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Board Member
        $boardMember = new BoardMember;
        $boardMember->name = $request->input('name');
        $boardMember->description = $request->input('description');
        $boardMember->about_image = $fileNameToStore;
        $boardMember->save();

        return redirect('/about')->with('success', 'Board Member Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $page = 'Edit Board Member';
        $boardMember = BoardMember::find($id);
        return view('board.edit')->with('boardMember', $boardMember);
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
            'name' => 'required',
            'description' => 'required',
            'about_image' => 'image|nullable|mimes:jpeg,jpg,png|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('about_image')){
            //get filename with extension
            $fileNameWithExt = $request->file('about_image')->getClientOriginalName();
    
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    
            //Get just extension
            $extension = $request->file('about_image')->getClientOriginalExtension();
    
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
    
            //Upload image
            $path = $request->file('about_image')->storeAs('public/about_images', $fileNameToStore);
        }

        //Create Board Member
        $boardMember = BoardMember::find($id);
        $boardMember->name = $request->input('name');
        $boardMember->description = $request->input('description');
        if($request->hasFile('about_image')){
            if($boardMember->about_image != 'noimage.jpg') {
                Storage::delete('public/about_images'.$boardMember->about_image);
            }
            $boardMember->about_image = $fileNameToStore;
        }
        $boardMember->save();

        return redirect('/about')->with('success', 'Boardmember Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boardMember = BoardMember::find($id);

        if($boardMember->about_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/about_images/'.$boardMember->about_image);
        }

        $boardMember->delete();
        return redirect('/about')->with('success', 'Board Member Removed');
    }
}
