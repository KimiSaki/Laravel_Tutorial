@extends('layouts.default')

@section('page-title')
    作品一覧
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">
            <a class="btn btn-primary" href="{{ Route('works.create') }}">作品を投稿</a>
        </div>
        <div class="col-md-10">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            <div class="form-group row">
                <form action="{{ Route('works.index') }}" method="get">
                    <div class="col-xs-4">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="検索する言葉を入力してください。" value="{{$keyword}}">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <i class='glyphicon glyphicon-search'></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table">
                <tbody>
                @foreach( $works as $work )
                    @if($work->is_published == 1)
                    <tr>
                        <td>
                            <ul class="list-unstyled">
                                <li>
                                    <span class="label label-default">Title</span>：
                                    <a href="{{Route('works.show', ['id' => $work->id]) }}">{{ $work->title }}</a>
                                </li>
                                <li>
                                    <span class="label label-default">Auther</span>：
                                    <a href="{{ route('user_profile.show', ['id' => $work->user->id]) }}">{{ $work->user->name}}</a>
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
                    @endif
                @endforeach
                </tbody>
            </table>

            <div class="col-sm-8" style="text-align:right;">
                <div class="paginate">
                    {!! $works->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
