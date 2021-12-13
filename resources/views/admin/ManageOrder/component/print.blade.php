<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" media="print" href="admins/manageOder/print/print.css" />
    
    <style type = "text/css">
            body{
                font-family: DejaVu Sans;
            }
            /* .info_KH_VC {
                display: flex;
                justify-content: space-around;
            } */
            .anhgh {
                height: 100px;
                object-fit: cover;
            }
            .thead-dark tr th {
                border: 1px solid
            }
            #dataOderDetail > tr > td {
                border: 1px solid
            }
            #dataOderDetail > tr > th {
                border: 1px solid
            }
    </style>
</head>
<body>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <h3 style="text-align: center;">Chi tiết đơn hàng</h3>
            <div class="info_KH_VC">
                <div>
                    <h4>Thông tin khách hàng</h4>
                    <p>Tên: {{ $userKH->name }}</p>
                    <p>Email: {{ $userKH->email }}</p>
                    <p>Phone: {{ $userKH->phone }}</p>
                </div>
                <div>
                    <h4>Thông tin vận chuyển</h4>
                    <p>Tên: {{ $oder->name }}</p>
                    <p>Địa chỉ: {{ $address }}</p>
                    <p>Số điện thoại: {{ $oder->phone }}</p>   
                    <p>Ghi chú: {{ $oder->notes }}</p>   
                </div>
            </div>
            <table class="table" style="border: 1px solid">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="color: red">#</th>
                        <th scope="col" >Mã Sp</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Tổng</th>
                    </tr>
                    <tbody id="dataOderDetail">
                            @php
                                $tt = 0;
                            @endphp
                        @foreach ($oder_detail as $item)
                            @php
                                $tt++;
                            @endphp
                            <tr>
                                <th scope="row">{{ $tt }}</th>
                                <td>{{ $item->product_id }}</td>
                                <td><img class="anhgh" src="{{ $item->image_path }}" alt=""></td>
                                <td>{{ $item->name }}</td>
                                <td><p class="quantity">{{ $item->quantity }}</p></td>
                                <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
            
            <div>
                <table>
                    <tr>
                        <th width="1200px">
                            <p>Tổng tiền hàng: {{ number_format($oder->total_price, 0, ',', '.') }}</span>đ</p>
                            <p>Tổng tiền mã giảm giá: <span>{{ number_format($priceVoucher, 0, ',', '.') }}</span>đ (<span>{{ $nameVoucher }}</span>)</p>
                            <p>Phí vận chuyển: {{ number_format($oder->priceShip, 0, ',', '.') }}đ</p>
                            <p>Thành tiền: {{ number_format($oder->total_price - $priceVoucher + $oder->priceShip, 0, ',', '.') }}đ</p>
                        </th>
                    </tr>
                </table>
            </div>

            <div>
                <table>
                    <tr>
                        <th width="200px">Người bán hàng</th>
                        <th width="800px">Người mua hàng</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>