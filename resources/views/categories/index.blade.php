@extends('layouts.app')

@section('content')
<div id="CA">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="categoryList">
                    @if (count($categories) > 0)
                        @foreach ($categories as $c)
                            <span class="category btn btn-primary" data-id="{{$c->id}}">{{$c->name}}</span>
                        @endforeach
                    @endif
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span>&nbsp New Category
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <div class="container-fluid">
                                <form id="addCategoryForm" action="{{ url('categories/storeCategory') }}" method="POST">
                                    {!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="newCategoryName" name="name" placeholder="Give a name ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <button id="submitCategory" class="btn btn-info" type="button"><span class="glyphicon glyphicon-save"></span>&nbsp Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="tags" type="hidden" name="tags" value=""> </input>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <hr/>

    <div class="container-fluid">
        <div class="row">
            <form id="addNoteForm" action="{{ url('categories/storeNote') }}" method="POST" class="col-sm-12">
                {!! csrf_field() !!}
                <div class="form-group title">
                    <input type="text" name="title" class="form-control" id="newNoteTitle" placeholder="New Note">
                </div>
                <div class="form-group space"></div>
                <div class="form-group content" style="">
                    <input type="text" name="content" class="form-control" id="newNote" placeholder="What's your thinking...">
                </div>
                <div class="form-group space"></div>

                <button type="button" id="submitNote" class="btn btn-primary">Add</button>
            </form>

            <div class="listNote">
                @if (count($notes) > 0)
                    <table class="table table-responsive table-bordered">
                        <tbody>
                        @foreach ($notes as $n)
                            <tr class="noteItem" data-id="{{$n->id}}">
                                <td class="title">{{$n->title}}</td>
                                <td class="content">{{$n->content}}</td>
                                <td class="action">
                                    <a class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                @else
                    Create your first note.
                @endif

            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{!! asset('js/category.js') !!}"></script>
@endsection