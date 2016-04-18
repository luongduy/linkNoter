/**
 * Created At 4/17/16.
 */
function User() {
    var _scope = $('#PA');
    var _body = $('body');

    var _changeAvatar = function () {
        $('#myAvatar').attr('src', null);
        var _form = $('#uploadAvatarForm');
        LinkNoter.ajax({
            url: '/change-avatar',
            method: 'POST',
            data: _form.serialize(),
            success: function (res) {
                if (res.status == true) {
                    $('#modalProfile').modal('hide');
                    $('#myAvatar').attr('src', res.avatar);
                }
            }
        })
    };

    this.init = function () {
        _scope
            .on('click', '.submitUpdateProfile, .submitChangePassword', function () {
                var _form = $(this).parents('form');
                LinkNoter.ajax({
                    url: _form.attr('action'),
                    method: 'POST',
                    data: _form.serialize(),
                    success: function (res) {
                        if (res.status == true) {
                            $.notify("Well done! Your changes are ... changed ;)", {
                                position: "bottom center",
                                className: "success"
                            })
                        }
                    },
                    error: function (xhr, textStatus, e) {
                        if (xhr.status == 422) {
                            $.notify(LinkNoter.getFirstValidationError(xhr.responseJSON), {
                                position: "bottom center",
                                className: "error"
                            })
                        }
                    }
                })
            });

        _body
            .on('click', '.loadModalProfile', function () {
                LinkNoter.ajax({
                    url: '/open-modal-profile',
                    method: 'GET',
                    success: function (res) {
                        _body.append(res);
                        $('#modalProfile').modal('show');
                        var _form = $('#uploadAvatarForm');
                        _form.fileupload({
                            url: _form.attr('action'),
                            dataType: 'json',
                            method: 'POST',
                            complete: function (res) {
                                var file = res.responseJSON.fileInfo;
                                _form.find('.preview img').attr('src', file.asset_path);
                                $('#uploadHintText').hide();
                                _form.find('.modal-options-change').show();
                            }
                        });

                    }
                })
            })
            .on('click', '.submitChangeProfile', function () {
                _changeAvatar();
            })
            .on('click', '.modal-options-change-btn', function () {
                $('#uploadAvatarForm').find('.preview img').attr('src', '/image/cloud.png');
            });
    };
}

$(document).ready(function () {
    (new User()).init();
});
