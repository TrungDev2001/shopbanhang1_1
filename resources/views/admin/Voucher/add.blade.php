<!-- Modal -->
<div class="modal fade" id="addVoucherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add voucher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="dataVoucher" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nameVoucher">Name</label>
                <input type="text" class="form-control nameVoucher" name="nameVoucher" placeholder="Enter name">
                <small id="nameVoucher" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Code</label>
                <input type="text" class="form-control codeVoucher" name="codeVoucher" id="exampleInputPassword1" placeholder="Enter Code">
                <small id="codeVoucher" class="form-text text-danger"></small>
            </div>
            <div style="display: flex;">
                <div><label for="">Type:&nbsp&nbsp&nbsp&nbsp</label></div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input typeVoucher" type="radio" name="typeVoucher" id="inlineRadio1" value="0">
                    <label class="form-check-label" for="inlineRadio1">Phần trăm&nbsp&nbsp</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input typeVoucher" type="radio" name="typeVoucher" id="inlineRadio2" value="1">
                    <label class="form-check-label" for="inlineRadio2">Tiền</label>
                </div>
            </div>
                <small id="typeVoucher" class="form-text text-danger"></small>
            <div class="form-group">
                <label for="exampleInputNumber1">Number</label>
                <input type="number" class="form-control numberVoucher" name="numberVoucher" id="exampleInputNumber1" placeholder="Enter Number">
                <small id="numberVoucher" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputNumber1">Quantity</label>
                <input type="number" class="form-control numberVoucher" name="quantityVoucher" id="" placeholder="Enter Quantity">
                <small id="quantityVoucher" class="form-text text-danger"></small>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_voucherr">Save changes</button>
    </div>
    </div>
</div>
</div>
