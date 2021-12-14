<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="" id="addImageDetailFor" method="POST" enctype="multipart/form-data">
            
            
        </form>
        <form id="addImageDetailForm" method="post" enctype="multipart/form-data">
            <label for="">Add image detail</label>
            <input type="file" name="addImageDetaill[]" id="addImageDetail" accept="image/*" multiple>
        </form>
        <table data-id="{{$product->id}}" class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            
                {{-- @livewire('image-detail-sor-table', ['product_id' => $product->id]) --}}
            
            <tbody id="tablecontents">
                @foreach ($imageDetails as $imageDetail)
                    <tr class="row1" data-id="{{ $imageDetail->id }}">
                        <th scope="row">{{ $imageDetail->position }}</th>
                        <td contenteditable="true">{{ $imageDetail->product_ImagesDetail_name }}</td>
                        <td>
                            <img src="{{ url($imageDetail->product_ImagesDetail_path) }}" alt="">
                            {{-- <input type="file" name="" id=""> --}}
                        </td>
                        <td><span><button data-url="{{ url('products/deleteImageDetail/'. $imageDetail->id) }}" class="btn btn-danger delete-sweetalert">Xóa</button></span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>
