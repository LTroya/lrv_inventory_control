@extends('layout.master')
{{-- Title --}}
@section('title', 'Esainca - Importación de datos');

@include('layout.sidebar')

@section('content')

    @include('auth.logout')
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <h1>Importar productos</h1>

    {!! Form::open(
     array(
         'route' => 'products.import',
         'class' => 'form',
         'novalidate' => 'novalidate',
         'files' => true)) !!}

    {{ csrf_field() }}

    <div class="form-group">
        {!! Form::label('Archivo a importar:') !!}
        {!! Form::file('file', null) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Importar',
                array('class'=>'btn btn-success')) !!}
    </div>
    {!! Form::close() !!}

@endsection