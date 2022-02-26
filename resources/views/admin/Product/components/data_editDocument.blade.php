@if ($documents)
    @foreach ($documents as $key => $document)
        <tr class="row1" data-id="">
            <th scope="row">{{ $key+1 }}</th>
            <td>{{ $document['name'] }}</td>
            <td>{{ $document['mimetype'] }}</td>
            <td>{{ $document['size'] }}</td>
            <td><iframe src="https://drive.google.com/file/d/{{ $document['path'] }}/preview" width="160" height="120" allow="autoplay"></iframe></td>
            <td>
                <button class="btn btn-sm btn-primary download_document" data-name="{{$document['name']}}" data-mimetype="{{$document['mimetype']}}" data-url="{{ route('products.download_document', ['path' => $document['path']]) }}">Tải</button>
                <span><button data-url="{{ route('products.deleteDocument', ['name' => $document['name'], 'path' => $document['path']]) }}" class="btn btn-sm btn-danger delete-sweetalert">Xóa</button></span>
            </td>
        </tr>
    @endforeach
@endif
