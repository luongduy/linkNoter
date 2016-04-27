<?php $i = 0; ?>
    @foreach ($links as $link)
    <div class="row">
        <div class="col-sm-1">
            <div >
                @if ($votes[$i] == 1)
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
                @if ($votes[$i] == -1)
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
            <!-- <a class="link" href="{{$link->href}}">{{$link->title}}</a> -->
            <a class="link" href="{{ url('links/'.$link->id) }}">{{$link->title}}</a>
            <label id="{{$link->id}}" class="label label-warning numberOfViewLabel"> {{$link->viewed}} views</label>
            <br />
            @foreach ($link->tags as $tag)
                <a href="{{ url('links/tags/'.$tag->name) }}" class = "btn btn-info tagButton">
                    {{$tag->name}}
                </a>
            @endforeach
            @if ((Auth::user() !== null) and ($link->user->name == Auth::user()->name))
                <span class="deleteLink"> <span class="glyphicon glyphicon-trash"> </span> <a href=""> delete</a> </span>
                <span class="linkOwnerSpan"> <span class="glyphicon glyphicon-user"> </span> <a href="#"> You </a>| </span> 
                <span class="linkOwnerSpan"> <span class="glyphicon glyphicon-time"> </span> <span class="createdAtSpan "> {{$link->created_at}} </span> | </span>
            @else
                <span class="linkOwnerSpan" style="clear: right"> <span class="glyphicon glyphicon-user"> </span> <a href="#"> {{$link->user->name}} </a></span> 
                <span class="linkOwnerSpan" > <span class="glyphicon glyphicon-time"> </span> <span class="createdAtSpan ">{{$link->created_at}} </span> | </span>

            @endif

        </div>
    </div>
    <hr class="linkHr">
    <?php $i++; ?>
    @endforeach