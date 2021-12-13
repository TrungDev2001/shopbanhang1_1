<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục bài viết</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="errors" style="padding-left: 20px">
                    
                </ul>
                <form method="POST" id="addCategoryPost" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nameCategory">Name</label>
                        <input type="text" id="title" onkeyup="ChangeToSlug();" class="form-control nameCategoryPost title" name="nameCategoryPost" data-validation="length" data-validation-length="min1" data-validation-error-msg="Name không được để trống" placeholder="Nhập name">
                        <small id="nameError" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="nameCategory">Slug</label>
                        <input type="text" id="slug" class="form-control slugCategoryPost" name="slugCategoryPost" data-validation="length" data-validation-length="min1" data-validation-error-msg="Slug không được để trống" placeholder="Nhập slug">
                        <small id="nameError" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="nameCategory">Description</label>
                        <input type="text" class="form-control descriptionCategoryPost" name="descriptionCategoryPost" data-validation="length" data-validation-length="min1" data-validation-error-msg="Description không được để trống" placeholder="Nhập description">
                        <small id="nameError" class="form-text text-muted"></small>
                    </div>
                    {{-- <div class="form-group">
                        <label for="parent_id_Category">Phân cấp danh mục</label>
                        <select class="form-control" name="parent_id_Category" id="parent_id_Category">
                            <option value="0">Danh mục cha</option>
                            {!! $htmlOption !!}
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="statusCategory">Status</label>
                        <select class="form-control" name="statusCategory">
                            <option value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary btn-add">Thêm</button> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-addd">Thêm</button>
            </div>
        </div>
    </div>
</div>
