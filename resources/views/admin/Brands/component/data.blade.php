@foreach ($brands as $brand)
    <tr>
        <td data-url="" id="">{{ $brand->name }}</td>
        <td>{{ $brand->description }}</td>
    @if ($brand->active == 0) 
        <td data-url="" id="" class=""><i class='fa fa-circle'></i></td>
    @else 
        <td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>
    @endif
        <td>{{ $brand->created_at->format('d-m-Y') }}</td>
        <td>
            <a>
                <i class="fa fa-eye view-brand" data-toggle="modal" data-target="#showModal" data-url="/brands/show/{{ $brand->id }}" aria-hidden="true"></i>
                @can('brand-edit')
                <i data-url="/brands/edit/{{ $brand->id }}" data-toggle="modal" data-target="#editModal" class="fa fa-pencil-square-o text-success text-active edit-form "></i>
                @elsecan('brand-delete')
                <i data-url="/brands/delete/{{ $brand->id }}" class="fa fa-times text-danger text delete-sweetalert"></i>
                @endcan
            </a>
        </td>
    </tr>
@endforeach