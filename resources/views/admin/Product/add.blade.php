<div class="modal fade" id="addProductModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="productAdd" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control nameAdd" name="nameAdd" placeholder="Enter name">
                <small id="nameAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Name">Price</label>
                <input type="number" class="form-control" name="priceAdd" placeholder="Enter name">
                <small id="priceAddError" class="form-text text-muted text-danger"></small>
            </div>

            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control" name="descriptionAdd" placeholder="Enter description">
                <small id="descriptionAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="statusAdd">Status</label>
                <select class="form-control" name="statusAdd">
                    <option value="0">Hiện</option>
                    <option value="1">Ẩn</option>
                </select>
                <small id="statusAddError" class="form-text text-muted text-danger"></small>
            </div>

            <div class="form-group-file">
                <label for="exampleFormControlFile1">Image product avatar</label>
                <img src="{{ asset('web\images\85090667-product-word-cloud-collage-business-concept-background.jpg') }}" class="avatar1 img-thumbnail" alt="avatar">
                <input type="file" name="image_AvatarAdd" class="form-control-file file-upload">
                <small id="image_AvatarAddError" class="form-text text-muted text-danger"></small>
            </div>

            <div class="form-group-file tags">
                <label for="exampleFormControlFile1">Image product detail</label>
                <input type="file" name="image_DetailAdd[]" class="form-control-file" multiple="multiple">
                <small id="image_DetailAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Textarea1">Content</label>
                <textarea id="my_editor" name="contentAdd" class="form-control"></textarea>
                <small id="contentAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label>Nhập tags cho sản phẩm</label>
                <select name="tagsProductAdd[]" class="form-control-file" id="select2insidemodal" multiple="multiple">
                    
                </select>
                <small id="tagsProductAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="parent_id_Category">Category</label>
                <select class="form-control" name="id_CategoryAdd" id="parent_id_Category">
                    <option></option>
                    {!! $htmlOption !!}
                </select>
                <small id="id_CategoryAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="parent_id_Category">Brand</label>
                <select class="form-control" name="Category_brandsAdd" id="Category_brands">
                    <option></option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <small id="Category_brandsAddError" class="form-text text-muted text-danger"></small>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-store">Add</button>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('vendors/ckeditor/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'my_editor' );
</script>