@foreach($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td><img class="file-upload" src="{{ url($post->image_path) }}" alt="{{ $post->title }}"></td>
        <td>{{ $post->description }}</td>
        <td>{{ isset($post->CategoryPost->name) ? $post->CategoryPost->name : 'Chưa có' }}</td>
        @if ($post->status == 0) 
            <td>Hiện</td>
        @else
            <td>Ẩn</td>
        @endif
        <td>{{ date_format($post->created_at, "d-m-Y") }}</td>
        <td>
            @can('post-edit')
                <a href="{{ route('Post.edit', ['id' => $post->id]) }}"><i class="fa fa-pencil-square-o text-success text-active edit-form"></i></a>
            @endcan
            @can('post-edit')
                <a><i data-url="Post/delete/{{$post->id}}" class="fa fa-times text-danger text delete-sweetalert"></i></a>
            @endcan
        </td>
    </tr>
@endforeach