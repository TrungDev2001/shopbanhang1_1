function editPost() {
    var url = $(this).attr('data-url');
    console.log(url);
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $('tbody').html(response.htmlPost);
        }
    });
}

$(document).on('click', '.edit-form', editPost)