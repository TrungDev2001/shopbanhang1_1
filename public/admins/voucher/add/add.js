$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.add_voucherr', function (e) {
    e.preventDefault();
    var dataVoucher = new FormData($('#dataVoucher')[0]);
    $.ajax({
        type: "post",
        url: "voucher/addVoucher",
        data: dataVoucher,
        contentType: false,
        processData: false,
        // dataType: "json",
        success: function (response) {
            //ẩn thông báo lỗi validator
            $('#nameVoucher').html('');
            $('#codeVoucher').hide();
            $('#typeVoucher').hide();
            $('#numberVoucher').hide();
            $('#quantityVoucher').hide();
            //ẩn modal khi add
            $('#addVoucherModal').modal('hide');
            //ẩn giá trị input khi vừa add
            $('.nameVoucher').val('');
            $('.codeVoucher').val('');
            $('.typeVoucher').val('');
            $('.numberVoucher').val('');
            $('.quantityVoucher').val('');
            //thêm voucher vừa add vào trang index
            var voucherNewHtml = '';
            voucherNewHtml += `<tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>`+ response.VoucherNew.name + `</td>
                <td>`+ response.VoucherNew.code + `</td>`;
            if (response.VoucherNew.type == 0) {
                voucherNewHtml += '<td>%</td>';
            } else {
                voucherNewHtml += '<td>vnd</td>';
            }
            if (response.VoucherNew.type == 0) {
                voucherNewHtml += `<td>` + response.VoucherNew.number + `%</td>`;
            } else {
                voucherNewHtml += `<td>` + (response.VoucherNew.number).toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&.') + `đ</td>`;
            }
            voucherNewHtml += `
                <td>`+ response.VoucherNew.quantity + `</td>
                <td>`+ response.VoucherNew.created_at.slice(0, 10) + `</td>
                <td>
                    <a>
                        <i data-url="products/edit/`+ response.VoucherNew.id + `" data-toggle="modal" data-target="#editProductModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
                        <i data-url="products/delete/`+ response.VoucherNew.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
                    </a>
                </td>
            </tr>`;
            $('tbody').prepend(voucherNewHtml);
            //thông báo
            showMessage(' Thêm voucher thành công');
        },
        error: function (data) {
            if (data.responseJSON.errors.nameVoucher) {
                $('#nameVoucher').html(data.responseJSON.errors.nameVoucher);
            } else {
                $('#nameVoucher').hide();
            }
            if (data.responseJSON.errors.codeVoucher) {
                $('#codeVoucher').html(data.responseJSON.errors.codeVoucher);
            } else {
                $('#codeVoucher').hide();
            }
            if (data.responseJSON.errors.typeVoucher) {
                $('#typeVoucher').html(data.responseJSON.errors.typeVoucher);
            } else {
                $('#typeVoucher').hide();
            }
            if (data.responseJSON.errors.numberVoucher) {
                $('#numberVoucher').html(data.responseJSON.errors.numberVoucher);
            } else {
                $('#numberVoucher').hide();
            }
            if (data.responseJSON.errors.quantityVoucher) {
                $('#quantityVoucher').html(data.responseJSON.errors.quantityVoucher);
            } else {
                $('#quantityVoucher').hide();
            }
        }
    });
});

