/**
 * Created At 3/12/16.
 */

function Category() {
    var _scope = $('#CA');

    this.init = function() {
        _scope.on('click', '#submitNote', function() {
            var _title = $('#newNoteTitle');
            if (_title.val().length == 0) {
                _title.focus().notify("Fill some text", {
                    position: "top left",
                    className: "error"
                });
                return false;
            }

            if (_title.val().length == 0) {
                _title.focus().notify("Fill some text", {
                    position: "top left",
                    className: "error"
                });
                return false;
            }

            $('#addNoteForm').submit();

        });
    }
}

$(document).ready(function() {
    (new Category()).init();
});