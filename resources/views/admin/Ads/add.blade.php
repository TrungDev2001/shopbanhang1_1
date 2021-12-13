<!-- Modal -->
<div class="modal fade" id="addAdsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add ads</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addFormDataAds" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nameAdd">Name</label>
                <input type="text" class="form-control" name="nameAdsAdd" placeholder="Nhập name ads">
                <small id="nameAdsAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="descriptionAdd">Description</label>
                <input type="text" class="form-control" name="descriptionAdd" placeholder="Nhập description ads">
                <small id="descriptionAdsAddError" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
                <label for="statusAdd">Status</label>
                <select class="form-control" name="statusAdsAdd">
                    <option value="0">Hiện</option>
                    <option value="1">Ẩn</option>
                </select>
            </div>
                <div class="form-group-file">
                <label for="exampleFormControlFile1">Image ads</label>
                <img src="{{ asset('web/images/quang-cao-facebook-1.jpg') }}" class="ads_image img-thumbnail" alt="avatar">
                <input type="file" name="image_path_AdsAdd" class="form-control-file file-upload" id="" multiple>
                <small id="image_path_AdsError" class="form-text text-muted text-danger"></small> 
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_store_ads">Add</button>
      </div>
    </div>
  </div>
</div>