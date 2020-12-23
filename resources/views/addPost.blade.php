@extends("partials.mainLayout")

@section("content")
    <link href="/lib/cropperjs/cropper.css" rel="stylesheet">
    <script src="/lib/cropperjs/cropper.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <form class="mb-4" method="POST" action="{{ route('post.create') }}" enctype="multipart/form-data">
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

        <div class="d-flex justify-content-between mt-4">
            <div class="mb-3 mr-4 " style="width:70%">
                <label for="inputPassword5" class="form-label label">Title</label>
                <input type="text" id="inputPassword5" name="title" class="form-control "
                       aria-describedby="passwordHelpBlock">
            </div>
            <div class="mb-3 w-25">
                <label for="inputPassword5" class="form-label label">Category</label>
                <select class="form-select" aria-label="Default select example" name="id_category">
                    @foreach($categories as $category)
                        <option value={{$category['id']}}>{{$category['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 mr-4 w-100">
            <label for="inputPassword5" class="form-label label">Оберіть фото</label>
            <input type="file" id="photo" onchange="setCropper(this)" name="photo">
            <img id="image" src="/img/no_img.png" width="200">
        </div>

        <div class="mb-3 mr-4 w-100">
            <label for="inputPassword5" class="form-label label">Short Description</label>
            <textarea id="short_description" name="short_description" class="w-100"
                      aria-describedby="passwordHelpBlock"></textarea>
        </div>

        <label for="inputPassword5" class="form-label label"> Description</label>
        <textarea name="description" id="description" class="w-100" aria-describedby="passwordHelpBlock"
                  required></textarea>

        <p class="label">Tags: </p>
        @foreach($tags as $tag )
            <div class="form-check form-check-inline">
                <input value="{{$tag['id']}}" class="form-check-input" type="checkbox" name="check[]" id={{$tag['id']}}>
                <label class="form-check-label" for="{{$tag["name"]}}">{{$tag["name"]}}</label>
            </div>
        @endforeach
        <div class="d-flex w-100 justify-content-center mt-4">
            <button type="submit" class="w-25 btn btn-dark mb-3">Post</button>
        </div>
    </form>

    <!-- Include Editor JS files. -->
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/js/froala_editor.pkgd.min.js"></script>

    <!-- Initialize the editor. -->
    <script>
        //var csrf_token = $('meta[name="csrf-token"]').attr('content');
        new FroalaEditor('#short_description', {
            attribution: false,
            // Set the file upload URL.
            imageUploadURL: '/posts/upload',

            imageUploadParams: {
                id: 'my_editor',
                _token: "{{ csrf_token() }}"
            },
        });
        //setTimeout(() => document.querySelector("div.fr-wrapper.show-placeholder > div").style.display = 'none', 400);

    </script>
    <style>
        div.fr-wrapper > div:first-child {
            display: none !important;
            visibility: hidden !important;
        }
    </style>
    <script>
        const image = document.getElementById('image');
        const cropper = new Cropper(image, {
            aspectRatio: 200 / 250,
            crop(event) {
            },
        });
    </script>

    <script>
        function setCropper(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    cropper.replace(e.target.result);
                    $('#image')
                    .attr('src',e.target.result)
                    .width(200)
                    .height(250);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
