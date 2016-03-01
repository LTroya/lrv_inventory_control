@extends('layout.master')
{{-- Title --}}
@section('title', 'Esainca - Productos')

@include('layout.sidebar')
{{-- Todos los productos --}}
@section('content')

    @include('auth.logout')
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <h1>Todos los productos
        <small>TOTAL: {{ $products->total() }}</small>
    </h1> <br/>

    <form action="/products" method="GET">
        {{--<input type="hidden" name="limit" value="30"/>--}}
        <div class="form-group" action="/products" method="GET">
            <label for="code">Código del producto:</label>
            <input type="text" class="form-control" name="code" id="code" placeholder="01-20130326-732">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <table class="table table-bordered">
        <tr>
            <th class="text-center">Codigo</th>
            <th class="text-center">Estilo</th>
            <th class="text-center">Medida</th>
            <th class="text-center"></th>
        </tr>
        @foreach($products as $product)
            <tr class="text-center">
                <td>{{ $product->code }}</td>
                <td>{{ $product->style }}</td>
                <td>{{ $product->measure }}</td>
                <td>
                    <form action="/product/{{ $product->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{--@include('pagination.default', ['paginator' => $products])--}}
    {!!   $products->appends(array('code'=>$code))->render() !!}
@endsection