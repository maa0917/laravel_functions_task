<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>SessionLogin</title>
</head>
<body>

<a href="{{ route('users.create') }}">Sign up</a>
<a href="">Login</a>

<h1>{{ $title ?? '' }}</h1>

{{ $slot }}

</body>
</html>
