function petchDataTransportFee() {
    $.ajax({
        type: "get",
        url: "transport_fee/petchDataTransportFee",
        success: function (response) {
            // $('tbody').html('');
            $('tbody').html(response.viewDataTransportFee);
        }
    });
}

function petchDataTransportFeePaginate(page) {
    $.ajax({
        type: "get",
        url: "transport_fee/petchDataTransportFee?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.html != '') {
                $('.ajax-load').hide();
                $('tbody').append(response.viewDataTransportFee);
            } else {
                $('.ajax-load').hide();
                $('.load-end').show();
                window.loatEnd = true;
            }
        }
    });
}
var page = 1;

$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 0.3 >= $(document).height() && window.loatEnd != true) {
        page++;
        petchDataTransportFeePaginate(page);
    };
});

petchDataTransportFee();

