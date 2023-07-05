<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Trang chủ</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/category') }}">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">Danh mục sản phẩm</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/product') }}">
                <i class="material-symbols-outlined menu-icon"> inventory_2</i>
                <span class="menu-title">Sản phẩm</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/orders') }}">
                <i class="material-symbols-outlined menu-icon">order_approve</i>
                <span class="menu-title">Đơn hàng</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/slider') }}">
                <i class="material-symbols-outlined menu-icon">capture</i>
                <span class="menu-title">Ảnh thanh trượt</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/users') }}">
                <i class="material-symbols-outlined menu-icon">person</i>
                <span class="menu-title">Người dùng</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#revenue">
                <i class="material-symbols-outlined menu-icon">insert_chart</i>
                <span class="menu-title">Thống kê</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="revenue">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/revenue') }}"> Thống kê theo ngày</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/revenueMonth') }}"> Thống kê theo tháng</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/revenueYear') }}"> Thống kê theo năm</a></li>
                </ul>
            </div>
        </li>
  
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/settings') }}">
                <i class="material-symbols-outlined menu-icon">settings</i>
                <span class="menu-title">Tuỳ chỉnh website</span>
            </a>
        </li>
    </ul>
</nav>
