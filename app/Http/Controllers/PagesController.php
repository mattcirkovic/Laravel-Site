<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    public function index(){
        $page = 'Perserving Accsess to Western Colorado Climbing';
        $posts = Post::orderBy('created_at', 'desc')->take(1)->get();
        return view('pages.home')->with('page', $page)->with('posts', $posts);;
    }

    public function login(){
        return view('auth.login');
    }


    public function about(){
        $page = 'About';
        return view('pages.about')->with('page', $page);
    }
}
