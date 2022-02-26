//paginate
function loadCategoryData(page) {
    $.ajax({
        url: '?page=' + page,
        type: 'get',
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.html == "") {
                $('.ajax-load').html('<h4>Category not found.</h4>');
                window.end = true;
            } else {
                $('.ajax-load').hide();
                $('tbody').append(response.html);
            };
        },
    });
}
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() && window.end != true) {
        page++;
        loadCategoryData(page);
        //alert('aa');
    }
});