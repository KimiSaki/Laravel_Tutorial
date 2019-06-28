@extends('layouts.default')

@section('page-title')
    ログイン
@endsection

@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('auth.postLogin') }}">
        {!! csrf_field() !!}

        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Email</label>
            <div class="col-xs-5">
                <input type="email" name="email" value="{{ old('email') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Password</label>
            <div class="col-xs-5">
                <input type="password" name="password" id="password">
            </div>
        </div>

        <div class="form-group row">
            <input type="checkbox" name="remember"> Remember Me
        </div>

        <div class="form-group row">
            <div class="col-xs-10">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
@endsection
