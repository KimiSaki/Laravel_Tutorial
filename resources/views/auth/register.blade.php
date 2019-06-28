@extends('layouts.default')

@section('page-title')
    ユーザ新規登録
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

    <form method="POST" action="{{ route('auth.postRegister') }}">
        {!! csrf_field() !!}

        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Name</label>
            <div class="col-xs-5">
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
        </div>

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
            <label class="col-xs-2 col-form-label">Password</label>
            <div class="col-xs-5">
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-10">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
    </form>
@endsection
