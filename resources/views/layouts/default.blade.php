<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Twitter風アプリ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="{{ route('works.index') }}" class="navbar-brand">
                    <span class="glyphicon glyphicon-home" aria-hidden="true" style="font-size:18px;"></span>
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li>
                        <a href="{{ route('user_profile.show', ['id' => Auth::user()->id]) }}" >
                            <span class="glyphicon glyphicon-user" aria-hidden="true" style="font-size:16px;">{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('auth.getLogout') }}">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true" style="font-size:18px;"></span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('auth.getRegister') }}">ユーザ新規登録</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.getLogin') }}">
                            <span class="glyphicon glyphicon-log-in" aria-hidden="true" style="font-size:18px;"></span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="page-header">
        <h1>@yield('page-title')</h1>
    </div>
    <div class="row">
        @yield('content')
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
