function fetchBrand() {
    $.ajax({
        type: "GET",
        url: "/brands/fetchBrands",
        beforeSend: function () {
            $('#ajax-load').show();
        },
        success: function (response) {
            $('#ajax-load').hide();
            $('tbody').html('');
            $('tbody').append(response.viewDataBrand);
            $('#parent_id_CategoryAdd').html(response.htmlOption);
            $('#parent_id_CategoryEdit').html(response.htmlOption);
        }
    });
};
fetchBrand();

function loadBrandsDate(page) {
    $.ajax({
        type: "get",
        url: "/brands/fetchBrands?page=" + page,
        success: function (response) {
            if (response.viewDataBrand == "") {
                $('#ajax-load').html('<h2>End</h2>');
                window.loadEnd = true;
            } else {
                $('tbody').append(response.viewDataBrand);
            }
        }
    });
}

var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() && window.loadEnd != true) {
        page++;
        loadBrandsDate(page);
    }
});

//show brand
$(document).on('click', '.view-brand', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $('#showName').html(response.brand.name);
            $('#showDescription').html(response.brand.description);
            if (response.brand.active == 0) {
                $('#showStatus').html('Hoạt động');
            } else {
                $('#showStatus').html('Không hoạt động');
            }
            $('#showDatecreated').html(response.brand.created_at);
            $('#showDateupdate').html(response.brand.updated_at);
        }
    });
});