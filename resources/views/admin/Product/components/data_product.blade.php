@foreach ($products as $key => $product)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ number_format($product->original_price, 0, ',', '.') }}đ</td>
        <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
        <td>{{ number_format($product->promotional_price, 0, ',', '.') }}đ</td>
    @if ($product->active == 0)
        <td data-url="" id="" class=""><i class="fa fa-circle"></i></td>
    @else 
        <td data-url="" id="" class=""><i class="fa fa-circle-o"></i></td>
    @endif
        <td><img style="height: 100px; object-fit: cover;" class="file-upload" src="{{ $product->feature_image_path }}" alt=""></td>\
        <td>{{ $product->quantity_product }}</td>
        <td>{{ $product->quantity_sold }}</td>
        <td>{{ $product->categorys->name }}</td>
        <td>{{ $product->brands->name }}</td>
        <td>{{ date_format($product->created_at, "d-m-Y") }}</td>
        <td>
            @can('product-edit')
                <a href="{{ url("products/edit_cover/$product->id") }}"><button type="button">Edit</button></a>
            @endcan
            @can('product-delete')
                <button type="button"><i data-url="products/delete/{{ $product->id }}" class="fa fa-times text-danger text delete-sweetalert"></i></button>
            @endcan
        </td>
    </tr>
@endforeach