function get_contact_customer() {
    var contact_customer_id = $(this).attr('data-contact_customer_id');
    $.ajax({
        type: "get",
        url: "/contact/fetch/" + contact_customer_id,
        success: function (response) {
            if (response.status == 200) {
                $('#email_customer').html(response.contact_customer.email_customer);
                $('#subject_customer').html(response.contact_customer.subject_customer);
                $('#content_customer').html(response.contact_customer.content_customer);
                $('.btn-reply').attr('data-contact_customer_id', response.contact_customer.id);
            }
        }
    });
}

function paginate(page) {
    console.log(page);
    $.ajax({
        type: "get",
        url: "/contact?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.status == 200 && page <= response.lastPage) {
                $('.ajax-load').hide();
                $('tbody').append(response.contact_customers_paginate_html);
            } else {
                $('.ajax-load').hide();
                $('.load-end').show();
                window.location.lastPage = true;
            }
        }
    });
}
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 0.3 > $(document).height() && window.location.lastPage != true) {
        page++;
        paginate(page);
    }
})

function form_reply_contact() {
    var data = new FormData($('#form_reply_contact')[0]);
    var contact_customer_id = $(this).attr('data-contact_customer_id');
    var url = '/contact/reply_contact/' + contact_customer_id;
    $.ajax({
        type: "post",
        url: url,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                $('.contact_customer_' + contact_customer_id).html('Đã trả lời');
                window.showMessage('Reply contact success');
            }
        },
        complete: function (xhr, textStatus) {
            if (xhr.status == 403) {
                toastr.error('Tài khoản này không có quyền truy cập');
            }
        }
    });
}
$(document).on('click', '.btn-model_contact_customer', get_contact_customer);
$(document).on('click', '.btn-reply', form_reply_contact);