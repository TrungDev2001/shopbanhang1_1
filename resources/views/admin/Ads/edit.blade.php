<!-- Modal -->
<div class="modal fade" id="editAdsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit ads</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editFormDataAds" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nameEdit">Name</label>
                <input type="text" class="form-control" name="nameAdsEdit" id="nameAdsEdit" placeholder="Nhập name ads">
                <small id="nameAdsEditError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="descriptionEdit">Description</label>
                <input type="text" class="form-control" name="descriptionEdit" id="descriptionEdit" placeholder="Nhập description ads">
                <small id="descriptionAdsEditError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="statusEdit">Status</label>
                <select class="form-control" name="statusAdsEdit" id="statusAdsEdit">
                    <option value="0">Hiện</option>
                    <option value="1">Ẩn</option>
                </select>
            </div>
                <div class="form-group-file">
                <label for="exampleFormControlFile1">Image ads</label>
                <img src="{{ asset('web/images/quang-cao-facebook-1.jpg') }}" class="ads_image img-thumbnail" alt="avatar">
                <input type="file" name="image_path_AdsEdit" class="form-control-file file-upload" multiple>
                <small id="image_path_AdsError" class="form-text text-muted text-danger"></small>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary edit_store_ads">Edit</button>
      </div>
    </div>
  </div>
</div>