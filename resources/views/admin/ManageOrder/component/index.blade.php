@foreach ($oders as $oder)
    @php
        if (isset($oder->Voucher)) {
            if ($oder->Voucher->type == 0) {
                $priceTotal = $oder->total_price - ($oder->total_price*$oder->Voucher->number/100) + $oder->priceShip;
            } else {
                $priceTotal = $oder->total_price - $oder->Voucher->number + $oder->priceShip;
            }
        }else{
            $priceTotal = $oder->total_price + $oder->priceShip;
        }
    @endphp
{{-- $oder->total_price + $oder->priceShip --}}
    <tr>
        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
        <td>{{ $oder->name }}</td>
        <td>{{ number_format( $priceTotal,0,',','.') }}đ</td>
        
        @if ($oder->active == 0)
            <td>Chờ xác nhận</td>
        @elseif($oder->active == 1)
            <td>Chờ lấy hàng</td>
        @elseif($oder->active == 2)
            <td>Đang giao</td>
        @elseif($oder->active == 3)
            <td>Đã giao</td>
        @elseif($oder->active == 4)
            <td>Đã hủy</td>
        @elseif($oder->active == 5)
            <td>Trả hàng</td>
        @endif

        <td>{{ date_format($oder->created_at,"d/m/Y") }}</td>
        <td style="display: flex;">
            <a style="display: flex;">
                <i  data-url="manageOrder/show/{{$oder->id}}" class="fa fa-eye view-brand text-active ShowOder" data-toggle="modal" data-target=".showOder"></i>
                <i style="padding: 0px 5px" data-url="manageOrder/delete/{{$oder->id}}" class="fa fa-times text-danger text delete-sweetalert"></i>
            </a>
            <a target="_blank" href="{{ route('manageOrder.print', ['id' => $oder->id]) }}"><i class="fa fa-print text-danger text delete-sweetalert"></i></a>
        </td>
    </tr>
@endforeach