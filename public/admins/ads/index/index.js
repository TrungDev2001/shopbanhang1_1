
function fetchAds() {
    $.ajax({
        type: "get",
        url: "Ads/fetchAds",
        success: function (response) {
            $('tbody').html('');
            var adssHtmlLoadPage = '';
            $.each(response.adss.data, function (key, item) {
                adssHtmlLoadPage += `<tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>`+ item.name + `</td>
                        <td>`+ item.description + `</td>`;
                if (item.active == 0) {
                    adssHtmlLoadPage += `<td data-url="" id="" class=""><i class='fa fa-circle'></i></td>`;
                } else {
                    adssHtmlLoadPage += `<td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>`;
                }

                adssHtmlLoadPage += `
                        <td><img class="file-upload" src="`+ item.path_image_ads + `" alt=""></td>
                        <td>`+ item.created_at.slice(0, 10) + `</td>
                        <td>
                            <a>
                                <i data-url="Ads/edit/`+ item.id + `" data-toggle="modal" data-target="#editAdsModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
                                <i data-url="Ads/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
                            </a>
                        </td>
                    </tr>`;
            });
            $('tbody').prepend(adssHtmlLoadPage);
        }
    });
}
fetchAds();

function loadAdsData(page) {
    $.ajax({
        type: "get",
        url: "Ads/fetchAds?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.adss.data == '') {
                $('.load-end').show();
                $('.ajax-load').hide();
            } else {
                $('.ajax-load').hide();
                var adssHtmlLoadPage = '';
                $.each(response.adss.data, function (key, item) {
                    adssHtmlLoadPage += `<tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>`+ item.name + `</td>
                        <td>`+ item.description + `</td>`;
                    if (item.active == 0) {
                        adssHtmlLoadPage += `<td data-url="" id="" class=""><i class='fa fa-circle'></i></td>`;
                    } else {
                        adssHtmlLoadPage += `<td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>`;
                    }

                    adssHtmlLoadPage += `
                        <td><img class="file-upload" src="`+ item.path_image_ads + `" alt=""></td>
                        <td>`+ item.created_at.slice(0, 10) + `</td>
                        <td>
                            <a href="" ui-toggle-class="">
                                <i data-url="Ads/edit/`+ item.id + `" data-toggle="modal" data-target="#editAdsModal" class="fa fa-pencil-square-o text-success text-active edit-form "></i>
                                <i data-url="Ads/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
                            </a>
                        </td>
                    </tr>`;
                });
                $('tbody').append(adssHtmlLoadPage);
            }
        }
    });
}
var page = 1;
$(window).scroll(function () {
    if (($(window).scrollTop() + $(window).height()) + 0.3 >= $(document).height()) {
        page++;
        loadAdsData(page);
    };
});