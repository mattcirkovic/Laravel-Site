@extends('layouts.base')

@section('content')

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                   
                </div>
                {!! Form::open(['action' => 'BoardMembersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                    </div>
                    <div class="form-group">
                            {{Form::label('description', 'Description')}}
                            {{Form::textarea('description', '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Description'])}}
                    </div>
                    <div class="form-group">
                            {{Form::file('about_image')}}
                    </div>
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    @csrf
                {!! Form::close() !!}
            </div>
        </div>
@endsection