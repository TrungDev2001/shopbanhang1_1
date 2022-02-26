//add brand

$(document).on('click', '.btn-add', function (e) {
    e.preventDefault();
    var data = {
        'nameAdd': $('#nameAdd').val(),
        'descriptionAdd': $('#descriptionAdd').val(),
        'statusAdd': $('#statusAdd').val(),
        'category_idAdd': $('#parent_id_CategoryAdd').val(),
    };
    $.ajax({
        type: "post",
        url: "/brands/store",
        data: data,
        dataType: "json",
        success: function (response) {
            if (response.status == 400) {
                $('#nameAddError').html(response.errors.nameAdd);
                $('#descriptionAddError').html(response.errors.descriptionAdd);
                $('#id_CategoryAddError').html(response.errors.category_idAdd);
            } else {
                $('#addModal').find('input').val('');
                $('#addModal').modal('hide');
                fetchBrand();
                //loadBrandsDate(page);
                toastr.success(response.message);
            }
        },
        complete: function (xhr, textStatus) {
            if (xhr.status == 403) {
                toastr.error('Tài khoản này không có quyền truy cập');
            };
            $('#addModal').modal('hide');
        }
    });
});