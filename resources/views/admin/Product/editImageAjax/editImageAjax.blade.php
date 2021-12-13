@php
    $base_url = 'http://localhost:8000/';
@endphp
@foreach($imageDetails as $imageDetail)
    <tr class="row1" data-id="{{ $imageDetail->id }}">
        <th scope="row">{{ $imageDetail-> position}}</th>
        <td contenteditable="true">{{ $imageDetail-> product_ImagesDetail_name}}</td>
        <td>
            <img src="{{ $base_url.$imageDetail->product_ImagesDetail_path }}" alt="">
            <input type="file" name="" id="">
        </td>
        <td><span><button data-url="{{ url('products/deleteImageDetail/'. $imageDetail->id) }}" class="btn btn-danger delete-sweetalert">Xóa</button></span></td>
    </tr>
@endforeach