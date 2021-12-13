@foreach($posts as $post)
    <tr>
        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
        <td>{{ $post->title }}</td>
        <td><img class="file-upload" src="{{ $post->image_path }}" alt="{{ $post->title }}"></td>
        <td>{{ $post->description }}</td>
        <td>{{ isset($post->CategoryPost->name) ? $post->CategoryPost->name : 'Chưa có' }}</td>
        @if ($post->status == 0) 
            <td>Hiện</td>
        @else
            <td>Ẩn</td>
        @endif
        <td>{{ date_format($post->created_at, "d-m-Y") }}</td>
        <td>
            <a href="{{ route('Post.edit', ['id' => $post->id]) }}"><i class="fa fa-pencil-square-o text-success text-active edit-form"></i></a>
            <a><i data-url="Post/delete/{{$post->id}}" class="fa fa-times text-danger text delete-sweetalert"></i></a>
        </td>
    </tr>
@endforeach