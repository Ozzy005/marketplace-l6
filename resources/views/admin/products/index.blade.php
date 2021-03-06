@extends('layouts.app')

@section('content')
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($products))
                @foreach($products as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->name}}</td>
                        <td>R$ {{number_format($p->price, 2, ',', '.')}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.products.edit', ['product' => $p->id])}}" class="btn btn-sm btn-primary">Editar</a>

                                <form action="{{route('admin.products.destroy', ['product' => $p->id])}}" method="POST">
                                    @csrf
                                    @method("DELETE")

                                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
    @if(!empty($products))
        {{$products->links()}}
    @endif
@endsection

