//$(function () {
$("#select2insidemodal").select2({
    tags: true,
    tokenSeparators: [','],
})
$("#parent_id_Category").select2({
    placeholder: "Chọn category",
    allowClear: true
});
$("#Category_brands").select2({
    placeholder: "Chọn brand",
    allowClear: true
});
//})
$(document).on('change', '#parent_id_Category', function () {
    var category_id = $(this).val();
    $.ajax({
        type: "get",
        url: "products/categoryBrands",
        data: category_id,
        dataType: "html",
        success: function (response) {
            $('#Category_brands').html(response);
        }
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.add-btn', function () {
    $('.avatar1').attr('src', 'web/images/85090667-product-word-cloud-collage-business-concept-background.jpg');
});
$(document).on('click', '.add-store', function (e) {
    e.preventDefault();
    var dataForm = new FormData($('#productAdd')[0]);
    var tag = $('#select2insidemodal').val();
    console.log(tag);
    // var content = CKEDITOR.instances.my_editor.getData();
    // var contentHtml = JSON.stringify({ 'content': content });
    // console.log(content);
    // $.ajax({
    //     type: "post",
    //     url: "products/store",
    //     data: contentHtml,
    //     dataType: 'json',
    //     contentType: "application/json; charset=utf-8",
    //     success: function (response) {

    //     }
    // });
    $.ajax({
        type: "post",
        url: "products/store",
        data: dataForm,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 500) {
                if (response.errors.nameAdd) {
                    $('#nameAddError').html(response.errors.nameAdd);
                } else {
                    $('#nameAddError').html('');
                }
                if (response.errors.priceAdd) {
                    $('#priceAddError').html(response.errors.priceAdd);
                } else {
                    $('#priceAddError').html('');
                }
                if (response.errors.descriptionAdd) {
                    $('#descriptionAddError').html(response.errors.descriptionAdd);
                } else {
                    $('#descriptionAddError').html('');
                }
                if (response.errors.statusAdd) {
                    $('#statusAddError').html(response.errors.statusAdd);
                } else {
                    $('#statusAddError').html('');
                }
                if (response.errors.image_AvatarAdd) {
                    $('#image_AvatarAddError').html(response.errors.image_AvatarAdd);
                } else {
                    $('#image_AvatarAddError').html('');
                }
                if (response.errors.image_DetailAdd) {
                    $('#image_DetailAddError').html(response.errors.image_DetailAdd);
                } else {
                    $('#image_DetailAddError').html('');
                }
                if (response.errors.contentAdd) {
                    $('#contentAddError').html(response.errors.contentAdd);
                } else {
                    $('#contentAddError').html('');
                }
                if (response.errors.tagsProductAdd) {
                    $('#tagsProductAddError').html(response.errors.tagsProductAdd);
                } else {
                    $('#tagsProductAddError').html('');
                }
                if (response.errors.id_CategoryAdd) {
                    $('#id_CategoryAddError').html(response.errors.id_CategoryAdd);

                } else {
                    $('#id_CategoryAddError').html('');
                }
                if (response.errors.Category_brandsAdd) {
                    $('#Category_brandsAddError').html(response.errors.Category_brandsAdd);
                } else {
                    $('#Category_brandsAddError').html('');
                }
            }
            if (response.status == 200) {

                $('#addProductModal').modal('hide');
                fetchProduct();
                toastr.success(response.message);
                $('#addProductModal').find('input').val('');
                $('#addProductModal').find('textarea').val('');
                $('.avatar1').attr('src', 'web/images/85090667-product-word-cloud-collage-business-concept-background.jpg');
                $('#addProductModal').find('select').val('');
            }
        }
    });
});



