@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <form id="editNoteForm" class="row" action="{{ url('categories/editNote', ['id' => $note->id]) }}" method="POST">
                {!! csrf_field() !!}
                <div class="form-group title">
                    <label for="editNoteTitle">Title</label>
                    <input type="text" value="{{$note->title}}" name="title" class="form-control" id="editNoteTitle" placeholder="...">
                </div>
                <div class="form-group content">
                    <label for="editNote">Content</label>
                    <textarea name="content" class="form-control" id="editNote"
                           placeholder="What's your thinking...">{{$note->content}}</textarea>
                </div>
                <button type="submit" id="submitNote" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection