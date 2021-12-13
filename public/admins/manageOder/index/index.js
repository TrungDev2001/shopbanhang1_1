$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// function fetchManageOder() {
//     $.ajax({
//         type: "get",
//         url: "manageOrder/petchDataOder",
//         success: function (response) {

//         }
//     });
// }
// fetchManageOder();

function loadoderData(page) {
    $.ajax({
        type: "get",
        url: "manageOrder/petchDataOder?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.oder.data == '') {
                $('.load-end').show();
                $('.ajax-load').hide();
                window.loadend = true;
            } else {
                $('.ajax-load').hide();
                $('.tbody').append(response.viewOderIndexHtml);
            }
        }
    });
}
var page = 1;
$(window).scroll(function () {
    if (($(window).scrollTop() + $(window).height()) >= $(document).height() && window.loadend != true) {
        page++;
        loadoderData(page);
    };
});