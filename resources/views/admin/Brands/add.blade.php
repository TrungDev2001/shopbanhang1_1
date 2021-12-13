<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="nameAdd">Name</label>
                <input type="text" class="form-control" id="nameAdd" placeholder="Nhập name brand">
                <small id="nameAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="descriptionAdd">Description</label>
                <input type="text" class="form-control" id="descriptionAdd" placeholder="Nhập description brand">
                <small id="descriptionAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="category_idAdd">Category</label>
              <select class="form-control" name="category_idAdd" id="parent_id_CategoryAdd">
                  
              </select>
              <small id="id_CategoryAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="statusAdd">Status</label>
                <select class="form-control" id="statusAdd">
                    <option value="0">Hiện</option>
                    <option value="1">Ẩn</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-add">Add</button>
      </div>
    </div>
  </div>
</div>