@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="jumbotron">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
                <h3> - アニメを記録する - </h3>
            </div>
            <ul class="list-group">
                
                    <li class="list-group-item"><div class="container"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>　いつか観る</div></li>
                    <li class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>　視聴済み</li>
                    <li class="list-group-item"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>　お気に入り</li>
                    <li class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>　レビュー</li>
                    <li class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>　つながる</li>
                
            </ul>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
