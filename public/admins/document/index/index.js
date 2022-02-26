function getDataPaginate(page) {
    $.ajax({
        type: "get",
        url: "/document/paginate-document-ggDriver?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.status == 200) {
                if (page <= response.lastPage) {
                    $('.ajax-load').fadeOut();
                    $('tbody').html(response.html_dataDocument);
                } else {
                    window.endLoadProduct = true;
                    $('.load-end').show();
                    $('.ajax-load').fadeOut();
                }
            }
        }
    });
}

$(document).on('click', '.forPage', getDataPaginate);

var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 2 >= $(document).height() && window.endLoadProduct != true) {
        page++;
        getDataPaginate(page);
    }
});