@extends('layouts.app')

@section('content')
<div id="CA">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @if (count($categories) > 0)
                    @foreach ($categories as $c)
                        <span class="category btn btn-primary" style="margin-top: 5px; margin-bottom: 5px; margin-right: 5px">{{$c->name}}</span>
                    @endforeach
                    <span class="btn btn-sm btn-default" style="margin-left: 0px;!important;"><i class="glyphicon glyphicon-plus"></i></span>
                @endif
            </div>
        </div>
    </div>

    <hr/>

    <div class="container-fluid">
        <div class="row">
            <form id="addNoteForm" action="{{ url('categories/storeNote') }}" method="POST" class="col-sm-12">
                {!! csrf_field() !!}
                <div class="form-group" style="width: 18%;float: left">
                    <input type="text" name="title" class="form-control" id="newNoteTitle" placeholder="New Note">
                </div>
                <div class="form-group" style="width: 2%;float: left"></div>
                <div class="form-group" style="width: 68%;float: left">
                    <input type="text" name="content" class="form-control" id="newNote" placeholder="What's your thinking...">
                </div>
                <div class="form-group" style="width: 2%;float: left"></div>

                <button type="button" id="submitNote" class="btn btn-primary" style="width: 10%;">Add</button>
            </form>

            <div class="" style="padding-left: 15px;float: left;">
                @if (count($notes) > 0)
                    <table class="table table-responsive table-bordered">
                        <tbody>
                        @foreach ($notes as $n)
                            <tr>
                                <td colspan="2" style="padding: 15px;">{{$n->title}}</td>
                                <td colspan="8" style="padding: 15px;">{{$n->content}}</td>
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