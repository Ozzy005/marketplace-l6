@extends('layouts.app')

@section('content')
<h1>Editar Categoria</h1>

<form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post">

    @csrf
    @method("PUT")

    <div class="form-group">
        <label>Nome da Categoria</label>
        <input type="text" name="name" class='form-control' value="{{$category->name}}">
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" class='form-control' value="{{$category->description}}">
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class='form-control' value="{{$category->slug}}">
    </div>

    <div>
        <button type="submit" class="btn btn-sm btn-dark" style="margin-bottom: 40px;">Confirmar</button>
    </div>
</form>
@endsection
