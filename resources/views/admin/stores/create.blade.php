@extends('layouts.app')

@section('content')
    <h1>Criar loja</h1>

    <form action="{{route('admin.stores.store')}}" method="post">

        @csrf

        <div class="form-group">
            <label>Loja</label>
            <input type="text" name="name" class='form-control'>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class='form-control'>
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="phone" class='form-control'>
        </div>

        <div class="form-group">
            <label>Celular</label>
            <input type="text" name="mobile_phone" class='form-control'>
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class='form-control'>
        </div>

        <div>
            <button type="submit" class="btn btn-sm btn-dark" style="margin-bottom: 40px;">Confirmar</button>
        </div>
    </form>
@endsection
