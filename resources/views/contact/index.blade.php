@extends('layouts.app')
@section('content')
    <div class="container bg-white p-4">
        <h3>Contactos</h3>
        <hr>
        <a href="{{route('user.create')}}" class="btn btn-success mb-2">Nuevo</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td class="d-flex">
                            @if (auth()->user()->id != $user->id)
                                <a href="{{route('user.edit',$user)}}" class="btn btn-warning">Editar</a>
                                <form action="{{route('user.destroy',$user)}}" method="post" class="ml-2">
                                    @csrf
                                    @method('delete')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
