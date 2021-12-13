function loadPaginatePost(page) {
    $.ajax({
        type: "get",
        url: "Post?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.LoadPaginatePostHtml == "") {
                $('.ajax-load').hide();
                $('.load-end').show();
                window.LoadPaginatePostHtml = true;
            } else {
                $('.ajax-load').hide();
                $('tbody').append(response.LoadPaginatePostHtml);
            }
        }
    });
}
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() && window.LoadPaginatePostHtml != true) {
        page++;
        loadPaginatePost(page);
    }
});
