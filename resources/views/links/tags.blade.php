
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class = "col-sm-5">
            <div class = "input-group">
               <input id="searchTextbox" type = "text" class = "form-control" placeholder="Search">
               <span class = "input-group-btn">
                  <button class = "btn btn-default" type = "button">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
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
    @foreach ($tags as $tag)
        <a href="{{ url('links/tags/'.$tag->name) }}" class = "btn btn-info tagButton">
                 {{$tag->name}}
        </a>
    @endforeach
    <br/>
</div>

@endsection

@section('scripts')
    <script src="{!! asset('js/linkView.js') !!}"></script>
@endsection
