<!-- Modal add-->
<div class="modal fade" id="editVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="videoEdit" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <ul class="errorsEditVideo" style="padding-left: 20px">
                    
                </ul>
            </div>
            <div class="form-group">
                <label for="Name">Title</label>
                <input type="text" class="form-control titleEdit" name="titleEdit" id="title1" onkeyup="ChangeToSlug('title1','slug1');" data-validation="required" data-validation-error-msg="Title không được để trống" aria-describedby="emailHelp" placeholder="Enter name">
                <small id="nameEdit" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Name">Slug</label>
                <input type="text" class="form-control slugEdit" name="slugEdit" id="slug1" data-validation="required" data-validation-error-msg="Slug không được để trống" aria-describedby="emailHelp" placeholder="Enter name">
                <small id="nameEdit" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control descriptionEdit" name="descriptionEdit" data-validation="required" data-validation-error-msg="Description không được để trống" placeholder="Enter description">
                {{-- <textarea name="descriptionEdit" class="descriptionEdit" id="editorEditDescriptionVideo" rows="10" cols="80">
                    
                </textarea> --}}
            </div>
            <div class="form-group">
                <label for="Description">Link</label>
                <input type="text" class="form-control linkEdit" name="linkEdit" data-validation="required" data-validation-error-msg="Link không được để trống" placeholder="Enter description">
            </div>
            <div class="form-group-file">
                <label for="exampleFormControlFile1">Image avatar video</label>
                <img src="" class="avatar1 img-thumbnail imageVideoEdit" alt="avatar">
                <input type="file" name="imageVideoEdit" class="form-control-file file-upload" id="">
                <small id="image_path_SiderEdit" class="form-text text-muted text-danger"></small> 
            </div>
            <div class="form-group">
                <label for="statusEdit">Status</label>
                <select class="form-control statusEdit" name="statusEdit">
                    <option value="0">Hiện</option>
                    <option value="1">Ẩn</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-edit">Edit</button>
      </div>
    </div>
  </div>
</div>