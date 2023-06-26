<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clean Blog - Home</title>
    @include('base.blog.css')
</head>

<body>
    @include('layouts.blog.home.header')
    @include('layouts.blog.home.show.hero')
    @include('layouts.blog.home.show.main')
    @include('layouts.blog.home.footer')
    @include('base.blog.js')

</body>

</html>