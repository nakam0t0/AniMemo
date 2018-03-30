@extends('layouts.app')

@section('content')
<div class="container">
    <div class="tac">
        <div class="input-group my_box">
            <form action="{{ route('works.index') }}">
                <input type="number" name="year" min="2014" max="{{ getdate()['year'] }}" @if ($year) {{ "value=" . $year }} @endif>
                <select name="cours">
                    <option value="0" @if ($cours == 0) {{ "selected" }} @endif>-</option>
                    <option value="1" @if ($cours == 1) {{ "selected" }} @endif>冬</option>
                    <option value="2" @if ($cours == 2) {{ "selected" }} @endif>春</option>
                    <option value="3" @if ($cours == 3) {{ "selected" }} @endif>夏</option>
                    <option value="4" @if ($cours == 4) {{ "selected" }} @endif>秋</option>
                </select>
                <input type="text" name="title" placeholder="作品名" @if ($title) {{ "value=" . $title}} @endif>
                <input class="" type="submit" value="送信">
            </form>
        </div>
    </div>
    <div class="row">
        @if ($works->isEmpty())
        <h3>該当作品なし</h3>
        @endif
        @foreach ($works as $work)
        <div class="col-xs-12 col-md-4">
            <div class="thumbnail">
                <a href="{{ route('works.show', ['id'=> $work->id]) }}">
                    <div class="media">
                        <div class="media-left">
                            <img src="{{ $work->image_path }}" width="64" height="64" alt="">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                {{ $work->title }}
                            </h4>
                        </div>
                    </div>
                </a>
                <div class="caption">
                    <form method="post">
                        {{ csrf_field() }}
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <button class="btn btn-success {{ isActiveState($work->id, 1) }}" formaction="{{ route('states.store', ['work_id' => $work->id, 'state' => 1, 'active' => isActiveState($work->id, 1)]) }}">
                                    <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button class="btn btn-success {{ isActiveState($work->id, 2) }}" formaction="{{ route('states.store', ['work_id' => $work->id, 'state' => 2, 'active' => isActiveState($work->id, 2)]) }}" >
                                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button class="btn btn-success {{ isActiveState($work->id, 3) }}" formaction="{{ route('states.store', ['work_id' => $work->id, 'state' => 3, 'active' => isActiveState($work->id, 3)]) }}">
                                    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="tac">
        {{ $works->appends(['year' => $year, 'cours' => $cours, 'title' => $title])->links() }}
    </div>
</div>
@endsection
