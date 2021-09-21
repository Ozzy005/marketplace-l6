@extends('layouts.app')

@section('content')
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-sm btn-primary">Editar</a>

                            <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}" method="POST">
                                @csrf
                                @method("DELETE")

                                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$categories->links()}}
@endsection

