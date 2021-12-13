@foreach($categoryPosts as $category)
    <tr>
        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
        <td class="editname" data-url="{{ route('category.ajaxNameCategory', ['id' => $category->id]) }}" id="name-{{$category->id}}" contenteditable='true'>{{ $category->name }}</td>
        @if($category->action == 0)
        <td>Hiện</td>
        @else
        <td>Ẩn</td>
        @endif
        <td id="dateCategory-{{$category->id}}">{{ date_format($category->created_at, 'd/m/Y') }}</td>
        <td>
            <a><i data-url="CategoryPost/edit/{{ $category->id }}" data-toggle="modal" data-target="#editModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i><i data-url="CategoryPost/delete/{{$category->id}}" class="fa fa-times text-danger text delete-sweetalert"></i></a>
        </td>
    </tr>
@endforeach