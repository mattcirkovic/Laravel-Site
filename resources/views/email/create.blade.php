@extends('layouts.base')

@section('content')

<link rel="stylesheet" href="css/email.css">

<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title-box">
            <h1 class="title-text">Add your E-Mail</h1>
        </div>
    {!! Form::open(['action' => 'EmailController@store', 'method' => 'POST']) !!}
      <div>
        {{Form::label('email', 'Email')}}
        {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
      </div>
      {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
      @csrf
     {!! Form::close() !!}
    </div>
</div>

@endsection