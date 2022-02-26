@foreach ($transportFees as $transportFee)
    <tr>
        <td>{{ $transportFee->id }}</td>
        <td>{{ $transportFee->ThanhPho->name }}</td>
        <td>{{ $transportFee->QuanHuyen->name }}</td>
        <td>{{ $transportFee->XaPhuong->name }}</td>
        <td contenteditable data_url="transport_fee/update/{{ $transportFee->id }}" class="editPriceShip">{{ number_format($transportFee->phivanchuyen, 0, ',', '.') }}đ</td>
        <td>
            <a>
                @can('transportFee-delete')
                    <i data-url="transport_fee/delete/{{ $transportFee->id }}" class="fa fa-times text-danger text delete-sweetalert"></i>
                @endcan
            </a>
        </td>
    </tr>
@endforeach