function editCategoryPost(e) {
    var url = $(this).attr('data-url');
    e.preventDefault();
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $('#nameCategoryPostEdit').val(response.categoryPost.name);
            $('#slugCategoryPostEdit').val(response.categoryPost.slug);
            $('#descriptionCategoryPostEdit').val(response.categoryPost.description);
            $('#statusCategoryPostEdit').val(response.categoryPost.action);
            $('.edit-update').attr('data-url', 'CategoryPost/update/' + response.categoryPost.id)
        }
    });
}
function updateEditCategoryPost() {
    var url = $(this).attr('data-url');
    var data = new FormData($('#editCategoryPost')[0]);
    console.log(data);
    $.ajax({
        type: "post",
        url: url,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                $('#editModal').modal('hide');
                showMessage('Edit success');
                window.location.reload();
            }
        }
    });
}

$(document).on('click', '.edit-form', editCategoryPost);
$(document).on('click', '.edit-update', updateEditCategoryPost);

function ChangeToSlug2() {
    var title, slug;

    //Lấy text từ thẻ input title 
    title = document.getElementById("nameCategoryPostEdit").value;

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('slugCategoryPostEdit').value = slug;
}