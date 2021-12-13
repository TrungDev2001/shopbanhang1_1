$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//add slider
$(document).on('click', '.btn-add', function () {
    var dataForm = new FormData($('#sliderAdd')[0]);
    $.ajax({
        type: "post",
        url: "/sliders/store",
        data: dataForm,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 400) {
                $('#nameAdd').html(response.errors.nameAdd);
                $('#descriptionAdd').html(response.errors.descriptionAdd);
                $('#image_path_SiderAdd').html(response.errors.image_path_SiderAdd);
            } else {
                $('#addSliderModal').modal('hide');
                $('#addSliderModal').find('input').val('');
                toastr.success(response.message);
                petchSlider();
                $('.avatar1').attr('src', 'web/images/380x500.png');
            }
        }
    });
});