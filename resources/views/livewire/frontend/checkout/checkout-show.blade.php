<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>THANH TOÁN ĐƠN HÀNG</h4>
            <hr>
            @if ($this->totalProductAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4>
                                Tổng tiền đơn hàng :
                                <span class="float-end">{{ $this->totalProductAmount }}đ</span>
                            </h4>
                            <hr>
                            {{-- <small>* Items will be delivered in 3 - 5 days.</small>
            <br/>
            <small>* Tax and other charges are included ?</small> --}}
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4>
                                Thông tin khách hàng
                            </h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Họ và tên</label>
                                    <input type="text" wire:model.defer="fullname" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    @error('fullname')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Số điện thoại</label>
                                    <input type="number" wire:model.defer="phone" class="form-control"
                                        placeholder="Nhập số điện thoại" />
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Email</label>
                                    <input type="text" wire:model.defer="email" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Địa chỉ</label>
                                    <textarea wire:model.defer="address" class="form-control" rows="2"></textarea>
                                </div>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-12 mb-3">
                                    <label>Chọn hình thức thanh toán: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            <button class="nav-link active fw-bold" id="cashOnDeliveryTab-tab"
                                                data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button"
                                                role="tab" aria-controls="cashOnDeliveryTab"
                                                aria-selected="true" style="background-color:#009900">Thanh toán khi nhận hàng (COD)</button>
                                            {{-- <button class="nav-link fw-bold" id="onlinePayment-tab"
                                                data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button"
                                                role="tab" aria-controls="onlinePayment"
                                                aria-selected="false">Chuyển khoản qua ngân hàng</button> --}}
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade" id="cashOnDeliveryTab"
                                                role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                {{-- <h6>Hình thức thanh toán khi nhận hàng </h6> --}}
                                               
                                                <button type="button" wire:click="codOrder"
                                                    class="btn btn-warning">Thanh toán</button>

                                            </div>
                                            {{-- <div class="tab-pane fade" id="onlinePayment" role="tabpanel"
                                                aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>Online Payment Mode</h6>
                                                <hr />
                                                <button type="button" class="btn btn-warning"  name="redirect
                                                ">Thanh toán</button>
                                            </div> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            @else
                <div class="card card-body shadow text-center p-md-5">
                    <h4>Không có mặt hàng trong giỏ để thanh toán</h4>
                    <a href="{{ url('collections') }}" class="btn btn-warning">Mua hàng</a>
                </div>
            @endif

        </div>
    </div>
</div>
