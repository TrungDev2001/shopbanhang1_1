function fetchProduct() {
    $.ajax({
        type: "get",
        url: "products/fetchProduct",
        success: function (response) {
            $('tbody').html('');
            var productsHtml = '';
            // $.each(response.products.data, function (key, item) {
            //     productsHtml += `<tr>
            //         <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            //         <td>`+ item.name + `</td>
            //         <td>`+ item.price + `</td>`;
            //     if (item.active == 0) {
            //         productsHtml += `<td data-url="" id="" class=""><i class='fa fa-circle'></i></td>`;
            //     } else {
            //         productsHtml += `<td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>`;
            //     }
            //     productsHtml += `
            //         <td><img style="height: 100px; object-fit: cover;" class="file-upload" src="`+ item.feature_image_path + `" alt=""></td>
            //         <td>`+ item.created_at.slice(0, 10) + `</td>
            //         <td>
            //             <a>
            //                 <i data-url="products/edit/`+ item.id + `" data-toggle="modal" data-target="#editProductModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
            //                 <i data-url="products/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
            //             </a>
            //         </td>
            //     </tr>`;
            // });
            $('tbody').prepend(response.html);
        }
    });
}
fetchProduct()

function loadProductData(page) {
    $.ajax({
        type: "get",
        url: "products/fetchProduct?page=" + page,
        beforeSend: function () {
            $('.ajax-load').show();
        },
        success: function (response) {
            if (response.html == '') {
                $('.ajax-load').hide();
                $('.load-end').show();
                window.endLoadProduct = true;
            } else {
                $('.ajax-load').hide();
                // var productsHtmlPage = '';
                // $.each(response.products.data, function (key, item) {
                //     productsHtmlPage += `<tr tr >
                //     <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                //         <td>`+ item.name + `</td>
                //         <td>`+ item.price + `</td>`;
                //     if (item.active == 0) {
                //         productsHtmlPage += `<td data-url="" id="" class=""><i class='fa fa-circle'></i></td>`;
                //     } else {
                //         productsHtmlPage += `<td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>`;
                //     }
                //     productsHtmlPage += `
                //         <td><img class="file-upload" src="`+ item.feature_image_path + `" alt=""></td>
                //             <td>`+ item.created_at + `</td>
                //             <td>
                //                 <a href="" ui-toggle-class="">
                //                     <i data-url="products/edit/`+ item.id + `" data-toggle="modal" data-target="#editProductModal" class="fa fa-pencil-square-o text-success text-active edit-form "></i>
                //                     <i data-url="products/delete/`+ item.id + `" class="fa fa-times text-danger text delete-sweetalert"></i>
                //                 </a>
                //             </td>
                //     </tr>`;
                // });
                $('tbody').append(response.html);
            }
        }
    });
};
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() + 2 >= $(document).height() && window.endLoadProduct != true) {
        page++;
        loadProductData(page);
    }
});
