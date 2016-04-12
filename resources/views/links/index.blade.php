
@extends('layouts.app')
@section('content')
<div class="container-fluid" id="LA">
    <div class="row">
        <div class = "col-sm-5">
            <form id="searchForm" action="{{ url('links/doSearch') }}" method="POST">
                {!! csrf_field() !!}
                <div class = "input-group">
                   <input id="searchTextbox" type = "text" name="searchText" class = "form-control" placeholder="Search">
                   <span class = "input-group-btn">
                      <button id="searchButton" class = "btn btn-default" type="button">
                         <span class="glyphicon glyphicon-search"></span>
                      </button>
                   </span>
                </div>
            </form>
        </div>
        <div class = "col-sm-1">    
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span>&nbsp New
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <div class="container-fluid">
                            <form id="saveLinkForm" action="{{ url('links') }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="addTextbox" name="url" placeholder="Paste your link here ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class = "input-group">
                                                <input type="text" class="form-control" id="tagTextbox" placeholder="Tag ...">
                                                <span class = "input-group-btn">
                                                    <button id="addTagButton" class="btn btn-default" type="button">
                                                        <span class="glyphicon glyphicon-plus-sign"></span>
                                                     </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4"> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button id="saveLinkButton" class="btn btn-info"  type="button"><span class="glyphicon glyphicon-save"></span>&nbsp Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="labelDiv" class="col-sm-12">
                                        <label class="label label-info tagLabel"> css </label>
                                        <label class="label label-info tagLabel"> java </label>
                                    </div>
                                </div>
                                <input id="tags" type="hidden" name="tags" value=""> </input>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
        <div class = "col-sm-1">    
            <a href="{{ url('/links/tags') }}" class = "btn btn-default">
                 <span class="glyphicon glyphicon-tags"></span>&nbsp Tag
            </a>
        </div>

     </div>
</div>
<hr>
<div class="container-fluid">
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
            <a class="link" href="{{ url('links/'.$link->id.'/comments') }}">{{$link->title}}</a>
            <label id="{{$link->id}}" class="label label-warning numberOfViewLabel"> {{$link->viewed}} views</label>
            <br />
            @foreach ($link->tags as $tag)
                <a href="{{ url('links/tags/'.$tag->name) }}" class = "btn btn-info tagButton">
                    {{$tag->name}}
                </a>
            @endforeach
            @if ($link->user->name == Auth::user()->name)
                <a class="deleteLink" href="">delete</a>
                <span class="linkOwnerSpan"> By you <span class="createdAtSpan"> {{$link->created_at}} </span>  | </span>
            @else
            <span class="linkOwnerSpan" style="clear:right;"> By {{$link->user->name}} <span class="createdAtSpan"> {{$link->created_at}} </span> </span>
            @endif

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
    <script src="{!! asset('js/linkView.js') !!}"></script>
@endsection
