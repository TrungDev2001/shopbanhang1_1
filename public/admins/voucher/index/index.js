function petchDataVoucher() {
    $.ajax({
        type: "get",
        url: "voucher/petchDataVoucher",
        success: function (response) {
            $('tbody').html('');
            var vouchersHtml = '';
            // $.each(response.vouchers.data, function (key, item) {
            //     vouchersHtml += `<tr>
            //         <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            //         <td>`+ item.name + `</td>
            //         <td>`+ item.code + `</td>`;
            //     if (item.type == 0) {
            //         vouchersHtml += '<td>%</td>';
            //     } else {
            //         vouchersHtml += '<td>vnd</td>';
            //     }
            //     if (item.type == 0) {
            //         vouchersHtml += `<td>` + item.number + `%</td>`;
            //     } else {
            //         vouchersHtml += `<td>` + (item.number).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.') + `đ</td>`;
            //     }
            //     vouchersHtml += `<td>` + item.quantity + `</td>`;
            //     vouchersHtml += `
            //         <td>`+ item.created_at.slice(0, 10) + `</td>
            //         <td>`+ item.created_at.slice(0, 10) + `</td>`;
            //     vouchersHtml += `<td>Còn hạn</td>`;
            //     if (item.status == 0) {
            //         vouchersHtml += `<td style="color: green;">Đang kích hoạt</td>`;
            //     } else {
            //         vouchersHtml += `<td style="color: red;">Chưa kích hoạt</td>`;
            //     }
            //     vouchersHtml += `
            //         <td>
            //             <a>
            //                 <i data-url="voucher/edit/`+ item.id + `" data-toggle="modal" data-target="#editProductModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
            //                 <i data-url="voucher/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
            //             </a>
            //         </td>
            //     </tr>`;
            // });
            $('tbody').prepend(response.html_dataVoucher);
        }
    });
}
petchDataVoucher();


function petchDataVoucherPaginate(page) {
    $.ajax({
        type: "get",
        url: "voucher/petchDataVoucher?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.html_dataVoucher != '') {
                $('.ajax-load').hide();
                $('tbody').append(response.html_dataVoucher);
            } else {
                $('.ajax-load').hide();
                $('.load-end').show();
                return window.EndPaginate = true;
            }
        }
    });
}
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 0.3 >= $(document).height() && window.EndPaginate != true) {
        page++;
        petchDataVoucherPaginate(page);
    }
});

function giftKHvip() {
    var voucher_id = $(this).attr('data-voucher_id');
    var type = $(this).attr('data-type');
    $.ajax({
        type: "post",
        url: "voucher/send-gift-KH-vip/" + voucher_id,
        data: { type: type },
        beforeSend: function () {
            if (type == 'KHvip') {
                $('.loaderGif' + voucher_id).show();
                $('.giftKHvip' + voucher_id).html('Loading');
            } else {
                $('.loaderGifthuong' + voucher_id).show();
                $('.giftKHthuong' + voucher_id).html('Loading');
            }
        },
        success: function (response) {
            if (type == 'KHvip') {
                $('.loaderGif' + voucher_id).hide();
                $('.giftKHvip' + voucher_id).html('Gift KH vip ');
            } else {
                $('.loaderGifthuong' + voucher_id).hide();
                $('.giftKHthuong' + voucher_id).html('Gift KH thường ');
            }

            if (response.status == 200) {
                window.showMessage('Succsess');
            } else {
                window.showMessageError('Error');
            }
        }
    });
}
$(document).on('click', '.giftKHvip', giftKHvip);
