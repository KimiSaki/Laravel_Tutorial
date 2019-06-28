@extends('layouts.default')

@section('page-title')
    プロフィール編集
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user_profile.update', ['id' => $user->id]) }}" method="post">
                <input type="hidden" name="_method" value="PUT">
                {!! csrf_field() !!}

                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">紹介文</label>
                    <div class="col-xs-10">
                        <input name="introduction" type="text" class="form-control" value="{{ old('introduction', $user->userProfile->introduction) }}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">誕生日</label>
                    <div class="col-xs-2">
                        <input name="birthday" type="date" class="form-control" value="{{ old('birthday', $user->userProfile->birthday) }}"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="submit" class="btn btn-primary">更新</button>
                        <a href="{{ route('user_profile.show', ['id' => $user->id]) }}" class="btn btn-primary">戻る</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
