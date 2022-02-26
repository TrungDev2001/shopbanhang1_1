@foreach ($adss as $key => $ads)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $ads->name }}</td>
        <td>{{ $ads->name }}</td>
    @if ($ads->active == 0)
        <td data-url="" id="" class=""><i class='fa fa-circle'></i></td>
    @else
        <td data-url="" id="" class=""><i class='fa fa-circle-o'></i></td>
    @endif
        <td><img class="file-upload" src="{{ url($ads->path_image_ads) }}" alt=""></td>
        <td>{{ $ads->created_at->format('d-m-Y') }}</td>
        <td>
            <a>
                @can('ads-edit')
                    <i data-url="Ads/edit/{{ $ads->id }}" data-toggle="modal" data-target="#editAdsModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i>
                @endcan
                @can('ads-delete')
                    <i data-url="Ads/delete/{{ $ads->id }}" class="fa fa-times text-danger text delete-sweetalert"></i>
                @endcan
            </a>
        </td>
    </tr>
@endforeach 
