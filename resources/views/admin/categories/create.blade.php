@extends('layouts.app')

@section('content')
    <h1>Criar Categoria</h1>

    <form action="{{route('admin.categories.store')}}" method="post">

        @csrf

        <div class="form-group">
            <label>Nome da Categoria</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">

            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">

            @error('description')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{old('slug')}}">

            @error('slug')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-sm btn-dark" style="margin-bottom: 40px;">Confirmar</button>
        </div>
    </form>
@endsection
