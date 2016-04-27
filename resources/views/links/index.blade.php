
@extends('layouts.app')
@section('content')
<div class="container-fluid" id="LA">
    <!--<div class="panel panel-warning">
    <div class="panel-body"> !-->
    <div class="row">
        <div class = "col-sm-5">
            <form id="searchForm" action="{{ url('links/doSearch') }}" method="POST">
                {!! csrf_field() !!}
                <div class = "input-group">
                   <input id="searchTextbox" type = "text" name="searchText" class = "form-control" placeholder="Search">
                   <span class = "input-group-btn">
                      <button id="searchButton" class = "btn btn-primary" type="button">
                         <span class="glyphicon glyphicon-search"></span>
                      </button>
                   </span>
                </div>
            </form>
        </div>
        <div class = "col-sm-1">    
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span>&nbsp New
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
                                                    <button id="addTagButton" class="btn btn-primary" type="button">
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
                                            <button id="saveLinkButton" class="btn btn-primary"  type="button"><span class="glyphicon glyphicon-save"></span>&nbsp Save</button>
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
            <a href="{{ url('/links/tags') }}" class = "btn btn-primary">
                 <span class="glyphicon glyphicon-tags"></span>&nbsp Tag
            </a>
        </div>

     </div> 
     <!-- </div> </div> !-->
</div>
<hr>
<div id="link-panel" class="container-fluid">
<div class="row">
<div class="col-sm-12">
            <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">Newest</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">Most voted</a></li>
                            <li><a href="#tab3primary" data-toggle="tab">Most viewed</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1primary">
                            @include('links.list', ['links' => $links_sort_by_time, 'votes' => $votes_sort_by_time])
                        </div>
                        <div class="tab-pane fade" id="tab2primary">
                            @include('links.list', ['links' => $links_sort_by_vote, 'votes' => $votes_sort_by_vote])
                        </div>
                        <div class="tab-pane fade" id="tab3primary">
                            @include('links.list', ['links' => $links_sort_by_view, 'votes' => $votes_sort_by_view])
                        </div>
                    </div>
                </div>
            </div>
</div>
</div></div>

@endsection

@section('css')
    <link href="{!! asset('css/linkView.css') !!}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <meta name="_token" content="{{ csrf_token() }}" />
    <script src="{!! asset('js/linkView.js') !!}"></script>
@endsection
