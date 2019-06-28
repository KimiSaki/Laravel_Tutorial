@extends('layouts.default')

@section('page-title')
    作品詳細
@endsection

@section('content')
<div class="col-md-12">
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif
    
    <div class="form-group">
        <label>Title：</label>
        <p>{{ $work->title }}</p>
    </div>

    <div class="form-group">
        <label>Auther：</label>
        <p><a href="{{ route('user_profile.show', ['id' => $work->user->id]) }}">{{ $work->user->name }}</a></p>
    </div>

    <div class="form-group">
        <label>Create Date：</label>
        <p>{{ $work->created_at }}</p>
    </div>

    <div class="form-group">
        <label>Tags:</label>
        <ul class="list-inline">
            @foreach($work->hashTags as $hash_tag)
                <li>
                    <a href="{{ Route('hash_tags.works', ['id' => $hash_tag->id ]) }}">
                        <span class="label label-info">
                            <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                            {{ $hash_tag->name }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="form-group">
        <label>IsPublished:</label>
            @if($work->is_published == 1)
                <span class="label label-success">公開中</span>
            @else
                <span class="label label-default">非公開</span>
            @endif
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Caption</h3>
        </div>
        <div class="panel-body">
            <p>{{ $work->caption }}</p>
        </div>
    </div>

    <div class="btn-toolbar">
        @if(Auth::check() && Auth::user()->id == $work->user->id)
            <a href="/works/{{ $work->id }}/edit" class="btn btn-primary">更新</a>
            <form action="/works/{{ $work->id }}" method="post" onSubmit="return confirmDeleteTheWork()">
                <input type="hidden" name="_method" value="DELETE">
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-primary">削除</button>
            </form>
        @else
            <a href="{{ Route('works.read', ['id' => $work->id]) }}" class="btn btn-primary">読む</a>
        @endif
    </div>

    <br>
    <div class="form-group">
        <a href="{{ Route('works.index') }}" class="btn btn-primary">戻る</a>
    </div>
</div>

<script type="text/javascript">
function confirmDeleteTheWork(){
    return window.confirm("作品を削除しますか？");
}
</script>
@endsection

