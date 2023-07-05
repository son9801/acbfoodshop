<div>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="footer-heading">{{ $appSetting->website_name ?? 'website name' }}</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="" class="text-white">Giới thiệu về ACB Food</a></div>
                    <div class="mb-2"><a href="" class="text-white">Làm việc với chúng tôi</a></div>
                    <div class="mb-2"><a href="" class="text-white">Điều khoản dịch vụ</a></div>
                    <div class="mb-2"><a href="" class="text-white">Liên hệ</a></div>
                    <div class="mb-2"><a href="" class="text-white">Nhượng quyền thương mại</a></div>
                </div>
                <div class="col-md-4">
                    <h4 class="footer-heading">Chính sách và hỗ trợ khách hàng</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="" class="text-white">Chính sách đổi trả</a></div>
                    <div class="mb-2"><a href="" class="text-white">Chính sách giao hàng</a></div>
                    <div class="mb-2"><a href="" class="text-white">Phương thức thanh toán</a></div>
                    <div class="mb-2"><a href="" class="text-white">Hướng dẫn mua hàng</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Thông tin liên hệ</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">
                        <i class="fa fa-map-marker"></i> {{ $appSetting->address ?? 'website name' }}
                    </div>
                    <div class="mb-2">
                        <i class="fa fa-phone"></i> {{ $appSetting->phone ?? 'website name' }}
                    </div>

                    <div class="mb-2">
                        <i class="fa fa-envelope"></i> {{ $appSetting->email ?? 'website name' }}
                    </div>

                </div>
                <div class="col-md-2">
                    <h4 class="footer-heading">Theo dõi chúng tôi</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">
                        <a href="{{ $appSetting->facebook }}" target="_blank" class="text-white"><i
                                class="fa fa-facebook"></i></a> ACBfood - Cửa hàng thực phẩm sạch
                    </div>
                    @if ($appSetting->youtube)
                        <div class="mb-2">
                            <a href="{{ $appSetting->youtube }}" target="_blank" class="text-white"><i
                                    class="fa fa-youtube"></i></a>ACBFood
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class=""> &copy; 2023 - Hoàng Anh Sơn - Online food shop. All rights reserved.</p>
                </div>
                <div class="col-md-4">
                    <div class="social-media">
                        Get Connected:
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-instagram"></i></a>
                        <a href=""><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
