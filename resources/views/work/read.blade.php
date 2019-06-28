@extends('layouts.default')

@section('page-title')
{{ $work->title }}
@endsection

@section('content')
<div class="col-md-12">
    <div class="form-group">
        <label>Auther：</label>
        <p><a href="{{ route('user_profile.show', ['id' => $work->user->id]) }}">{{ $work->user->name }}</a></p>
    </div>

    <div class="form-group row">
        <div class="col-xs-10">
            <textarea type="text" name="contents" class="form-control" rows="20" readonly="true">{{ $work->contents }}</textarea>
        </div>
    </div>


    <div class="btn-toolbar">
        <a href="{{ Route('works.index') }}" class="btn btn-primary">戻る</a>
    </div>
</div>

@endsection

