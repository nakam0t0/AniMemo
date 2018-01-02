@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="jumbotron"   style="background:url({{ asset('images/white.png') }}); background-size:cover;">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
                <p>アニメ活動の記録</p>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">好きなアニメ</div>
                <div class="panel-heading">気になるアニメ</div>
                <div class="panel-heading">仲間たちと共有</div>
            </div>
        </div>
    </div>
</div>
@endsection
