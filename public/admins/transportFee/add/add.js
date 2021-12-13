function fetchQuanHuyen() {
    var matp = $('.thanhpho').val();
    var maqh = $('.quanhuyen').val();
    var type = $(this).attr('id');
    $.ajax({
        type: "get",
        url: "transport_fee/create",
        data: {
            matp: matp,
            maqh: maqh,
            type: type,
        },
        success: function (response) {
            var html = '<option value="">Chọn</option>';
            $.each(response.data, function (index, item) {
                if (type == 'tp') {
                    html += `<option value="` + item.maqh + `">` + item.name + `</option>`
                } else {
                    html += `<option value="` + item.xaid + `">` + item.name + `</option>`
                }
            });
            if (type == 'tp') {
                $('.quanhuyen').html(html);
            } else {
                $('.xaphuong').html(html);
            }
        }
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function add_TransportFee() {
    var data = new FormData($('#dataTransportFree')[0]);
    $.ajax({
        type: "post",
        url: "transport_fee/store",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 400) {
                if (response.errors.thanhpho) {
                    $('#error_thanhPho').html(response.errors.thanhpho);
                } else {
                    $('#error_thanhPho').html('');
                }
                if (response.errors.quanhuyen) {
                    $('#error_quanhuyen').html(response.errors.quanhuyen);
                } else {
                    $('#error_quanhuyen').html('');
                }
                if (response.errors.xaphuong) {
                    $('#error_xaphuong').html(response.errors.xaphuong);
                } else {
                    $('#error_xaphuong').html('');
                }
                if (response.errors.numberTransportFree) {
                    $('#phivanchuyen').html(response.errors.numberTransportFree);
                } else {
                    $('#phivanchuyen').html('');
                }
            } else {
                $('#addTransportFreeModal').modal('hide');
                $('.thanhpho').val('');
                $('.quanhuyen').val('');
                $('.xaphuong').val('');
                $('.numberTransportFree').val('')
                petchDataTransportFee();
            }
        }
    });
}

$(document).on('change', '.choose', fetchQuanHuyen);
$(document).on('click', '.add_TransportFee', add_TransportFee);