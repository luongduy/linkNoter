
@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-primary">
        <div class="panel-body">
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
            @if ((Auth::user() !== null) and ($link->user->name === Auth::user()->name))
                <a class="deleteLink" href="">delete</a>
                <span class="linkOwnerSpan"> By you <span class="createdAtSpan">{{$link->created_at}}</span>&nbsp|</span>
            @else
            <span class="linkOwnerSpan" style="clear:right;"> By {{$link->user->name}} <span class="createdAtSpan"> {{$link->created_at}} </span> </span>
            @endif
        </div>
        </div></div>
    </div>
</div>

<h3> {{$comments->count()}} Comments</h3>
<hr>

<div class="container-fluid">
    <form id="post-comment-form" method="POST" action="{{ url('links/'.$link->id.'/postComment') }}">
        {!! csrf_field() !!}
        <div class="form-group">
            <p class="lead emoji-picker-container">
                <textarea class="form-control textarea-control" rows="4" placeholder="Join the discussion..." data-emojiable="true" name="content"></textarea>
           </p>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type=submit>Post</button>
        </div>
  </form>
</div>

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
            <p class="comment-box"> {{ $comment->content }}</p>
        </div>
    </div>
    <hr class="linkHr">
    <?php $i++; ?>
    @endforeach
    <br/>
</div>
<div class="container-fluid">
    <p class="lead emoji-picker-container">
            <textarea class="form-control textarea-control" rows="3" placeholder="Textarea with emoji image input" data-emojiable="true"></textarea>
    </p>
</div>

@endsection

@section('scripts')
    <meta name="_token" content="{{ csrf_token() }}" />
    <script src="{!! asset('js/commentView.js') !!}"></script>
    <script src="{!! asset('js/common.js') !!}"></script>

    <script src="{!! asset('emoji/lib/js/nanoscroller.min.js') !!}"></script>
    <script src="{!! asset('emoji/lib/js/tether.min.js') !!}"></script>
    <script src="{!! asset('emoji/lib/js/config.js') !!}"></script>
    <script src="{!! asset('emoji/lib/js/util.js') !!}"></script>
    <script src="{!! asset('emoji/lib/js/jquery.emojiarea.js') !!}"></script>
    <script src="{!! asset('emoji/lib/js/emoji-picker.js') !!}"></script>

@endsection
