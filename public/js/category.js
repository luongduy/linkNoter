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

    var _validateCategory = function () {
        var _name = $('#newCategoryName');
        if (!_name.val()) {
            _name.focus().notify("Fill some text", {
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
                if (!_validateNote()) {
                    return false;
                }

                var _form = $('#addNoteForm');
                var _listNote = _scope.find('.listNote table tbody');
                LinkNoter.ajax({
                    url: _form.attr('action'),
                    method: 'POST',
                    data: _form.serialize(),
                    success: function (res) {
                        if (!res.status) {
                            return false;
                        }
                        var tr = $('<tr></tr>').attr('class', 'noteItem').attr('data-id', res.id);
                        tr.append($('<td></td>').attr('class', 'title').text(res.title));
                        tr.append($('<td></td>').attr('class', 'content').text(res.content));
                        tr.append($('<td>' +
                                '<a class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;' +
                                '<a class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>' +
                                '</td>').attr('class', 'action')
                        );
                        _listNote.append(tr);
                    }
                });

            })
            .on('click', '.listNote .action a.btn-danger', function () {
                var tr = $(this).parents('.noteItem');
                LinkNoter.ajax({
                    url: '/categories/destroy/' + tr.attr('data-id'),
                    method: 'GET',
                    success: function (res) {
                        if (res.status) {
                            tr.remove();
                        }
                    }
                });
            })
            .on('click', '#submitCategory', function() {
                if (!_validateCategory()) {
                    return false;
                }
                var _form = $('#addCategoryForm');
                var _listCategory = _scope.find('.categoryList');
                LinkNoter.ajax({
                    url: _form.attr('action'),
                    method: 'POST',
                    data: _form.serialize(),
                    success: function (res) {
                        var span = $('<span></span>').attr('class', 'category btn btn-primary').attr('data-id', res.id).text(res.name);
                        _listCategory.append(span);
                    }
                });

            })
        ;
    }
}

$(document).ready(function () {
    (new Category()).init();
});