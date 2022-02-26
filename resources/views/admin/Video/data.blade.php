@foreach ($videos as $video)
    <tr>
        <td>{{ $video->id }}</td>
        <td>{{ $video->title }}</td>
        <td>{!! $video->discription !!}</td>
        {{-- <td>{{ $video->link }}</td> --}}
        <td><img src="{{ url($video->image_path_video) }}" alt="{{ $video->image_name_video }}"></td>
        @if ($video->status == 0)
            <td data-url="" id="" class=""><i class="fa fa-circle"></i></td>
        @else
            <td data-url="" id="" class=""><i class="fa fa-circle-o"></i></td>
        @endif
        <td><iframe width="220" height="125" src="https://www.youtube.com/embed/{{ substr($video->link, 17) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
        <td>{{ date_format($video->created_at, 'd-m-Y') }}</td>
        <td>
            <a>
                @can('video-edit')
                    <i data-url="Video/edit/{{ $video->id }}" data-toggle="modal" data-target="#editVideoModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
                @endcan
                @can('video-delete')
                    <i data-url="Video/delete/{{ $video->id }}" class="fa fa-times text-danger text delete-sweetalert"></i>
                @endcan
            </a>
        </td>
    </tr>
@endforeach