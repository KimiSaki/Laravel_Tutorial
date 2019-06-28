@extends('layouts.default')

@section('page-title')
    作品を投稿
@endsection

@section('content')
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

    <form action="{{ Route('works.store') }}" method="post">
        {!! csrf_field() !!}

        <div class="form-group row">
            <label class="col-xs-2 col-form-label">作品名</label>
            <div class="col-xs-10">
                <input type="text" name="title" class="form-control" placeholder="作品名を入力してください。" value="{{ old('title') }}"/>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label">キャプション</label>
            <div class="col-xs-10">
                <textarea type="text" name="caption" class="form-control" rows="5" placeholder="作品の説明を入力してください。">{{ old('caption') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label">本文</label>
            <div class="col-xs-10">
                    <textarea type="text" name="contents" class="form-control" rows="20" placeholder="本文を入力してください。">{{ old('contents') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label">ハッシュタグ</label>
            <div class="col-xs-8">
                <input type="text" name="hash_tags" class="form-control" placeholder="ハッシュタグを入力してください。" value="{{ old('hash_tags') }}"/>
                <p class="help-block">複数のハッシュタグをつける場合は、半角スペースで区切ってください。</p>
            </div>
        </div>

        <div class="form-group row">
        <label class="col-xs-2 col-form-label"></label>
            <div class="col-xs-8">
                <div class="radio">
                    <label><input type="radio" name="is_published" value="1" checked="checked">公開</label>
                    <label><input type="radio" name="is_published" value="0">非公開</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-primary">投稿する</button>
                <a class="btn btn-primary" href="{{ Route('works.index') }}">戻る</a>
            </div>
        </div>
    </form>
</div>

@endsection

