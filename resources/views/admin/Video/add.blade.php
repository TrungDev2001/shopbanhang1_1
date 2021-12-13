<!-- Modal add-->
<div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="videoAdd" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <ul class="errorsAddVideo" style="padding-left: 20px">
                    
                </ul>
            </div>
            <div class="form-group">
                <label for="Name">Title</label>
                <input type="text" class="form-control" name="titleAdd" id="title" onkeyup="ChangeToSlug('title','slug');" data-validation="required" data-validation-error-msg="Title không được để trống" aria-describedby="emailHelp" placeholder="Enter name">
                <small id="nameAdd" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Name">Slug</label>
                <input type="text" class="form-control" name="slugAdd" id="slug" data-validation="required" data-validation-error-msg="Slug không được để trống" aria-describedby="emailHelp" placeholder="Enter name">
                <small id="nameAdd" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control" name="descriptionAdd" data-validation="required" data-validation-error-msg="Description không được để trống" placeholder="Enter description">
                {{-- <textarea name="descriptionAdd" id="editorDescriptionVideo" rows="10" cols="80">
                    
                </textarea> --}}
            </div>
            <div class="form-group">
                <label for="Description">Link</label>
                <input type="text" class="form-control" name="linkAdd" data-validation="required" data-validation-error-msg="Link không được để trống" placeholder="Enter description">
                <small id="descriptionAdd" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group-file">
                <label for="exampleFormControlFile1">Image avatar video</label>
                <img src="{{ asset('web/images/380x500.png') }}" class="avatar1 img-thumbnail" alt="avatar">
                <input type="file" name="imageVideoAdd" class="form-control-file file-upload" id="">
                <small id="image_path_SiderAdd" class="form-text text-muted text-danger"></small> 
            </div>
            <div class="form-group">
                <label for="statusAdd">Status</label>
                <select class="form-control" name="statusAdd">
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