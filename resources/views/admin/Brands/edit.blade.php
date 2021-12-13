<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="nameEdit">Name</label>
                <input type="text" class="form-control" id="nameEdit" placeholder="Nhập name brand">
                <small id="nameEditError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="descriptionEdit">Description</label>
                <input type="text" class="form-control" id="descriptionEdit" placeholder="Nhập description brand">
                <small id="descriptionEditError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="category_idEdit">Category</label>
              <select class="form-control" name="category_idEdit" id="parent_id_CategoryEdit">
                  
              </select>
              <small id="id_CategoryEditError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="statusEdit">Status</label>
                <select class="form-control" id="statusEdit">
                    <option value="0">Hiện</option>
                    <option value="1">Ẩn</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary edit-update">Yes</button>
      </div>
    </div>
  </div>
</div>