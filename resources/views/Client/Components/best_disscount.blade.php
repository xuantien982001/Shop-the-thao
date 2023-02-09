<!-- START SECTION SHOP -->
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>Best Disscounts</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach ($sanPhamGiam as $key => $value)
                    <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true"
                        data-dots="false" data-nav="true" data-margin="20" data-responsive='{{ $key }}'>
                        @foreach ($sanPhamGiam as $k => $v)
                            <div class="item">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="shop-product-detail.html">
                                            <img src="{{ $v->hinh_anh_chinh }}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                {{-- <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                Add To Cart</a></li> --}}
                                                @if (Auth::guard('customer')->check())
                                                    <li class="add-to-cart"><a class="addToCart"
                                                            data-id="{{ $v->id }}"><i
                                                                class="icon-basket-loaded"></i>Mua hàng</a></li>
                                                @else
                                                    <li class="add-to-cart"><a data-toggle="modal"
                                                            data-target="#loginModal"><i
                                                                class="icon-basket-loaded"></i>Mua hàng</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a
                                                href="/product/{{ $v->slug_san_pham }}">{{ $v->ten_san_pham }}</a></h6>
                                        @if ($v->gia_khuyen_mai == 0)
                                            <span class="price">{{ number_format($v->gia, 0) }} đ</span>
                                        @else
                                            <div class="product_price">
                                                <span class="price">{{ number_format($v->gia_khuyen_mai, 0) }} đ</span>
                                                <del>{{ number_format($v->gia, 0) }} đ</del>

                                            </div>
                                        @endif

                                        <div class="pr_desc">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                                                blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->
