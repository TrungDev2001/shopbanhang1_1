<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editCategoryPost" enctype="multipart/form-data">
          <div class="form-group">
              <label for="nameCategoryPost">Name</label>
              <input type="text" class="form-control" id="nameCategoryPostEdit" onkeyup="ChangeToSlug2();" name="nameCategoryPostEdit" data-validation="length" data-validation-length="min1" data-validation-error-msg="Name không được để trốn" placeholder="Nhập name danh mục">
              <small id="nameError" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
              <label for="nameCategory">Slug</label>
              <input type="text" class="form-control" id="slugCategoryPostEdit" name="slugCategoryPostEdit" data-validation="length" data-validation-length="min1" data-validation-error-msg="Slug không được để trốn" placeholder="Nhập slug">
              <small id="nameError" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
              <label for="nameCategory">Description</label>
              <input type="text" class="form-control" id="descriptionCategoryPostEdit" name="descriptionCategoryPostEdit" data-validation="length" data-validation-length="min1" data-validation-error-msg="Description không được để trốn" placeholder="Nhập description">
              <small id="nameError" class="form-text text-muted"></small>
          </div>
          {{-- <div class="form-group">
              <label for="parent_id_Category">Phân cấp danh mục</label>
              <select class="form-control" name="parent_id_Category" id="parent_id_CategoryEdit">
                  <option value="0">Danh mục cha</option>
                  {!! $htmlOption !!}
              </select>
          </div> --}}
          <div class="form-group">
              <label for="statusCategory">Status</label>
              <select class="form-control" id="statusCategoryPostEdit" name="statusCategoryPostEdit">
                  <option value="0">Hiện</option>
                  <option value="1">Ẩn</option>
              </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary edit-update">Save changes</button>
      </div>
    </div>
  </div>
</div>