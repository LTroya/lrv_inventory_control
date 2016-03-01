@extends('layout.master')
{{-- Title --}}
@section('title', 'Esainca - Login')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Login</h1>

    {!! Form::open(
     array(
         'route' => 'auth.login',
         'class' => 'form',
         'novalidate' => 'novalidate',
         'files' => true)) !!}

    {{ csrf_field() }}

    <div class="form-group">
        {!! Form::label('Correo electrónico:') !!}
        {!! Form::text('email', null) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Contraseña:') !!}
        {!! Form::password('password', null) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Acceder',
                array('class'=>'btn btn-success')) !!}
    </div>
    {!! Form::close() !!}

@endsection