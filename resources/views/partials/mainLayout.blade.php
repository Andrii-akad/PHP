<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include("partials.head")

@include("partials.styles")
<body class="antialiased">

<div class="container">
@include("partials.nav")

@yield("content")

@include("partials.footer")

</div>

@include("partials.bootstrapScripts")
</body>
</html>
