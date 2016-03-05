@extends('layout.master')
{{-- Title --}}
@section('title', 'Esainca - Productos')

@include('layout.sidebar')
{{-- Todos los productos --}}
@section('content')

    @include('auth.logout')
    <button class="btn btn-danger" id="deleteAllBtn">Borrar todo</button>
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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

    {{-- Modal --}}
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #d9534f; color: #fff">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Eliminar</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center" style="font-size:24px; padding: 20px 0 20px 0;">
                        ¿Deseas eliminar todos los registros?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <form action="/product/delete/all" method="POST" style="display: inline;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Eliminar todo</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        $(document).ready(function () {
            $('#deleteAllBtn').click(function () {
                $('#modal').modal('toggle');
            });
        })
    </script>
@endsection