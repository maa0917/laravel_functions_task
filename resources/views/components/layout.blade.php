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

<p id="notice">
    {{ session('notice') }}
</p>

@if (auth()->check())
    <a href="{{ route('users.show', auth()->user()) }}">Profile</a>
    <form action="{{ route('sessions.destroy', auth()->user()) }}" method="post" name="session_delete" style="display: inline">
        @csrf
        @method('delete')

        <a href="javascript:session_delete.submit()">Logout</a>
    </form>
@else
    <a href="{{ route('users.create') }}">Sign up</a>
    <a href="{{ route('sessions.create') }}">Login</a>
@endif

@if ($title->isNotEmpty())
    <h1>{{ $title ?? '' }}</h1>
@endif

{{ $slot }}

</body>
</html>
