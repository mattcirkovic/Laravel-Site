@extends('layouts.base')

@section('content')

        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    {{-- {{$page}} --}}
                </div>
                {!! Form::open(['action' => ['BoardMembersController@update', $boardMember->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        {{Form::text('name', $boardMember->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                    </div>
                    <div class="form-group">
                            {{Form::label('description', 'Description')}}
                            {{Form::textarea('description', $boardMember->description, ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Description'])}}
                    </div>
                    {{Form::hidden('_method', 'PUT')}}
                    <div class="form-group">
                        {{Form::file('about_image')}}
                    </div>
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    @csrf
                {!! Form::close() !!}
            </div>
        </div>
@endsection