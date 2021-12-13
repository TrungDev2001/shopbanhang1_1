@php
    $base_url = 'http://localhost:8000/';
@endphp
<div wire:sortable="updateTaskOrder">
<tbody>
    @foreach ($imageDetails as $imageDetail)
        <tr wire:sortable.item="{{ $imageDetail->id }}" wire:key="task-{{ $imageDetail->id }}" wire:sortable.handle>
            <th scope="row">{{ $imageDetail->id }}</th>
            <td>{{ $imageDetail->product_ImagesDetail_name }}</td>
            <td><img src="{{ $base_url.$imageDetail->product_ImagesDetail_path }}" alt=""></td>
            <td><button wire:click="removeTask({{ $imageDetail->id }})" class="btn btn-danger">Xóa</button></td>
        </tr>
    @endforeach
</tbody>
</div>
