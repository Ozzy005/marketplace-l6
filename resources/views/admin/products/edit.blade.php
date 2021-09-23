@extends('layouts.app')

@section('content')
<h1>Editar Produto</h1>

<form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">

    @csrf
    @method("PUT")

    <div class="form-group">
        <label>Nome Produto</label>
        <input type="text" name="name" class='form-control' value="{{$product->name}}">
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" class='form-control' value="{{$product->description}}">
    </div>

    <div class="form-group">
        <label>Conteúdo</label>
        <textarea name="body" class="form-control" cols="30" rows="10">{{$product->body}}</textarea>
    </div>

    <div class="form-group">
        <label>Preço</label>
        <input type="text" name="price" class='form-control' value="{{$product->price}}">
    </div>
    
    <div class="form-group">
        <label>Categorias</label>
        <select name="categories[]" class="form-control" multiple>
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if($product->categories->contains($category)) selected @endif> {{$category->name}} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Fotos do produto</label>
        <input type="file" name="photos[]" class="form-control @error('photos') is-invalid @enderror" multiple>
        @error('photos')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class='form-control' value="{{$product->slug}}">
    </div>

    <div>
        <button type="submit" class="btn btn-sm btn-dark" style="margin-bottom: 40px;">Confirmar</button>
    </div>
</form>

<div class="row">
    @foreach($product->photos as $photo)
        <div class="col-4 text-center">
            <img src="{{asset('storage/'.$photo->photo)}}" alt="" class="img-fluid">
            <form action="{{route('admin.products.photo.remove')}}" method="POST">
                @csrf
                <input type="hidden" name="photoId" value="{{$photo->id}}">
                <button class="btn btn-sm btn-dark" style="margin-bottom: 40px;">Delete</button>
            </form>
        </div>
    @endforeach
</div>

@endsection
