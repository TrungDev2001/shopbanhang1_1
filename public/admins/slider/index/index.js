//$(document).ready(function () {
//lấy data
function petchSlider() {
    $.ajax({
        type: "get",
        url: "sliders/petchSlider",
        success: function (response) {
            $('tbody').html('');
            var slidersHtml = '';
            $.each(response.sliders.data, function (key, item) {
                slidersHtml += `<tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>`+ item.name + `</td>
                        <td>`+ item.description + `</td>`;
                if (item.active == 0) {
                    slidersHtml += `<td data-url="" id="" class=""><i class='fa fa-circle'></i></td>`;
                } else {
                    slidersHtml += `<td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>`;
                }

                slidersHtml += `
                        <td><img class="file-upload" src="`+ item.image_path_Sider + `" alt=""></td>
                        <td>`+ item.created_at + `</td>
                        <td>
                            <a href="" ui-toggle-class="">
                                <i data-url="sliders/edit/`+ item.id + `" data-toggle="modal" data-target="#editSliderModal" class="fa fa-pencil-square-o text-success text-active edit-form "></i>
                                <i data-url="sliders/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
                            </a>
                        </td>
                    </tr>`;
            });
            $('tbody').prepend(slidersHtml);
        }
    });
}
petchSlider();
//panigate
function loadSliderdata(page) {
    $.ajax({
        type: "get",
        url: "sliders/petchSlider?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.sliders.data == '') {
                $('.ajax-load').html('<h4>End.</h4>');
                return;
            } else {
                $('.ajax-load').hide();
                var slidersHtmlPage = '';
                $.each(response.sliders.data, function (key, item) {
                    slidersHtmlPage += `<tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>`+ item.name + `</td>
                            <td>`+ item.description + `</td>`;
                    if (item.active == 0) {
                        slidersHtmlPage += `<td data-url="" id="" class=""><i class='fa fa-circle'></i></td>`;
                    } else {
                        slidersHtmlPage += `<td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>`;
                    }
                    slidersHtmlPage += `
                            <td><img src="`+ item.image_path_Sider + `" alt=""></td>
                            <td>`+ item.created_at + `</td>
                            <td>
                                <a href="" ui-toggle-class="">
                                    <i data-url="sliders/edit/`+ item.id + `" data-toggle="modal" data-target="#editSliderModal" class="fa fa-pencil-square-o text-success text-active edit-form "></i>
                                    <i data-url="sliders/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
                                </a>
                            </td>
                        </tr>`;
                });
                $('tbody').append(slidersHtmlPage);
            }
        }
    });
}
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 0.28 >= $(document).height()) {
        page++;
        loadSliderdata(page);
    }
});
//});