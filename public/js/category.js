/**
 * Created At 3/12/16.
 */

function Category() {
    var _scope = $('#CA');

    var _validateNote = function () {
        var _title = $('#newNoteTitle');
        var _content = $('#newNote');
        if (!_title.val()) {
            _title.focus().notify("Fill some text", {
                position: "top left",
                className: "error"
            });
            return false;
        }

        if (!_content.val()) {
            _content.focus().notify("Fill some text", {
                position: "top left",
                className: "error"
            });
            return false;
        }

        return true;
    };

    var _validateCategory = function (inputSelector) {
        if (!inputSelector.val()) {
            inputSelector.focus().notify("Fill some text", {
                position: "top left",
                className: "error"
            });
            return false;
        }
        return true;
    };

    this.init = function () {
        _scope
            .on('click', '#submitNote', function () {
                var _listCate = _scope.find('.categoryList');

                var isEmptyCategory = _listCate.find('.category').length == 0;
                if (isEmptyCategory) {
                    _listCate.focus().notify("Create your first category", {
                        position: "top left",
                        className: "error"
                    });
                    return false;
                }

                if (!_validateNote()) {
                    return false;
                }

                var _form = $('#addNoteForm');
                var _listNote = _scope.find('.listNote');
                LinkNoter.ajax({
                    url: _form.attr('action'),
                    method: 'POST',
                    data: _form.serialize(),
                    success: function (res) {
                        if (!res.status) {
                            return false;
                        }
                        var div = $('<div></div>').attr('class', 'row noteItem').attr('data-id', res.id);
                        div.append($('<div></div>').attr('class', 'col-sm-2 title').text(res.title));
                        div.append($('<div></div>').attr('class', 'col-sm-9 content').text(res.content));
                        div.append($('<div>' +
                                '<a class="noteBtn edit">Edit</a>' +
                                '<a class="noteBtn rm">Delete</a>' +
                                '</div>').attr('class', 'col-sm-1 action')
                        );
                        div.append($('<hr />').attr('id', 'hrNoteItem' + res.id));
                        _listNote.prepend(div);

                        $('.hereEmpty').addClass('hidden');
                    }
                });

            })
            .on('click', '.listNote .action a.rm', function () {
                if (confirm('Delete this note ?')) {
                    var noteSelector = $(this).parents('.noteItem');
                    var noteId = noteSelector.attr('data-id');
                    LinkNoter.ajax({
                        url: '/categories/destroyNote/' + noteId,
                        method: 'GET',
                        success: function (res) {
                            if (res.status) {
                                noteSelector.remove();
                                $('#hrNoteItem' + noteId).remove();
                                if (_scope.find('.listNote .noteItem').length == 0) {
                                    $('.hereEmpty').removeClass('hidden');
                                }
                            }
                        }
                    });
                }
            })
            .on('click', '#submitCategory', function() {
                if (!_validateCategory($('#newCategoryName'))) {
                    return false;
                }
                var _form = $('#addCategoryForm');
                LinkNoter.ajax({
                    url: _form.attr('action'),
                    method: 'POST',
                    data: _form.serialize(),
                    success: function (res) {
                        location.href = '/categories/' + res.id;
                    }
                });
            })
            .on('click', '.categoryList .cRemove', function() {
                if (confirm('Delete this category and all its notes ?')) {
                    location.href = '/categories/destroyCategory/' + $(this).attr('data-id');
                }

            })
        ;
    };

    $('#editCateForm').submit(function() {
        if (!_validateCategory($('#editCateName'))) {
            return false;
        }
        $(this).submit();
    })

}

$(document).ready(function () {
    (new Category()).init();
});