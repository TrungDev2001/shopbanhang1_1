$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function editPriceShipp() {
    var PriceShip = $(this).text();
    var test = PriceShip.replace(".", "").replace("đ", "");
    var url = $(this).attr('data_url');
    $.ajax({
        type: "post",
        url: url,
        data: { PriceShip: test },
        success: function (response) {
            petchDataTransportFee();
            showMessage('Cập nhập thành công.');
        }
    });
}
$(document).on('blur', '.editPriceShip', editPriceShipp);