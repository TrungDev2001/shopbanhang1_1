function edit() {
    var url_Edit_Update = $(this).attr('data-url');
    var url = $(this).attr('data-url_edit');
    $('.edit_voucher').attr('data-url', url_Edit_Update);

    $.ajax({
        type: "get",
        url: url,

        success: function (response) {
            if (response.status == 200) {
                $('.nameVoucherEdit').val(response.voucher.name);
                $('.descriptionEdit').val(response.voucher.description);
                $('.codeVoucherEdit').val(response.voucher.code);
                $('.numberVoucherEdit').val(response.voucher.number);
                $('.numberMaxVoucherEdit').val(response.voucher.numberMax);
                $('.quantityVoucherEdit').val(response.voucher.quantity);
                $('.dateStartVoucherEdit').val(response.voucher.date_start);
                $('.dateEndVoucherEdit').val(response.voucher.date_end);
                $('.quantity_use_user_VoucherEdit').val(response.voucher.quantity_use_of_user);
                $('.statusVoucherEdit').val(response.voucher.status);
                if (response.voucher.type == 0) {
                    $('.typeVoucherEdit0').prop('checked', true);
                } else {
                    $('.typeVoucherEdit1').prop('checked', true);
                }
                if (response.voucher.numberMax > 0) {
                    $('#numberMaxVoucherE').fadeIn(1000);
                }
            }
        }
    });
}

function edit_update_voucher() {
    var data = new FormData($('#dataVoucherFormEdit')[0]);
    var url = $(this).attr('data-url');
    $.ajax({
        type: "post",
        url: url,
        data: data,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status == 200) {
                // $('#editVoucherModallll').modal('hide');
                // console.log($('#editVoucherModallll').attr('data-url'));
                window.location.reload();
            }
        },
        error: function (data) {
            if (data.responseJSON.errors.nameVoucher) {
                $('#nameVoucherEdit').html(data.responseJSON.errors.nameVoucher);
            } else {
                $('#nameVoucherEdit').hide();
            }
            if (data.responseJSON.errors.codeVoucher) {
                $('#codeVoucherEdit').html(data.responseJSON.errors.codeVoucher);
            } else {
                $('#codeVoucherEdit').hide();
            }
            if (data.responseJSON.errors.typeVoucher) {
                $('#typeVoucherEdit').html(data.responseJSON.errors.typeVoucher);
            } else {
                $('#typeVoucherEdit').hide();
            }
            if (data.responseJSON.errors.numberVoucher) {
                $('#numberVoucherEdit').html(data.responseJSON.errors.numberVoucher);
            } else {
                $('#numberVoucherEdit').hide();
            }
            if (data.responseJSON.errors.quantityVoucher) {
                $('#quantityVoucherEdit').html(data.responseJSON.errors.quantityVoucher);
            } else {
                $('#quantityVoucherEdit').hide();
            }
            if (data.responseJSON.errors.dateStartVoucher) {
                $('#dateStartVoucherEdit').html(data.responseJSON.errors.dateStartVoucher);
            } else {
                $('#dateStartVoucherEdit').hide();
            }
            if (data.responseJSON.errors.dateEndVoucher) {
                $('#dateEndVoucherEdit').html(data.responseJSON.errors.dateEndVoucher);
            } else {
                $('#dateEndVoucherEdit').hide();
            }
        }
    });
}
$(document).on('click', '.edit-form', edit);
$(document).on('click', '.edit_voucher', edit_update_voucher);