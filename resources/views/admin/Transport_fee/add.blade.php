<!-- Modal -->
<div class="modal fade" id="addTransportFreeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add voucher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="dataTransportFree" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tp">Thành phố</label>
                <select class="form-control thanhpho choose" id="tp" name="thanhpho">
                    <option value="">Chọn thành phố</option>
                    @foreach ($thanhPhos as $thanhPho)
                        <option value="{{ $thanhPho->matp }}">{{ $thanhPho->name }}</option>
                    @endforeach
                </select>
                <small id="error_thanhPho" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="qh">Quận huyện</label>
                <select class="form-control quanhuyen choose" id="qh" name="quanhuyen">
                <option value="">Chọn quận huyện</option>
                </select>
                <small id="error_quanhuyen" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="xp">Xã phường</label>
                <select class="form-control xaphuong" id="xp" name="xaphuong">
                <option value="">Chọn xã phường</option>
                </select>
                <small id="error_xaphuong" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="phivanchuyen">Phí vận chuyển</label>
                <input type="number" class="form-control numberTransportFree" name="numberTransportFree">
                <small id="phivanchuyen" class="form-text text-danger"></small>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_TransportFee">Save changes</button>
    </div>
    </div>
</div>
</div>
