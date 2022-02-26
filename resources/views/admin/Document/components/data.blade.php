@foreach ($documents as $key => $document)
<tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $document['name'] }}</td>
    <td>{{ $document['type'] }}</td>
    <td>{{ $document['mimetype'] }}</td>
    <td>{{ $document['size'] }}</td>
    <td><iframe src="https://drive.google.com/file/d/{{ $document['path'] }}/preview" width="160" height="120" allow="autoplay"></iframe></td>
    <td>
        <a>
            {{-- <i data-url="document/edit/{{ $document['path'] }}" data-toggle="modal" data-target="#editdocumentModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i> --}}
            @can('document-delete')
                <i data-url="document/delete/{{ $document['name'] }}/{{ $document['path'] }}" class="fa fa-times text-danger text delete-sweetalert"></i>
            @endcan
        </a>
    </td>
</tr>
@endforeach