@extends('layouts.base')

@section('content')

<link rel="stylesheet" href="css/show.css">

<div class="container post-card">
<div class="card box-shadow mb-5 post-card">
        <div class="card-header">
        <h1>{{$post->title}}</h1>
        </div>
            
        <div class="card-text card-body">
                {!!$post->body!!}
        </div>
        <div class="container post-images">
            <div class="row">
                @foreach(explode(',', $post->post_images) as $image)
                    <div class="col-md-3" oncontextmenu="return false;">
                        <img class="card-img-top post-img img-thumbnail" src="../storage/post_images/{{$image}}" alt="Card image cap">
                    </div>
                    @endforeach
            </div>
            </div>
        <div class="card-footer">
        <small>Written on: {{$post->created_at}}</small>
        </div>

        
</div>
<a href="/posts" class="btn btn-primary show-btn">View All Posts</a>
</div>
@endsection