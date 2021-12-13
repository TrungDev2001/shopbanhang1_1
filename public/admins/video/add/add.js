function addVideo() {
    var dataForm = new FormData($('#videoAdd')[0]);
    $.ajax({
        type: "post",
        url: "Video/store",
        data: dataForm,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                window.showMessage('Add video success');
                $('#addSliderModal').modal('hide');
                $('tbody').prepend(response.videoHtml);
            } else if (response.status == 401) {
                $.each(response.errors, function (key, item) {
                    $('.errorsAddVideo').append(`<li class="text-danger">` + item + `</li>`);
                });
            }
            else {
                window.showMessageError('Error');
                $('#addSliderModal').modal('hide');
            }
        }
    });
}
$(document).on('click', '.btn-add', addVideo);