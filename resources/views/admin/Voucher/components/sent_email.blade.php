{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>P-Shopper</title>
</head>
<body>
    <h2>{{ $content_email['name'] }}</h2>
    <p>{{ $content_email['body'] }}</p>
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {
    font-family: Arial;
    }

    .coupon {
    border: 5px dotted #bbb;
    width: 80%;
    border-radius: 15px;
    margin: 0 auto;
    max-width: 600px;
    }

    .container {
    padding: 2px 16px;
    background-color: #f1f1f1;
    }

    .promo {
    background: #ccc;
    padding: 3px;
    }

    .expire {
    color: red;
    }
</style>
</head>
    <body>
        <div class="coupon">
            <div class="container">
                <h3>Website bán hàng TrungBui</h3>
            </div>
            {{-- <img src="{{ asset('web/images/mã-giảm-giá-banner.jpeg') }}" alt="Avatar" style="width:100%;"> --}}
            <div class="container" style="background-color:white">
                @if ($voucher->type == 0)
                    <h2><b>Giảm {{ $voucher->number }}% khi mua hàng</b></h2> 
                @else
                    <h2><b>Giảm {{ number_format($voucher->number, 0, ',', '.') }}đ khi mua hàng</b></h2> 
                @endif
                <p>Nhanh tay mua ngay, số lượng có hạn chỉ còn {{ $voucher->quantity }} vé.</p>
            </div>
            <div class="container">
                <p>Sử dụng ngay mã khuyến mại: <span class="promo">{{ $voucher->code }}</span></p>
                <p class="expire">Bắt đầu: {{ $voucher->date_start }} đến hết: {{ $voucher->date_end }}</p>
            </div>
        </div>
    </body>
</html> 
