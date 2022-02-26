@foreach ($sliders as $key => $slider)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $slider->name }}</td>
        <td>{{ $slider->description }}</td>`;
    @if ($slider->active == 0) 
        <td data-url="" id="" class=""><i class='fa fa-circle'></i></td>
    @else 
        <td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>
    @endif
        <td><img class="file-upload" src="{{ url($slider->image_path_Sider) }}" alt=""></td>
        <td>{{ $slider->created_at->format('d-m-Y') }}</td>
        <td>
            <a href="" ui-toggle-class="">
                <i data-url="sliders/edit/{{ $slider->id }}" data-toggle="modal" data-target="#editSliderModal" class="fa fa-pencil-square-o text-success text-active edit-form "></i>
                <i data-url="sliders/delete/{{ $slider->id }}" class="fa fa-times text-danger text delete-sweetalert"></i>
            </a>
        </td>
    </tr>
@endforeach