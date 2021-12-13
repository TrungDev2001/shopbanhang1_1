function add(e) {
    e.preventDefault();
    var data = new FormData($('#addCategoryPost')[0]);
    var error = $('.form-error').text();

    $.ajax({
        type: "post",
        url: "CategoryPost/store",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                $('#addModal').modal('hide');
                $('.nameCategoryPost').val('');
                $('.slugCategoryPost').val('');
                $('.descriptionCategoryPost').val('');
                window.location.reload();
            } else {
                $.each(response.errors, function (index, item) {
                    $('.errors').append(`<li style="color: red">` + item + `</li>`);
                });
            }
        }
    });

}
$(document).on('click', '.btn-addd', add);


