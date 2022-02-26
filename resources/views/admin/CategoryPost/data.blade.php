@foreach($categoryPosts as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td class="editname" data-url="{{ route('category.ajaxNameCategory', ['id' => $category->id]) }}" id="name-{{$category->id}}" contenteditable='true'>{{ $category->name }}</td>
        <td>{{ $category->description }}</td>
        @if($category->action == 0)
            <td>Hiện</td>
        @else
            <td>Ẩn</td>
        @endif
        <td id="dateCategory-{{$category->id}}">{{ date_format($category->created_at, 'd/m/Y') }}</td>
        <td>
            <a>
                @can('categoryPost-edit')
                    <i data-url="CategoryPost/edit/{{ $category->id }}" data-toggle="modal" data-target="#editModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
                @endcan
                @can('categoryPost-delete')
                    <i data-url="CategoryPost/delete/{{$category->id}}" class="fa fa-times text-danger text delete-sweetalert"></i>
                @endcan
            </a>
        </td>
    </tr>
@endforeach