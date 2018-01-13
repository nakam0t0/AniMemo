@extends('layouts.app')

@section('content')
<div class="container">
    <img class="img" src="{{ $work->image_path }}" width="64" height="64">
    {{ $work->title }}
    {{ $work->year }}年
    @if ($work->cours == 1)
    冬
    @elseif ($work->cours == 2)
    春
    @elseif ($work->cours == 3)
    夏
    @else
    秋
    @endif
    クール
    {{ $work->title_short1 }}／{{ $work->title_short2 }}／{{ $work->title_short3 }}
    <a href="{{ $work->public_url }}">公式サイト</a>
    <a href="{{ route('works.index') }}">作品一覧</a>
    <form method="post">
        {{ csrf_field() }}
        <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
                <button class="btn btn-success {{ isActiveState($work->id, 1) }}" formaction="{{ route('states.store', ['work_id' => $work->id, 'state' => 1, 'active' => isActiveState($work->id, 1)]) }}">
                    <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> {{ $cur_num }}
                </button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-success {{ isActiveState($work->id, 2) }}" formaction="{{ route('states.store', ['work_id' => $work->id, 'state' => 2, 'active' => isActiveState($work->id, 2)]) }}" >
                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> {{ $arc_num }}
                </button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-success {{ isActiveState($work->id, 3) }}" formaction="{{ route('states.store', ['work_id' => $work->id, 'state' => 3, 'active' => isActiveState($work->id, 3)]) }}">
                    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> {{ $fav_num }}
                </button>
            </div>
        </div>
    </form>
    @foreach ($reviews as $review)
        <a href="{{ route('users.show', ['id'=> $review->user_id]) }}">
            {{ $review->text }}
        </a>
    @endforeach
    <form action="{{ route('reviews.store', ['work_id' => $work->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="input-group">
            <span class="input-group-addon">レビュー</span>
            <input type="text" name="text" class="form-control" @isset ($text) {{ "value=" . $text}} @endisset required>
            <span class="input-group-btn">
                <button class="btn btn-default">送信</button>
            </span>
        </div>
    </form>


</div>
@endsection
