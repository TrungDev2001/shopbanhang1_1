$(document).on('click', '.ShowOder', function () {
    var url = $(this).attr('data-url');
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $('#nameKH').html(response.userKH.name);
            $('#emailKH').html(response.userKH.email);
            $('#phoneKH').html(response.userKH.phone);
            $('#nameVC').html(response.oder.name);
            $('#phoneVC').html(response.oder.phone);
            $('#addressVC').html(response.address);
            $('#notesVC').html(response.oder.notes);

            $html_dataOderDetail = '';
            $.each(response.oder_detail, function (keyOd, item) {
                $('.modal-footerr').html(`<button type="button" class="btn btn-danger"><a class="print_oder" data-url="/manageOrder/print/` + item.id + `">Print</a></button>`);
                var $count = keyOd + 1;
                $html_dataOderDetail +=
                    `<tr>
                        <th scope="row">`+ $count + `</th>
                        <td>` + item.product_id + `</td>
                        <td><img class="anhgh" src="`+ item.image_path + `" alt=""></td>
                        <td>` + item.name + `</td>
                        <td><p class="quantity">` + item.quantity + `</p></td>
                        <td>` + (item.price).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.').slice(0, (item.price).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,').lastIndexOf('.0')) + `đ</td>
                        <td>` + (item.price * item.quantity).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.').slice(0, (item.price * item.quantity).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,').lastIndexOf('.0')) + `đ</td>
                    </tr>`;
            });
            $("#dataOderDetail").html($html_dataOderDetail);

            $('#totalPriceProduct').html((response.oder.total_price).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.').slice(0, (response.oder.total_price).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,').lastIndexOf('.0')));
            $('#priceVoucher').html((response.priceVoucher).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.').slice(0, (response.priceVoucher).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,').lastIndexOf('.0')));
            $('#nameVoucher').html(response.nameVoucher);
            $('#priceShip').html((response.oder.priceShip).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.').slice(0, (response.oder.priceShip).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.').lastIndexOf('.0')));
            $('#totalPriceBuild').html((response.oder.total_price + response.oder.priceShip - response.priceVoucher).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.').slice(0, (response.oder.total_price + response.oder.priceShip - response.priceVoucher).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,').lastIndexOf('.0')));
            $('#statusOder').val(response.oder.active);
            $('#statusOder').attr('data-id', response.oder.id);
        }
    });
});

function updateStatusOder() {
    var Oder_id = $(this).attr('data-id');
    var statusOder = $(this).val();
    var origin = window.location.origin;
    var url = origin + '/manageOrder/update/' + Oder_id;
    console.log(url);
    $.ajax({
        type: "post",
        url: url,
        data: {
            statusOder: statusOder,
        },
        success: function (response) {
            if (response.status == 200) {
                window.showMessage('Cập nhập trạng thái đơn hàng thành công');
                window.location.reload();
            } else {
                window.showMessageError('Cập nhập trạng thái đơn hàng không thành công');
            }
        }
    });
}
$(document).on('change', '#statusOder', updateStatusOder)