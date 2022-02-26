$("#select2modal").select2({
    tags: true,
    tokenSeparators: [','],
})
$("#id_Category_edit").select2({
    placeholder: "Chọn category",
    allowClear: true
});
$("#Category_brands_edit").select2({
    placeholder: "Chọn brand",
    allowClear: true
});

$(document).on('click', '.edit-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    //console.log(url);
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $('#nameEdit').val(response.product.name);
            $('#priceEdit').val(response.product.price);
            $('#descriptionEdit').val(response.product.description);
            $('#statusEdit').val(response.product.active);
            $('.avatar1').attr('src', response.product.feature_image_path);
            $('.imageDetail').html(response.htmlImage);
            $('#contentEdit1').val(response.product.content);
            $('#select2modal').html(response.htmltags);
            $('#id_Category_edit').val(response.product.category_id).trigger('change');
            $('#Category_brands_edit').val(response.product.brand_id).trigger('change');
            $('.Edit-update').attr('data-url', 'products/update/' + response.product.id);
        }
    });
});

$(document).on('click', '.Edit-update', function () {
    var url = $(this).attr('data-url');
    var dataFormEdit = new FormData($('#productEdit')[0]);
    $.ajax({
        type: "post",
        url: url,
        data: dataFormEdit,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#editProductModal').modal('hide');
            toastr.success(response.message);
            fetchProduct();
        }
    });
});

function editDocument() {
    var product_id = $('#table').attr('data-id');
    $.ajax({
        type: "get",
        url: "editDocument/" + product_id,
        beforeSend: function () {

        },
        success: function (response) {
            if (response.status == 200) {
                $('#tablecontents_document').html(response.html_dataDocument);
            }
        }
    });
}

function download_document() {
    var url = $(this).attr('data-url');
    var name = $(this).attr('data-name');
    var mimetype = $(this).attr('data-mimetype');
    $.ajax({
        type: "get",
        url: url,
        data: { name: name, mimetype: mimetype },
        success: function (response) {
            toastr.success('Downloading');
        }
    });
}

function add_document() {
    var data = new FormData($('#addDocumentForm')[0]);
    var product_id = $('#table').attr('data-id');
    $.ajax({
        type: "post",
        url: "add-document/" + product_id,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                editDocument();
                window.showMessage('Add document success');
            } else {
                window.showMessageError('Add document error');
            }
        }
    });
}

$(document).on('click', '.editDocument', editDocument);
$(document).on('click', '.download_document', download_document);
$(document).on('change', '#addDocumentInput', add_document);