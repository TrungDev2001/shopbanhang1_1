function fetchImages() {
    $product_id = $('#table').attr('data-id');
    var origin = window.location.origin + "/products/edit_cover/" + $product_id;
    $.ajax({
        type: "get",
        url: $product_id,
        success: function (response) {
            $('#tablecontents').html(response.htmlImage);
        }
    });
}
// $(document).on('click', '.editImageDetail', fetchImages);

$(document).on('change', '#addImageDetail', function () {
    var product_id = $('#table').attr('data-id');
    var file = $(this)[0].files[0];
    var formdata1 = new FormData($('#addImageDetailForm')[0]);
    console.log(formdata1);
    if (file) {
        $.ajax({
            type: "post",
            url: '/products/addImageDetail/' + product_id,
            data: formdata1,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 200) {
                    fetchImages();
                    window.showMessage('Add image success');
                }
            }
        });
    }
});
