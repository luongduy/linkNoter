@extends('layouts.app')

@section('content')
    <div id="MA">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <p>
                            @if ($user['avatar_path'])
                                <img class="topbar-avatar" src="{{url($user['avatar_path'])}}" />
                            @endif
                            {{ $user['name'] }}
                        </p>
                    </div>
                    <div class="col-md-9"></div>
                </div>
            </div>
        </div>

        <hr/>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Your links</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($links as $link)
                                <div class="row detail linkCollection">
                                    <div class="voteandview col-md-2">
                                        <span class="voted">{{$link['voted']}} votes</span>
                                        <span class="viewed">{{$link['viewed']}} views</span>
                                    </div>
                                    <div class="linkDetail col-md-8">
                                        <a class="link" href="{{$link['href']}}" target="_blank">{{$link['title']}}</a>
                                        <div class="tags">
                                            @foreach($link->tags as $tag)
                                                <a href="{{ url('links/tags/'.$tag->name) }}" class="btn btn-info tagButton">{{$tag->name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="moreInfo col-md-2">
                                        <span class="time pull-right">{{$link['created_at']}}</span>
                                    </div>
                                </div>
                                <hr/>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Your comments</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($comments as $comment)
                                <div class="row detail commentCollection">
                                    <div class="voteandview col-md-2">
                                        <span class="voted">{{$comment['voted']}} votes</span>
                                    </div>
                                    <div class="commentDetail col-md-8">
                                        <span class="commentContent">{{ $comment['content'] }}</span>
                                        <hr/>
                                        <div class="onLink">
                                            On link: <a class="link" href="{{$comment->link ? $comment->link->href : '#'}}" target="_blank">{{$link['title']}}</a>
                                        </div>
                                    </div>
                                    <div class="moreInfo col-md-2">
                                        <span class="time pull-right">{{$comment['created_at']}}</span>
                                    </div>
                                </div>
                                <hr/>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Your Repultaion</h3>
                        </div>
                        <div class="panel-body">
                            Doing...
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Your Tags</h3>
                        </div>
                        <div class="panel-body">

                                <div class="row detail commentCollection">
                                    <div class="voteandview col-md-2">
                                        <span class="voted">Top tags</span>
                                    </div>
                                    <div class="commentDetail col-md-8">
                                        @foreach($tags as $tag)
                                            <a href="{{ url('links/tags/'.$tag->name) }}" class="btn btn-info tagButton">{{$tag->name}}</a>
                                        @endforeach
                                        <div class="onLink">

                                        </div>
                                    </div>
                                    <div class="moreInfo col-md-2">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('css')
    <link href="{!! asset('css/userActivities.css') !!}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('scripts')
    <meta name="_token" content="{{ csrf_token() }}" />
{{--    <script src="{!! asset('js/user.js') !!}"></script>--}}
@endsection