$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.add_store_ads').on('click', function () {
    var data = new FormData($('#addFormDataAds')[0]);
    $.ajax({
        type: "post",
        url: "Ads/store",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 500) {
                if (response.error.nameAdsAdd) {
                    $('#nameAdsAddError').html(response.error.nameAdsAdd);
                } else {
                    $('#nameAdsAddError').html('');
                }
                if (response.error.descriptionAdd) {
                    $('#descriptionAdsAddError').html(response.error.descriptionAdd);
                } else {
                    $('#descriptionAdsAddError').html('');
                }
                if (response.error.image_path_AdsAdd) {
                    $('#image_path_AdsError').html(response.error.image_path_AdsAdd);
                } else {
                    $('#image_path_AdsError').html('');
                }
            } else {
                $('#addAdsModal').modal('hide');
                $('#addAdsModal').find('input').val('');
                $('#addAdsModal').find('.ads_image').attr('src', 'web/images/quang-cao-facebook-1.jpg');
                fetchAds();
            }
        }
    });
});