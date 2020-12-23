@extends("partials.mainLayout")

@section('content')

    <h2 class="text-center mt-4">Вхід</h2>

    <form method="POST" action="/login">
        @csrf

        @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="mb-3">
            <label for="email" class="form-label">Пошта</label>
            <input type="text" class="form-control" id="email" name="email"
                   value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password"
                   name="password">
        </div>
        <p>
            Для створення нового акаунту протрібно <a href="/register">Реєструватися</a>
        </p>


        <button type="submit" class="btn btn-primary">Вхід</button>
    </form>

@endsection
