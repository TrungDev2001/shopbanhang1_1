function FormEditVideo() {
    var url = $(this).attr('data-url');
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            if (response.status == 200) {
                $('.titleEdit').val(response.video.title);
                $('.slugEdit').val(response.video.slug);
                $('.descriptionEdit').val(response.video.discription);
                $('.linkEdit').val(response.video.link);
                $('.imageVideoEdit').attr('src', response.video.image_path_video);
                $('.statusEdit').val(response.video.status);
                $('.btn-edit').attr('data-url', 'Video/update/' + response.video.id);
            }
        }
    });
}
function updateEditVideo() {
    var url = $(this).attr('data-url');
    var dataForm = new FormData($('#videoEdit')[0]);
    $.ajax({
        type: "post",
        url: url,
        data: dataForm,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                window.showMessage('Edit video success');
                $('#editVideoModal').modal('hide');
                window.location.reload();
            } else {
                window.showMessageError('Error');
                $('#editVideoModal').modal('hide');
            }
        }
    });
}

$(document).on('click', '.edit-form', FormEditVideo);
$(document).on('click', '.btn-edit', updateEditVideo);