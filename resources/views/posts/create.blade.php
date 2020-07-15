@extends('layouts.base')

@section('content')

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{$page}}
                </div>
                {!! Form::open(['action' => 'PostsController@store', 'files' => 'true', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('title', 'Title')}}
                        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                    </div>
                    <div class="form-group">
                            {{Form::label('body', 'Body')}}
                            {{Form::textarea('body', '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body'])}}
                    </div>
                    <div class="form-group">
                        {{Form::file('post_images[]',   array('multiple'=>true))}}
                    </div>
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    @csrf
                {!! Form::close() !!}
            </div>
        </div>
@endsection