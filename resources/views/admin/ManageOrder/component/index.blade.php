@foreach ($oders as $key => $oder)
    @php
        if (isset($oder->Voucher)) {
            if ($oder->Voucher->type == 0) {
                if($oder->Voucher->numberMax > 0){
                    $priceTotal = $oder->total_price - $oder->Voucher->numberMax + $oder->priceShip;
                }else{
                    $priceTotal = $oder->total_price - ($oder->total_price*$oder->Voucher->number/100) + $oder->priceShip;
                }
            } else {
                $priceTotal = $oder->total_price - $oder->Voucher->number + $oder->priceShip;
            }
        }else{
            $priceTotal = $oder->total_price + $oder->priceShip;
        }
    @endphp
{{-- $oder->total_price + $oder->priceShip --}}
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $oder->name }}</td>
        <td>{{ number_format( $priceTotal,0,',','.') }}đ</td>
        @if ($oder->payment == 'VNPAY')
            <td><a href="https://sandbox.vnpayment.vn/merchantv2/Users/Login.htm?ReturnUrl=%2fmerchantv2%2fUsers%2fLogout.htm" style="color:rgb(247, 3, 3)" target="_blank">VNPAY</a></td>
        @elseif($oder->payment == 'PayPal')
            <td><a href="https://developer.paypal.com/developer/accounts/" style="color:blue" target="_blank">PayPal</a></td>
        @else
            <td>{{ $oder->payment }}</td>
        @endif
        
        @if ($oder->active == 0)
            <td>Chờ xác nhận</td>
        @elseif($oder->active == 1)
            <td>Chờ lấy hàng</td>
        @elseif($oder->active == 2)
            <td style="color: rgb(145, 255, 0)">Đang giao</td>
        @elseif($oder->active == 3)
            <td style="color: rgb(34, 253, 5)">Đã giao</td>
        @elseif($oder->active == 4)
            <td>Đã hủy</td>
        @elseif($oder->active == 5)
            <td>Trả hàng</td>
        @elseif($oder->active == 6)
            <td style="color: red">Khách hủy</td>
        @endif

        <td>{{ date_format($oder->created_at,"d/m/Y") }}</td>
        <td style="display: flex;">
            <a style="display: flex;">
                @can('manageOrder-show')
                    <i  data-url="manageOrder/show/{{$oder->id}}" class="fa fa-eye view-brand text-active ShowOder" data-toggle="modal" data-target=".showOder"></i>
                @endcan
                {{-- <i style="padding: 0px 5px" data-url="manageOrder/delete/{{$oder->id}}" class="fa fa-times text-danger text delete-sweetalert"></i> --}}
            </a>
            @can('manageOrder-show')
                <a target="_blank" href="{{ route('manageOrder.print', ['id' => $oder->id]) }}"><i class="fa fa-print text-danger text delete-sweetalert"></i></a>
            @endcan
        </td>
    </tr>
@endforeach