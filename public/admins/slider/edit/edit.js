//edit slider
$(document).on('click', '.edit-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    console.log(url);
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $('#nameEdit').val(response.slider.name);
            $('#descriptionEdit').val(response.slider.description);
            $('#statusEdit').val(response.slider.active);
            $('#image_path_SiderEdit').attr('src', response.slider.image_path_Sider);
            $('.update-slider').attr('data-url', 'sliders/update/' + response.slider.id);
        }
    });
});
//update edit slider
$(document).on('click', '.update-slider', function () {
    var dataFormEdit = new FormData($('#sliderEdit')[0]);
    //console.log(dataFormEdit);
    var url = $(this).attr('data-url');
    $.ajax({
        type: "post",
        url: url,
        data: dataFormEdit,
        contentType: false,
        processData: false,
        success: function (response) {
            petchSlider();
            $('#editSliderModal').modal('hide');
        },
        complete: function (xhr, textStatus) {
            if (xhr.status == 403) {
                toastr.error('Tài khoản này không có quyền truy cập');
            }
        }
    });
});