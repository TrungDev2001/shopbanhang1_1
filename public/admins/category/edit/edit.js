//edit form category
$(document).on('click', '.edit-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    console.log(url);
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            console.log(response);
            $('#nameCategoryEdit').val(response.category.name);
            //$('#parent_id_CategoryEdit').val(response.category.parent_id);
            $('#parent_id_CategoryEdit').html(response.htmlOption);
            $('#statusCategoryEdit').val(response.category.active);
            $('.edit-update').attr('data-url', '/category/ajax/update/' + response.category.id);
        }
    });
})
//edit update category
$(document).on('click', '.edit-update', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    var data = {
        'name': $('#nameCategoryEdit').val(),
        'active': $('#statusCategoryEdit').val(),
        'prent': $('#parent_id_CategoryEdit').val()
    };
    console.log(url);
    $.ajax({
        type: "post",
        url: url,
        data: data,
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                $('tbody').prepend(response.viewCategoryEdit);
            }
            $('#editModal').modal('hide');
            toastr.success(response.message);
        },
        complete: function (xhr, textStatus) {
            if (xhr.status == 403) {
                toastr.error('Tài khoản này không có quyền truy cập');
            }
            $('#editModal').modal('hide');
        }
    });
});

//edit active category
$(document).on('click', '.activeCategory', function () {
    var url = $(this).attr('data-url');
    var that = $(this);
    console.log(url);
    $.ajax({
        method: 'post',
        url: url,
        success: function (data) {
            that.html(data.activeOn);
            if (data.active == 0) {
                toastr.success(data.messageOff);
            } else {
                toastr.success(data.messageOn);
            }
        },
    });
});
//edit name category
$(document).on('keyup', '.editname', function () {
    $name = $(this).text();
    var url = $(this).attr('data-url');
    console.log($name);
    console.log(url);
    $.ajax({
        method: 'post',
        url: url,
        data: {
            name: $name
        },
        success: function (data) {
            toastr.success(data.message)
        },
        error: function (error) {

        }
    });
});
//cập nhập active lại khi edit
$(document).on('click', '.btnadd', function () {
    console.log('aaa');
    $.ajax({
        type: "get",
        url: "/category/ajax/activeCategory",
        success: function (response) {
            //$('#parent_id_Category').html('');
            //$('#parent_id_Category').prepend(response.htmlOptionAdd);    
        }
    });
})