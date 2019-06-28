@extends('layouts.default')

@section('page-title')
    プロフィール
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3>名前</h3>
        <p>{{ $user->name }}</p>
        <h3>紹介文</h3>
        <p>{{ $user->userProfile->introduction }}</p>
        <h3>誕生日</h3>
        <p>{{ $user->userProfile->birthday }}</p>
    </div>

    <div class="col-md-10">
        <h3>作品一覧</h3>
        <table class="table">
            <tbody>
            @foreach( $works as $work )
                <tr>
                    <td>
                        <ul class="list-unstyled">
                            <li>
                                <span class="label label-default">Title</span>：
                                <a href="{{Route('works.show', ['id' => $work->id]) }}">{{ $work->title }}</a>
                            </li>
                            <li>
                                <span class="label label-default">Auther</span>：
                                <a href="">{{ $work->user->name}}</a>
                            </li>
                            <li>
                                <ul class="list-inline">
                                    <li>
                                        <span class="label label-default">Tags</span>：
                                    </li>
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
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        @if(Auth::check() && Auth::user()->id == $user->id)
            <a href="{{ route('user_profile.edit', ['id' => $user->id]) }}" class="btn btn-primary">編集</a>
        @endif
        <a href="/works" class="btn btn-primary">戻る</a>
    </div>
</div>
@endsection

