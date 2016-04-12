
@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <span id="{{$link->id}}" class="link-id"></span>
        <div class="col-sm-1">
            <div >
                @if ($vote == 1)
                <button class = "btn btn-default center-block voteButton voteUp" type = "button">
                         <span class="glyphicon glyphicon-chevron-up voted"></span>
                </button> 
                @else
                <button class = "btn btn-default center-block voteButton voteUp" type = "button">
                         <span class="glyphicon glyphicon-chevron-up"></span>
                </button> 
                @endif
            </div>
            <div  align="center">
                <label class="voteLabel"> {{$link->voted}} </label> <br />
            </div>
            <div>
                @if ($vote == -1)
                <button class = "btn btn-default center-block voteButton voteDown" type = "button">
                         <span class="glyphicon glyphicon-chevron-down voted"></span>
                </button>
                @else
                <button class = "btn btn-default center-block voteButton voteDown" type = "button">
                         <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
                @endif
            </div>
        </div>
        <div class="col-sm-11">
            <br />
            <a class="link" target="_blank" href="{{$link->href}}">{{$link->title}}</a>
            <label class="label label-warning numberOfViewLabel"> {{$link->viewed}} views</label>
            <br />
            @foreach ($link->tags as $tag)
                <a href="{{ url('links/tags/'.$tag->name) }}" class = "btn btn-info tagButton">
                    {{$tag->name}}
                </a>
            @endforeach
            @if ($link->user->name == Auth::user()->name)
                <a class="deleteLink" href="">delete</a>
                <span class="linkOwnerSpan"> By you <span class="createdAtSpan">{{$link->created_at}}</span>&nbsp|</span>
            @else
            <span class="linkOwnerSpan" style="clear:right;"> By {{$link->user->name}} <span class="createdAtSpan"> {{$link->created_at}} </span> </span>
            @endif

        </div>
    </div>
    <hr>
</div>

<h3> {{$comments->count()}} Comments</h3>

<div class="container-fluid">
    <?php $i = 0; ?>
    @foreach ($comments as $comment)
    <div class="row">
        <span id="{{$comment->id}}" class="comment-id"></span>
        <div class="col-sm-1">
            <div >
                @if ($votes[$i] == 1)
                <button class = "btn btn-default center-block voteButton comment-voteUp" type = "button">
                         <span class="glyphicon glyphicon-chevron-up voted"></span>
                </button> 
                @else
                <button class = "btn btn-default center-block voteButton comment-voteUp" type = "button">
                         <span class="glyphicon glyphicon-chevron-up"></span>
                </button> 
                @endif
            </div>
            <div  align="center">
                <label class="voteLabel"> {{$comment->voted}} </label> <br />
            </div>
            <div>
                @if ($votes[$i] == -1)
                <button class = "btn btn-default center-block voteButton comment-voteDown" type = "button">
                         <span class="glyphicon glyphicon-chevron-down voted"></span>
                </button>
                @else
                <button class = "btn btn-default center-block voteButton comment-voteDown" type = "button">
                         <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
                @endif
            </div>
        </div>
        <div class="col-sm-11">
            <p> {{ $comment->content }}</p>
        </div>
    </div>
    <hr class="linkHr">
    <?php $i++; ?>
    @endforeach
    <br/>
</div>

@endsection

@section('scripts')
    <meta name="_token" content="{{ csrf_token() }}" />
    <script src="{!! asset('js/commentView.js') !!}"></script>
    <script src="{!! asset('js/common.js') !!}"></script>
@endsection
