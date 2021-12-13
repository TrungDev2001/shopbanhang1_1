<div class="modal fade showOder" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <h3 style="text-align: center;">Chi tiết đơn hàng</h3>
        <div class="info_KH_VC">
            <div>
                <h4>Thông tin khách hàng</h4>
                <p>Tên: <span id="nameKH"></span></p>
                <p>Email: <span id="emailKH"></span></p>
                <p>Phone: <span id="phoneKH"></span></p>
            </div>
            <div>
                <h4>Thông tin vận chuyển</h4>
                <p>Tên: <span id="nameVC"></span></p>
                <p>Địa chỉ: <span id="addressVC"></span></p>
                <p>Số điện thoại: <span id="phoneVC"></span></p>   
                <p>Ghi chú: <span id="notesVC"></span></p>   
            </div>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Mã Sp</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Tên</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Giá</th>
                <th scope="col">Tổng</th>
                </tr>
                <tbody id="dataOderDetail">
                </tbody>
            </thead>
        </table>
        
        <div>     
            <p>Tổng tiền hàng: <span id="totalPriceProduct"></span>đ</p>
            <p>Tổng tiền mã giảm giá: <span id="priceVoucher"></span>đ (<span id="nameVoucher"></span>)</p>
            <p>Phí vận chuyển: <span id="priceShip"></span>đ</p>
            <p>Thành tiền: <span id="totalPriceBuild"></span>đ</p>
        </div>
        <div style="margin-top: 15px; margin-bottom: 15px;">
            <b>Trạng thái đơn hàng:</b>
            <select data-id="" name="statusOder" id="statusOder">
                <option value="0">Chờ xác nhận</option>
                <option value="1">Chờ lấy hàng</option>
                <option value="2">Đang giao</option>
                <option value="3">Đã giao</option>
                <option value="4">Đã hủy</option>
                <option value="5">Trả hàng</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <span class="modal-footerr"></span> --}}
    </div>
  </div>
</div>