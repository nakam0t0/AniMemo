@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="nav nav-tabs">
                <li><a href="#sampleContentA" data-toggle="tab"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span></a></li>
                <li><a href="#sampleContentD" data-toggle="tab"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a></li>
                <li><a href="#sampleContentC" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="sampleContentA">
                    <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
a                        You are logged in!
                    </div>
                </div>
            </div>
            <div class="tab-pane active" id="sampleContentD:">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
v                        You are logged in!
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="sampleContentC">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
c                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
