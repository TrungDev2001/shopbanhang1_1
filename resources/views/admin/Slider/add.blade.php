<!-- Modal add-->
<div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="sliderAdd" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" name="nameAdd" aria-describedby="emailHelp" placeholder="Enter name">
                <small id="nameAdd" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control" name="descriptionAdd" placeholder="Enter description">
                <small id="descriptionAdd" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="statusAdd">Status</label>
                <select class="form-control" name="statusAdd">
                    <option value="0">Hiện</option>
                    <option value="1">Ẩn</option>
                </select>
            </div>
            <div class="form-group-file">
                <label for="exampleFormControlFile1">Image slider</label>
                <img src="{{ asset('web/images/380x500.png') }}" class="avatar1 img-thumbnail" alt="avatar">
                <input type="file" name="image_path_SiderAdd" class="form-control-file file-upload" id="">
                <small id="image_path_SiderAdd" class="form-text text-muted text-danger"></small> 
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