<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success">Criar Loja</a>
        <a href="{{route('admin.stores.index')}}" class="btn btn-lg btn-success">Listar Lojas</a>
        <a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success">Criar Produto</a>
        <a href="{{route('admin.products.index')}}" class="btn btn-lg btn-success">Listar Produto</a>

        @include('flash::message')
        @yield('content')
    </div>
</body>
</html>