//$(document).ready(function () {
//lấy data
function petchSlider() {
    $.ajax({
        type: "get",
        url: "sliders/petchSlider",
        success: function (response) {
            $('tbody').html('');
            $('tbody').prepend(response.viewDataSlider);
        }
    });
}
petchSlider();
//panigate
function loadSliderdata(page) {
    $.ajax({
        type: "get",
        url: "sliders/petchSlider?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.viewDataSlider == '') {
                $('.ajax-load').html('<h4>End.</h4>');
                window.loadEnd = true;
            } else {
                $('.ajax-load').hide();
                $('tbody').append(response.viewDataSlider);
            }
        }
    });
}
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 0.28 >= $(document).height() && window.loadEnd != true) {
        page++;
        loadSliderdata(page);
    }
});
//});