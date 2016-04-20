/**
 * Created At 4/17/16.
 */
function User() {
    var _scope = $('#PA');
    var _body = $('body');

    var _changeAvatar = function () {
        var _form = $('#uploadAvatarForm');
        LinkNoter.ajax({
            url: '/change-avatar',
            method: 'POST',
            data: _form.serialize(),
            async: false,
            success: function (res) {
                if (res.status == true) {
                    $('#modalProfile').modal('hide');
                    $('#myAvatar').attr('src', res.avatar + '?' +(new Date()).getTime());
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
                            $.singletonNotify("Well done! Your changes are ... changed ;)", {
                                position: "bottom center",
                                className: "success"
                            })
                        }
                    },
                    error: function (xhr, textStatus, e) {
                        if (xhr.status == 422) {
                            $.singletonNotify(LinkNoter.getFirstValidationError(xhr.responseJSON), {
                                position: "bottom center",
                                className: "error"
                            })
                        }
                    }
                })
            });

        _body
            .on('hide.bs.modal', '#modalProfile', function() {
                $('#modalProfile').remove();
                _body.removeClass('modal-open');
                $('.modal-backdrop').remove();
            })
            .on('click', '.loadModalProfile', function () {
                LinkNoter.ajax({
                    url: '/open-modal-avatar',
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
                                _form.find('.preview img').attr('src', file.asset_path + '?' +(new Date()).getTime());
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                LinkNoter.ajax({
                    url: '/clear-avatar',
                    method: 'POST',
                    data: '',
                    success: function (res) {
                        if (res.status == true) {
                            $('#uploadAvatarForm').find('.preview img').attr('src', '/image/cloud.png');
                            $('#uploadHintText').show();
                            $('#modalProfile').find('.modal-options-change').hide();
                        }
                    }
                });

            });
    };
}

$(document).ready(function () {
    (new User()).init();
});
