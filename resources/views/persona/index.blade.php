@extends('layouts.app')

@section('content')
<div class="container">

        @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

    <a href="{{ url('persona/create') }}" class="btn btn-success" > Registrar nuevo empleado </a>
    <br/>
    <br/>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Peso</th>
                <th>Descripcion</th>
                <th>Link</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($personas as $persona)
            <tr>
                <td> {{ $persona->id }} </td>

                <td> 
                <img src="{{ asset('storage').'/'.$persona->imagen }}" class="img-thumbnail img-fluid" width="100" alt="">
                
                </td>

                <td> {{ $persona->nombre }} </td>
                <td> {{ $persona->apellido }} </td>
                <td> {{ $persona->cargo }} </td>
                <td> {{ $persona->peso }} </td>
                <td> {{ $persona->descripcion }} </td>
                <td> {{ $persona->link }} </td>
                <td> 
                
                <a href="{{ url('/persona/'.$persona->id.'/edit') }}" class="btn btn-warning" >
                    Editar
                </a>
                | 
                
                <form action="{{ url('/persona/'.$persona->id) }}" class="d-inline" method="post">
                @csrf
                {{ method_field('DELETE') }}
                <input type="submit" onclick="return confirm('¿Quieres borrar?')" class="btn btn-danger" value="Borrar">

                </form>

                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
{!! $personas->links() !!}
</div>
@endsection