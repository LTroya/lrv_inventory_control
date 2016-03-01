@extends('layout.master')

@section('content')

    @if(isset($product))
        {{ $product }}
    @endif

    <form id="checkerForm" action="/product/check" method="POST">
        <div>
            <label for="code">Codigo</label>
            <input id="code" name="code" type="text" value="01-20130502-010">
        </div>

        <div>
            <label for="measure">Medida</label>
            <input id="measure" name="measure" type="text" value='E306-1/2"'>
        </div>

        <div>
            <label for="style">Estilo</label>
            <input id="style" name="style" type="text" value='1/2"'>
        </div>
        <button>Validar</button>
    </form>

@endsection