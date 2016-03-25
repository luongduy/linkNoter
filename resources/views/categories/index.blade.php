@extends('layouts.app')

@section('content')
    <div id="CA">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="categoryList">
                        @if (!$categories->isEmpty())
                            @foreach ($categories as $c)
                                <span class="categoryWrap">
                                    <a href="{{url('/categories', ['cid' => $c->id])}}" class="category btn btn-<?php echo $c->id == $currentCate->id ? 'info' : 'default' ?>" data-id="{{$c->id}}">{{$c->name}}</a>
                                    <a class="cRemove" data-id="{{$c->id}}"><i class="cRemoveStyle glyphicon glyphicon-remove"></i></a>
                                </span>
                            @endforeach
                        @endif
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span
                                        class="glyphicon glyphicon-plus"></span>&nbsp New Category
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right cateMenuDD" role="menu">
                                <li>
                                    <div class="container-fluid">
                                        <form id="addCategoryForm" action="{{ url('categories/storeCategory') }}"
                                              method="POST">
                                            {!! csrf_field() !!}
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="newCategoryName"
                                                               name="name" placeholder="Give a name ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <button id="submitCategory" class="btn btn-info" type="button"><span
                                                                    class="glyphicon glyphicon-save"></span>&nbsp Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        @if (!$categories->isEmpty())
            <hr/>

            <div class="container-fluid">
                <form id="editCateForm" action="{{ url('categories/editCategory', ['cid' => $currentCate->id]) }}" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group name">
                        <input type="text" id="editCateName" name="name" value="{{$currentCate->name}}" class="form-control col-sm-11" placeholder="Type some words">
                    </div>
                    <button type="submit" id="submitEditCate" class="btn btn-primary">Change</button>
                </form>
            </div>            
        @endif

        <hr/>

        <div class="container-fluid">
            <form id="addNoteForm" class="row" action="{{ url('categories/storeNote', ['cid' => $currentCate->id]) }}" method="POST">
                {!! csrf_field() !!}
                <div class="form-group title col-sm-2">
                    <input type="text" name="title" class="form-control" id="newNoteTitle" placeholder="New Note">
                </div>
                <div class="form-group content col-sm-9">
                    <input type="text" name="content" class="form-control" id="newNote"
                           placeholder="What's your thinking...">
                </div>
                <button type="button" id="submitNote" class="btn btn-primary col-sm-1">Add</button>
            </form>

            <div class="listNote">
                @if (count($notes) > 0)
                    @foreach ($notes as $n)
                        <div class="row noteItem" data-id="{{$n->id}}">
                            <div class="col-sm-2 title">{{$n->title}}</div>
                            <div class="col-sm-9 content">{{$n->content}}</div>
                            <div class="col-sm-1 action">
                                <a href="{{url('categories/editNote', ['id' => $n->id])}}" class="noteBtn edit">Edit</a>
                                <a class="noteBtn rm">Delete</a>
                            </div>
                        </div>
                        <hr id="hrNoteItem{{$n->id}}" />
                    @endforeach
                    <div class="hereEmpty hidden">Create your first note.</div>
                @else
                    <div class="hereEmpty">Create your first note.</div>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{!! asset('js/category.js') !!}"></script>
@endsection