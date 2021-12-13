@foreach($categorys as $category)
<tr>
    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
    <td class="editname" data-url="{{ route('category.ajaxNameCategory', ['id' => $category->id]) }}" id="name-{{$category->id}}" contenteditable='true'>{{ $category->name }}</td>
    @if($category->active == 0)
    <td data-url="{{ route('category.ajaxActiveCategory', ['id' => $category->id]) }}" id="fa-active-on-{{$category->id}}" class="activeCategory"><i class='fa fa-circle-o'></i></td>
    @else
    <td data-url="{{ route('category.ajaxActiveCategory', ['id' => $category->id]) }}" id="fa-active-on-{{$category->id}}" class="activeCategory"><i class='fa fa-circle'></i></td>
    @endif
    @if ($category->parent_id == 0)
        <td>Danh mục cha</td>
    @else
        @foreach ($categorys as $item)
            @if ($item->id == $category->parent_id)
                <td>{{ $item->name }}</td>
            @endif
        @endforeach
    @endif
    <td id="dateCategory-{{$category->id}}">{{ date_format($category->created_at, 'd/m/Y') }}</td>
    <td>
        <a><i data-url="/category/ajax/edit/{{ $category->id }}" data-toggle="modal" data-target="#editModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i><i data-url="/category/ajax/delete/{{$category->id}}" class="fa fa-times text-danger text delete-sweetalert"></i></a>
    </td>
</tr>
@endforeach