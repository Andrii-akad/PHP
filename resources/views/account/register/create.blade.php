@extends("partials.mainLayout")

@section('content')

    <h2 class="text-center mt-4">Реєстрація</h2>
    <link  href="/lib/cropperjs/cropper.css" rel="stylesheet">
    <script src="/lib/cropperjs/cropper.js"></script>
    <form method="POST" action="/register">
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
            <label for="name" class="form-label">Ім'я</label>
            <input type="text" class="form-control" id="name"
                   value="{{old('name')}}"
                   name="name">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Фото</label>
            <input type="file" class="form-control" id="photo"
                   value="{{old('photo')}}"
                   name="photo">
            <img id="image" src="/img/no_img.png">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Пошта</label>
            <input type="text" class="form-control" id="email" value="{{old('email')}}" name="email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password"
                   name="password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Підтвердження паролю</label>
            <input type="password" class="form-control" id="password_confirmation"
                   name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Зареєструватися</button>
    </form>
    <script>
        const image = document.getElementById('image');
        const cropper = new Cropper(image, {
            aspectRatio: 1 / 1,
            crop(event) {
                console.log(event.detail.x);
                console.log(event.detail.y);
                console.log(event.detail.width);
                console.log(event.detail.height);
                console.log(event.detail.rotate);
                console.log(event.detail.scaleX);
                console.log(event.detail.scaleY);
            },
        });
    </script>
@endsection
