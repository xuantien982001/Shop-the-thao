<!-- START HEADER -->
{{-- <header class="header_wrap fixed-top header_with_topbar">
    @include('Client.Share.top')
    <div class="bottom_header dark_skin main_menu_uppercase" id="cartMini">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/">
                    <img class="logo_light" src="/assets_client/assets/images/logo_light.png" alt="logo" />
                    <img class="logo_dark" src="/assets_client/assets/images/logo_dark.png" alt="logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-expanded="false">
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="nav-link" href="/">Home</a>

                        </li>
                        <li class="dropdown dropdown-mega-menu">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Products</a>
                            <div class="dropdown-menu">

                                <ul class="mega-menu d-lg-flex">
                                    @foreach ($danhMuc as $value)
                                        @if ($value->id_danh_muc_cha == 0)
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">{{ $value->ten_danh_muc }}</li>
                                                    @foreach ($danhMuc as $v)
                                                        @if ($value->id == $v->id_danh_muc_cha)
                                                            <li><a class="dropdown-item nav-link nav_item"
                                                                    href="/category/{{ $v->id }}">{{ $v->ten_danh_muc }}</a>
                                                            </li>

                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>

                    <div class="d-lg-flex menu_banners">
                        <div class="col-sm-4">
                            <div class="header-banner">
                                <img src="/assets_client/assets/images/menu_banner1.jpg" alt="menu_banner1">
                                <div class="banne_info">
                                    <h6>10% Off</h6>
                                    <h4>New Arrival</h4>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="header-banner">
                                <img src="/assets_client/assets/images/menu_banner2.jpg" alt="menu_banner2">
                                <div class="banne_info">
                                    <h6>15% Off</h6>
                                    <h4>Men's Fashion</h4>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="header-banner">
                                <img src="/assets_client/assets/images/menu_banner3.jpg" alt="menu_banner3">
                                <div class="banne_info">
                                    <h6>23% Off</h6>
                                    <h4>Kids Fashion</h4>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </li>



                </ul>
        </div>
        <ul class="navbar-nav attr-nav align-items-center">
            <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
                <div class="search_wrap">

                    <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                    <form id="searchsp" action="/search">
                        <input type="text" placeholder="Search" class="form-control" name="query">
                        <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                    </form>

                </div>

                <div class="search_overlay"></div>
            </li>
            @if (Auth::guard('customer')->check())
                <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#"
                        data-toggle="dropdown"><i class="linearicons-cart"></i></a>
                    <div class="cart_box dropdown-menu dropdown-menu-right">
                        <ul class="cart_list" v-for="(value, key) in listCart">
                            <li>
                                <a href="#" class="item_remove"><i class="ion-close"
                                        v-on:click="remove(value.id)"></i></a>
                                <a href="#"><img v-bind:src="value.hinh_anh_chinh"
                                        alt="cart_thumb1">@{{ value.ten_san_pham }}</a>
                                <span class="cart_quantity">@{{ value.so_luong_mua }}<span class="cart_amount">
                                        <span class="price_symbole"> Giá</span>
                                        <template v-if="value.gia_khuyen_mai==0">
                                            <td class="product-subtotal" data-title="Total">@{{ formatPrice(donGia(value.gia) * value.so_luong_mua) }} đ
                                            </td>
                                        </template>
                                        <template v-else>
                                            <td class="product-subtotal" data-title="Total">@{{ formatPrice(donGia(value.gia_khuyen_mai) * value.so_luong_mua) }} đ
                                            </td>
                                        </template>
                            </li>
                        </ul>
                        <div class="cart_footer">

                            <p class="cart_buttons"><a href="/client/cart"
                                    class="btn btn-fill-line rounded-0 view-cart">Xem Giỏ Hàng</a>
                            </p>
                        </div>
                    </div>
                </li>
            @endif

        </ul>
        </nav>
    </div>
    </div>
</header> --}}
<!-- END HEADER -->
<!-- START HEADER -->
<header class="header_wrap fixed-top header_with_topbar">
    @include('Client.Share.top')
    <div class="bottom_header dark_skin main_menu_uppercase">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/">
                    <img class="logo_light" src="/assets_client/assets/images/logo_light.png" alt="logo" />
                    <img class="logo_dark" src="/assets_client/assets/images/logo_dark.png" alt="logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-expanded="false">
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="nav-link active" href="/">Trang chủ</a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Blog</a>
                            <div class="dropdown-menu">
                                <ul>
                                    @foreach ($chuyen_muc as $key => $value)
                                    <li><a class="dropdown-item nav-link nav_item" href="/blog/{{$value->id}}">{{$value->ten_chuyen_muc}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </li>
                        @foreach ($danhMuc as $value)
                            @if ($value->id_danh_muc_cha == 0)
                                <li class="dropdown">
                                    <a class="dropdown-toggle nav-link"
                                        href="/category/{{ $value->id }}">{{ $value->ten_danh_muc }}</a>
                                    <div class="dropdown-menu dropdown-reverse">
                                        @foreach ($danhMuc as $v)
                                            @if ($value->id == $v->id_danh_muc_cha)
                                                <ul>
                                                    <li>
                                                        <ul>
                                                            <li><a class="dropdown-item nav-link nav_item"
                                                                    href="/category/{{ $v->id }}">{{ $v->ten_danh_muc }}</a>
                                                            </li>

                                                        </ul>
                                                    </li>

                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                </li>
                                {{-- <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">{{$value->ten_danh_muc}}</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu">
                                            <li class="mega-menu-col col-lg-9">
                                                <ul class="d-lg-flex">
                                                    @foreach ($danhMuc as $v)
                                                    @if ($value->id == $v->id_danh_muc_cha)
                                                    <li class="mega-menu-col col-lg-9">
                                                        <ul>
                                                            <li class="dropdown-header"><a class="dropdown-item nav-link nav_item"
                                                                href="blog-three-columns.html">{{$v ->ten_danh_muc}}</a></li>

                                                        </ul>
                                                    </li>
                                                    @endif

                                                    @endforeach


                                                </ul>
                                            </li>

                                        </ul>
                                    </div>
                                </li> --}}
                            @endif
                        @endforeach
                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i
                                class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form id="searchsp" action="/search">
                                <input type="text" placeholder="Search" class="form-control" name="query">
                                <button type="submit" class="search_icon"><i
                                        class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <div class="search_overlay"></div>
                    </li>
                    @if (Auth::guard('customer')->check())
                        <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="/client/cart"><i
                                    class="linearicons-cart"></i></a>

                        </li>
                    @endif
                </ul>

                {{-- <div id="cartMini">
                    <ul class="navbar-nav attr-nav align-items-center">
                        @if (Auth::guard('customer')->check())
                            <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#"
                                    data-toggle="dropdown"><i class="linearicons-cart"></i></a>
                                <div class="cart_box dropdown-menu dropdown-menu-right">
                                    <ul class="cart_list" v-for="(value, key) in listCart">
                                        <li>
                                            <a href="#" class="item_remove"><i class="ion-close"
                                                    v-on:click="remove(value.id)"></i></a>
                                            <a href="#"><img v-bind:src="value.hinh_anh_chinh"
                                                    alt="cart_thumb1">@{{ value.ten_san_pham }}</a>
                                            <span class="cart_quantity">@{{ value.so_luong_mua }}<span class="cart_amount">
                                                    <span class="price_symbole"> Giá</span>
                                                    <template v-if="value.gia_khuyen_mai==0">
                                                        <td class="product-subtotal" data-title="Total">
                                                            @{{ formatPrice(donGia(value.gia) * value.so_luong_mua) }} đ
                                                        </td>
                                                    </template>
                                                    <template v-else>
                                                        <td class="product-subtotal" data-title="Total">
                                                            @{{ formatPrice(donGia(value.gia_khuyen_mai) * value.so_luong_mua) }} đ
                                                        </td>
                                                    </template>
                                        </li>
                                    </ul>
                                    <div class="cart_footer">
                                        <p class="cart_buttons"><a href="/client/cart"
                                                class="btn btn-fill-line rounded-0 view-cart">Xem Giỏ Hàng</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div> --}}
                {{-- <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i
                                class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form>
                                <input type="text" placeholder="Search" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i
                                        class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <div class="search_overlay"></div>
                    </li>
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#"
                            data-toggle="dropdown"><i class="linearicons-cart"></i></a>
                        <div class="cart_box dropdown-menu dropdown-menu-right">
                            <ul class="cart_list" id="listCart">
                                <li>

                                </li>

                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span
                                            class="price_symbole">$</span></span>159.00</p>
                                <p class="cart_buttons"><a href="#"
                                        class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="#"
                                        class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>
                            </div>
                        </div>
                    </li>
                </ul> --}}
            </nav>
        </div>
    </div>
</header>
{{-- @include('Client.share.js')
    <script src="/js/app.js"></script>
    <script>
        new Vue({
            el: '#cartMini',
            data: {
                listCart: [],
            },
            created() {
                this.loadTable();
            },
            methods: {
                remove(id) {
                    axios
                        .get('/client/cart/remove/' + id)
                        .then((res) => {
                            //toastr.success("Đã xóa sản phẩm khỏi giỏ hàng");
                            this.loadTable();
                        });
                },
                loadTable() {
                    axios
                        .get('/client/cart/data')
                        .then((res) => {
                            this.listCart = res.data.chiTiet;
                            this.loadTable();
                        });
                },

                totalRequest() {
                    var total = 0;
                    for (var i in this.listCart) {
                        total = total + this.listCart[i].thanh_tien;
                    }
                    return total;
                },

                donGia(x, y) {
                    if (x == 0) {
                        return y;
                    } else {
                        return x;
                    }
                },
                thanhTien(v) {
                    if (v.gia_khuyen_mai == 0) {
                        return this.donGia(v.gia) * v.so_luong_mua;
                    } else {
                        return this.donGia(v.gia_khuyen_mai)* v.so_luong_mua;
                    }
                },

                formatPrice(value) {
                    let val = (value / 1).toFixed(0).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                },

                count() {
                    count = 0;
                    for (var i in this.listCart) {
                        count += 1;
                    }
                    return count;
                }
            },
        });
    </script> --}}
<!-- END HEADER -->
@include('Client.Share.model')
