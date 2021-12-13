function loadPaginateVideo(page) {
    $.ajax({
        type: "get",
        url: "Video?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.videoLoadPaginate != '') {
                $('.ajax-load').hide();
                $('tbody').append(response.videoLoadPaginate);
            } else {
                $('.ajax-load').hide();
                window.laodEnd = true;
                $('.load-end').show();
            }
        }
    });
}
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 0.3 >= $(document).height() && window.laodEnd != true) {
        page++;
        loadPaginateVideo(page);
    };
});
