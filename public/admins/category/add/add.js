//add category
$(document).on('click', '.btn-add', function (e) {
    e.preventDefault();
    var data = {
        'name': $('#nameCategory').val(),
        'parent': $('#parent_id_Category').val(),
        'status': $('#statusCategory').val()
    };
    $.ajax({
        type: "post",
        url: "/category/store",
        data: data,
        dataType: "json",
        success: function (response, textStatus, xhr) {
            $('#nameError').html("");
            $('#nameError').addClass('bg-danger');
            if (response.status == 400) {
                $('#nameError').html(response.name);
            } else {
                toastr.success(response.message)
                $('#addModal').modal('hide');
                // $categoryHtmlAdd = '';
                // $categoryHtmlAdd += `<tr>
                //         <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                //         <td id="name-`+ response.category.id + `" class="editname" data-url="/category/ajax/nameCategory/` + response.category.id + `" contenteditable='true'>` + response.category.name + `</td>`;
                // if (response.category.active == 0) {
                //     $categoryHtmlAdd += `<td id="fa-active-on-` + response.category.id + `" data-url="/category/ajax/activeCategory/` + response.category.id + `" class="activeCategory"><i class='fa fa-circle-o'></i></td>`
                // }
                // else { $categoryHtmlAdd += `<td id="fa-active-on-` + response.category.id + `" data-url="/category/ajax/activeCategory/` + response.category.id + `" class="activeCategory"><i class='fa fa-circle'></i></td>` };
                // $categoryHtmlAdd += `<td id="dateCategory-` + response.category.id + `">` + response.category.created_at + `</td>
                //         <td>
                //             <a><i data-url="/category/ajax/edit/`+ response.category.id + `" data-toggle="modal" data-target="#editModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i><i data-url="/category/ajax/delete/` + response.category.id + `" class="fa fa-times text-danger text delete-sweetalert"></i></a>
                //         </td>
                //     </tr>`;
                $('tbody').prepend(response.viewCategoryAdd);
                $('#addModal').find('input').val('');
            }
        },

        complete: function (xhr, textStatus) {
            if (xhr.status == 403) {
                toastr.error('Tài khoản này không có quyền truy cập');
            }
            $('#addModal').modal('hide');
        }

    });
});