$(document).on('click', '.delete-sweetalert', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    var that = $(this);
    console.log(url);
    Swal.fire({
        title: 'Delete!',
        text: "Bạn có chắc muốn xóa.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "delete",
                url: url,
                success: function (response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Deleted!',
                            'Đã xóa thành công',
                            'success'
                        );
                        that.parent().parent().parent().remove();
                    }
                },
                complete: function (xhr, textStatus) {
                    if (xhr.status == 403) {
                        toastr.error('Tài khoản này không có quyền truy cập');
                    } else if (xhr.status == 500) {
                        toastr.error('Lỗi máy chủ nội bộ');
                    }
                }
            });
        }
    })
});