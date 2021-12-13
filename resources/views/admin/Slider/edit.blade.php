<div class="modal fade" id="editSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="sliderEdit" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp" placeholder="Enter name">
                <small id="nameEditErorr" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control" id="descriptionEdit" name="descriptionEdit" placeholder="Enter description">
                <small id="descriptionEditErorr" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="statusEdit">Status</label>
                <select class="form-control" id="statusEdit" name="statusEdit">
                    <option value="0">Hiện</option>
                    <option value="1">Ẩn</option>
                </select>
            </div>
            <div class="form-group-file">
                <label for="exampleFormControlFile1">Image slider</label>
                <img id="image_path_SiderEdit" src="" class="avatar1 img-thumbnail" alt="avatar">
                <input  type="file" name="image_path_SiderEdit" class="form-control-file file-upload" id="exampleFormControlFile1">
                <small id="image_path_SiderEditErorr" class="form-text text-muted text-danger"></small>
                
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update-slider">Save changes</button>
      </div>
    </div>
  </div>
</div>