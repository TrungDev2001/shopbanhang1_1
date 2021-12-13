<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nameCategory">Name</label>
                    <input type="text" class="form-control" id="nameCategory" placeholder="Nhập name danh mục">
                    <small id="nameError" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="parent_id_Category">Phân cấp danh mục</label>
                    <select class="form-control" name="parent_id_Category" id="parent_id_Category">
                        <option value="0">Danh mục cha</option>
                        {!! $htmlOption !!}
                    </select>
                </div>
                <div class="form-group">
                    <label for="statusCategory">Status</label>
                    <select class="form-control" id="statusCategory">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-add">Thêm</button>
            </div>
        </div>
    </div>
</div>