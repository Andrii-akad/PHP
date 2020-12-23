@extends("partials.mainLayout")

@section("content")
<?php
echo "
    <article class='blog-post'>
        <h1 class='blog-post-title'>{$post["title"]}</h1>
        <p>{$post["description_short"]}</p>
        <hr>
        <p>{$post["description"]}</p>
    </article><!-- /.blog-post -->
    <a href='/changePost/{$post["id"]}'>Update</a>
    <div class='d-flex mt-2  justify-content-between' style='width:15%'>
        <p class='font-weight-bold mr-2'>Tags: </p>

    </div>
";
foreach($post->tags as $item)
    echo "<a class='link-secondary pr-2'  href='#'> {$item["name"]}  </a>";
?>
@endsection
