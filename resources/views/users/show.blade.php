@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="inline">{{ $user->name }}</h1>
        @if ($user->id == Auth::id())
            <a class="btn btn-success inline" href="{{ route('users.edit', ['id' => $user->id])}}">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Setting
            </a>
        @else
            <form class="inline" method="post" action="{{ route('follows.store', ['followed_user_id' => $user->id, 'active' => isFollowing($user->id)]) }}">
                {{ csrf_field() }}
                <button class="btn btn-success {{ isFollowing($user->id) }}">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $follow }}
                </button>
            </form>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                きになる
            </div>
            <div class="panel-body">
                <div class="list-group">
                    @foreach ($curiosities as $curiosity)
                    <a class="list-group-item" href="{{ route('works.show', ['id'=> $curiosity->id]) }}">
                        {{ $curiosity->title }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                見たことある
            </div>
            <div class="panel-body">
                <div class="list-group">
                    @foreach ($archives as $archive)
                    <a class="list-group-item" href="{{ route('works.show', ['id'=> $archive->id]) }}">
                        {{ $archive->title }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                よかった
            </div>
            <div class="panel-body">
                <div class="list-group">
                    @foreach ($favorites as $favorite)
                    <a class="list-group-item" href="{{ route('works.show', ['id'=> $favorite->id]) }}">
                        {{ $favorite->title }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                レビュー
            </div>
            <div class="panel-body">
                <div class="list-group">
                    @foreach ($reviews as $review)
                    <a class="list-group-item" href="{{ route('works.show', ['id'=> $review->id]) }}">
                        {{ $review->title }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
