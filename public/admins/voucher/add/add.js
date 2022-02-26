$(document).on('click', '.add_voucherr', function (e) {
    e.preventDefault();
    var dataVoucher = new FormData($('#dataVoucherForm')[0]);
    $.ajax({
        type: "post",
        url: "voucher/addVoucher",
        data: dataVoucher,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.code == 200) {
                console.log('aaaa');
                //ẩn thông báo lỗi validator
                $('#nameVoucher').html('');
                $('#codeVoucher').hide();
                $('#typeVoucher').hide();
                $('#numberVoucher').hide();
                $('#quantityVoucher').hide();
                //ẩn giá trị input khi vừa add
                $('.nameVoucher').val('');
                $('.codeVoucher').val('');
                $('.typeVoucher').val('');
                $('.numberVoucher').val('');
                $('.quantityVoucher').val('');
                $('tbody').prepend(response.VoucherNew);
                //ẩn modal khi add
                $('#addVoucherModal1').modal('hide');
                window.location.reload();
                //thông báo
                window.showMessage('Thêm voucher thành công');
            }
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
            if (data.responseJSON.errors.dateStartVoucher) {
                $('#dateStartVoucher').html(data.responseJSON.errors.dateStartVoucher);
            } else {
                $('#dateStartVoucher').hide();
            }
            if (data.responseJSON.errors.dateEndVoucher) {
                $('#dateEndVoucher').html(data.responseJSON.errors.dateEndVoucher);
            } else {
                $('#dateEndVoucher').hide();
            }
        }
    });
});



