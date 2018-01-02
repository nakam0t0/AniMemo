@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ Auth::user()->name }} さん</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                きになる
            </div>
            <div class="panel-body">
                <div class="list-group">
                    @foreach ($curiosities as $curiosity)
                    <a class="list-group-item" href="">
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
                    <a class="list-group-item" href="">
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
                    <a class="list-group-item" href="">
                        {{ $favorite->title }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
