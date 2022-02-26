@foreach ($users as $key => $user)
    <tr>
        <td>{{ $key+1 }}</td>
        <td><img src="{{ $user->path_image_avatar == null ? url('web/images/avatar_2x.png') : url('/uploads/AvatarUser/'. Auth::user()->id . '/'.$user->path_image_avatar) }}" alt="{{ $user->name }}" style="width: 50px; height: 50px;"></td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @foreach ($user->roles as $role)
                    {{$role->name}}
            @endforeach
        </td>
        <td>
            <span>
                @can('user-edit')
                    <a href="{{ route('UserController.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                @endcan
                @can('user-delete')
                    <a data-url="{{ route('UserController.delete', ['id' => $user->id]) }}" class="btn btn-sm btn-danger delete-sweetalert">Xóa</a>
                @endcan
            </span>
        </td>
    </tr>
@endforeach