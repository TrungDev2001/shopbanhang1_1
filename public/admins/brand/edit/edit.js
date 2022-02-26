//edit form brand
$(document).on('click', '.edit-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    console.log(url);
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $('#nameEdit').val(response.brand.name);
            $('#descriptionEdit').val(response.brand.description);
            $('#statusEdit').val(response.brand.active);
            $('#parent_id_CategoryEdit').val(response.brand.category_id);
            $('.edit-update').attr('data-url', '/brands/update/' + response.brand.id);
        }
    });
});
//edit updated brand

$(document).on('click', '.edit-update', function (e) {
    e.preventDefault();
    console.log('aaa');
    var url = $(this).attr('data-url');
    var data = {
        'nameEdit': $('#nameEdit').val(),
        'descriptionEdit': $('#descriptionEdit').val(),
        'statusEdit': $('#statusEdit').val(),
        'id_CategoryEdit': $('#parent_id_CategoryEdit').val(),
    };
    console.log(data);
    $.ajax({
        type: "post",
        url: url,
        data: data,
        dataType: "json",
        success: function (response) {
            $('#editModal').modal('hide');
            fetchBrand();
            toastr.success(response.message);
        },
        complete: function (xhr, textStatus) {
            if (xhr.status == 403) {
                toastr.error('Tài khoản này không có quyền truy cập');
            };
            $('#editModal').modal('hide');
        }
    });
});