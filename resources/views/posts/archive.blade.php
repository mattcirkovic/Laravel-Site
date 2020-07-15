@extends('layouts.base')

@section('content')

<link rel="stylesheet" href="css/archive.css">

<title>Archive</title>

<div class="flex-center position-ref full-height">
    <div class="content">
        <section class="jumbotron text-center">
                <div class="container">
                  <h1 class="jumbotron-heading strong">Archive</h1>
                  <p class="lead text-muted">This is the archive of our blog posts</p>
                  @if(!Auth::guest())
                    <p>
                        <a href="/posts/create" class="btn btn-primary my-2">Create</a>
                    </p>
                  @endif
                </div>
        </section>
       
        <div class="post-list">
            <div class="card-column">
                @if(count($posts) > 0)
                @foreach($posts as $post)
                    <div class="card box-shadow mb-5 text-center">
                        <div class="card-header">
                            <h2><a style="color: black;" href="/posts/{{$post->id}}">{{$post->title}}<a></h2>
                        </div>
                        <div class="text-center image-box" oncontextmenu="return false;">
                        <img class="post-img img-thumbnail" src="storage/post_images/{{explode(',', $post->post_images)[0]}}" alt="">
                        </div>
                        <div class="card-body">
                            <p> {!!$post->body!!}</p>
                        </div>
                
                    <div class="card-footer">
                            @if(!Auth::guest())
                                <div class="btn-group"> 
                                    <a class="btn btn-sm btn-outline-secondary" href="/posts/{{$post->id}}/edit">Edit</a>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST',])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-outline-secondary'])}}
                                    {!!Form::close()!!}
                            @endif
                                <small class="text-muted">Created on: {{$post->created_at}}</small>
                            </div>
                    </div>
                
                
                
        </div>
        @endforeach
                {{$posts->links()}}
                @else
                <p>No Posts Found</p>
            @endif
        </div>
    </div>
    </div>
</div>
@endsection