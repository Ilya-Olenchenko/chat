@extends('layouts.main')
@section('title','registration')
@section('content')

<main class="form-signin">
    <form action="/reg" method="post">
    {{ csrf_field() }}
        
        <h1 style="color: #fff;" class="h3 mb-3 fw-normal">Please sign up</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Ел. почта</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Пароль</label>
        </div>

        <button class="w-100 btn btn-lg btn-info button" type="submit">Зарегистрироваться</button>
        <a style="margin-top: 10px;" href = "/login" class="w-100 btn btn-lg btn-info button">Вход</a>
    </form>
</main>

@endsection