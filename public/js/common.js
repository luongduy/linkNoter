/**
 * Created At 3/12/16.
 */
var LinkNoter = {
    ajax: function (params) {
        if (typeof params.error === 'undefined') {
            params.error = function (xhr, textStatus, e) {
                $.notify(textStatus, {
                    position: "bottom center",
                    className: "error"
                })
            };
        }

        return $.ajax(params);
    },

    getFirstValidationError: function (errors) {
        return arrayValues(errors)[0];
    }

};

function convertDateToUTC(date) {
    return new Date(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(), date.getUTCHours(), date.getUTCMinutes(), date.getUTCSeconds());
}

function arrayValues(o) {
    return Object.keys(o).map(function (k) {
        return o[k]
    });
}

function readFileClient(input, previewSelector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            previewSelector.attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}