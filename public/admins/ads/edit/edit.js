$(document).on('click', '.edit-form', function (e) {
    e.preventDefault();
    var url = $(this).attr('data-url');
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $('#nameAdsEdit').val(response.ads.name);
            $('#descriptionEdit').val(response.ads.description);
            $('#statusAdsEdit').val(response.ads.active);
            $('.ads_image').attr('src', response.ads.path_image_ads);
            $('.edit_store_ads').attr('data-url', 'Ads/update/' + response.ads.id);
        }
    });
});

$(document).on('click', '.edit_store_ads', function () {
    var url = $(this).attr('data-url');
    var data = new FormData($('#editFormDataAds')[0]);
    $.ajax({
        type: "post",
        url: url,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 500) {
                if (response.error.nameAdsEdit) {
                    $('#nameAdsEditError').html(response.error.nameAdsEdit);
                } else {
                    $('#nameAdsEditError').html('');
                }
                if (response.error.descriptionEdit) {
                    $('#descriptionAdsEditError').html(response.error.descriptionEdit);
                } else {
                    $('#descriptionAdsEditError').html('');
                }
            } else {
                $('#editAdsModal').modal('hide');
                fetchAds();
            }
        }
    });
});