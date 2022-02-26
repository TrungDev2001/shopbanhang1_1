@foreach ($vouchers as $voucher)
    <tr>
        <td>{{ $voucher->id }}</td>
        <td>{{ $voucher->name }}</td>
        <td>{{ $voucher->code }}</td>
    {{-- @if ($voucher->type == 0)
        <td>%</td>
    @else
        <td>vnd</td>
    @endif --}}
    @if ($voucher->type == 0)
        <td>{{ $voucher->number }}%</td>
    @else
        <td>{{ number_format($voucher->number, 0, ',', '.') }}đ</td>
    @endif
        <td>{{ number_format($voucher->numberMax, 0, ',', '.') }}đ</td>
        <td>{{ $voucher->quantity }}</td>
        <td>{{ $voucher->quantity_use_of_user }}</td>
        <td>{{ $voucher->date_start }}</td>
        <td>{{ $voucher->date_end }}</td>
    @if ( $now >= $voucher->date_start && $now <= $voucher->date_end)
        <td style="color: green;">Còn hạn</td>
    @elseif($now < $voucher->date_start)
        <td style="color: rgb(235, 235, 100);">Chưa đến hạn</td>
    @else
        <td style="color: red;">Hết hạn</td>
    @endif
        <td><button data-voucher_id="{{$voucher->id}}" data-type="KHvip" class="btn btn-info btn-sm giftKHvip"><span class="giftKHvip{{$voucher->id}}" >Gift KH vip</span><span class="loaderGif{{$voucher->id}}" style="display: none"><img style="width: 17px" src="{{ asset('loaderGif/loading6.gif') }}" alt=""></span></button><button data-voucher_id="{{$voucher->id}}" data-type="KHthuong" class="btn btn-secondary btn-sm giftKHvip"><span class="giftKHthuong{{$voucher->id}}" >Gift KH thường</span><span class="loaderGifthuong{{$voucher->id}}" style="display: none"><img style="width: 17px" src="{{ asset('loaderGif/loading6.gif') }}" alt=""></span></button></td>
    @if ($voucher->status == 0)
        <td style="color: green;">Đang kích hoạt</td>
    @else
        <td style="color: red;">Chưa kích hoạt</td>
    @endif
        <td>
            <a>
                @can('voucher-edit')
                    <i data-url="voucher/update/{{ $voucher->id }}" data-url_edit="voucher/edit/{{ $voucher->id }}" data-toggle="modal" data-target="#editVoucherModallll" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
                @endcan
                @can('voucher-delete')
                    <i data-url="voucher/delete/{{ $voucher->id }}" class="fa fa-times text-danger text delete-sweetalert"></i>
                @endcan
            </a>
        </td>
    </tr>
@endforeach
