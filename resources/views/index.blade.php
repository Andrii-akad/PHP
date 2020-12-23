@extends("partials.mainLayout")

@section("content")
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-left">
            @foreach($tags as $item)
                <a class="p-2 link-secondary" href="#">{{$item["name"]}}</a>
            @endforeach
        </nav>
    </div>
    <main class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
            </div>
        </div>
    </main>
    @include("partials.postsList")

@endsection
