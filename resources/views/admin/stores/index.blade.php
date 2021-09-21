@extends('layouts.app')
@section('content')

    <table class='table table-striped'>

        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>

        @if(auth()->user()->store()->count() === 1)
            <tbody>
                <tr>
                    <td>{{$store->id}}</td>
                    <td>{{$store->name}}</td>
                    <td>{{$store->products->count()}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{route('admin.stores.destroy', ['store' => $store->id])}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        @endif
        
    </table>

@endsection

