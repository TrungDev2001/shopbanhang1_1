function petchDataVoucher() {
    $.ajax({
        type: "get",
        url: "voucher/petchDataVoucher",
        success: function (response) {
            $('tbody').html('');
            var vouchersHtml = '';
            $.each(response.vouchers.data, function (key, item) {
                vouchersHtml += `<tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>`+ item.name + `</td>
                    <td>`+ item.code + `</td>`;
                if (item.type == 0) {
                    vouchersHtml += '<td>%</td>';
                } else {
                    vouchersHtml += '<td>vnd</td>';
                }
                if (item.type == 0) {
                    vouchersHtml += `<td>` + item.number + `%</td>`;
                } else {
                    vouchersHtml += `<td>` + (item.number).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.') + `đ</td>`;
                }
                vouchersHtml += `
                    <td>`+ item.quantity + `</td>
                    <td>`+ item.created_at.slice(0, 10) + `</td>
                    <td>
                        <a>
                            <i data-url="voucher/edit/`+ item.id + `" data-toggle="modal" data-target="#editProductModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
                            <i data-url="voucher/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
                        </a>
                    </td>
                </tr>`;
            });
            $('tbody').prepend(vouchersHtml);
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
            if (response.vouchers.data != '') {
                $('.ajax-load').hide();
                var vouchersHtml = '';
                $.each(response.vouchers.data, function (key, item) {
                    vouchersHtml += `<tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>`+ item.name + `</td>
                    <td>`+ item.code + `</td>`;
                    if (item.type == 0) {
                        vouchersHtml += '<td>%</td>';
                    } else {
                        vouchersHtml += '<td>vnd</td>';
                    }
                    if (item.type == 0) {
                        vouchersHtml += `<td>` + item.number + `%</td>`;
                    } else {
                        vouchersHtml += `<td>` + (item.number).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.') + `đ</td>`;
                    }
                    vouchersHtml += `
                    <td>`+ item.quantity + `</td>
                    <td>`+ item.created_at.slice(0, 10) + `</td>
                    <td>
                        <a>
                            <i data-url="voucher/edit/`+ item.id + `" data-toggle="modal" data-target="#editProductModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
                            <i data-url="voucher/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
                        </a>
                    </td>
                </tr>`;
                });
                $('tbody').append(vouchersHtml);
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
