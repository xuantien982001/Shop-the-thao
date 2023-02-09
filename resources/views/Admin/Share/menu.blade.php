<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="#"style="font-size: 26px;font-weight: 600;">Đồ Án CDIO 4<img class="img-fluid for-dark"
                    src="/assets_UI/assets_admin/images/logo/logo_dark.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid"
                    src="/assets_UI/assets_admin/images/logo/logo-icon.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img class="img-fluid"
                                src="/assets_UI/assets_admin/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <a href="#" style="font-size: 15px;font-weight: 600;">{{ Auth::guard('admin')->user()->name }}</a>

                        </div>
                    </li>

                    <li class="sidebar-list mb-3"><a class="sidebar-link sidebar-title link-nav"
                            href="/admin-shop/admin/index"><i class="fa fa-user text-danger" style="font-size: 20px">
                            </i><span class="ps-3 text-success"> <i>Admin</i></span></a></li>
                    <li class="sidebar-list mb-3"><a class="sidebar-link sidebar-title link-nav"
                            href="/admin-shop/khach-hang/index"><i class="fa fa-male text-danger"
                                style="font-size: 25px"></i>
                            </i><span class="ps-3 text-success"><i>Khách Hàng</i></span></a></li>


                    <li class="sidebar-list mb-3"><a class="sidebar-link sidebar-title active" href="#"><i
                                class="fa fa-mobile text-danger" style="font-size: 20px"></i><span
                                class="ps-3 text-success"> <i>Sản Phẩm</i></span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="/admin-shop/danh-muc/index">Danh Mục</a></li>
                            <li><a href="/admin-shop/san-pham/index">Sản Phẩm</a></li>

                        </ul>
                    </li>
                    <li class="sidebar-list mb-3"><a class="sidebar-link sidebar-title link-nav"
                        href="/admin-shop/hoa-don-ban-hang/index"><i class="fa fa-cart-plus text-danger"
                            style="font-size: 20px"></i>
                        </i><span class="ps-3 text-success"><i>Đơn Hàng</i></span></a></li>

                    </li>
                    <li class="sidebar-list mb-3"><a class="sidebar-link sidebar-title link-nav"
                        href="/admin-shop/hoa-don-ban-hang/thong-ke"><i class="fa fa-bar-chart text-danger"
                            style="font-size: 20px"></i>
                        </i><span class="ps-3 text-success"><i>Thống kê</i></span></a></li>

                    </li>
                    <li class="sidebar-list mb-3"><a class="sidebar-link sidebar-title active" href="#"><i
                                class="fa fa-sticky-note text-danger" style="font-size: 20px"></i><span
                                class="ps-3 text-success"> <i>Bài Viết</i></span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="/admin-shop/bai-viet/index">Bài Viết</a></li>
                            <li><a href="/admin-shop/chuyen-muc/index">Chuyên Mục</a></li>

                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="/admin-shop/logout">
                            <i data-feather="log-out"></i>
                            <span>Đăng Xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
