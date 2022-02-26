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
        },
        complete: function (xhr, textStatus) {
            if (xhr.status == 403) {
                toastr.error('Tài khoản này không có quyền truy cập');
            }
        }
    });
}
$(document).on('blur', '.editPriceShip', editPriceShipp);