<!-- START SECTION SHOP -->
<div class="section small_pt pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>Exclusive Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-style1">
                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                        @foreach ($loaiSP as $key => $value)
                            <li class="nav-item">
                                <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="arrival-tab" data-toggle="tab"
                                    href="#arrival_{{ $key }}" role="tab" aria-controls="arrival"
                                    aria-selected="true">{{ $value->ten_danh_muc }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-content">
                    @foreach ($loaiSP as $key => $value)
                        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="arrival_{{ $key }}"
                            role="tabpanel" aria-labelledby="arrival-tab">
                            <div class="row shop_container">
                                @foreach ($sanPham as $key_sp => $value_sp)
                                    @if ($value_sp->id_cha == $value->id)
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <div class="product">
                                                <div class="product_img">
                                                    <a href="shop-product-detail.html">
                                                        <img src="{{ $value_sp->hinh_anh_chinh }}" alt="product_img1">
                                                    </a>
                                                    <div class="product_action_box">
                                                        <ul class="list_none pr_action_btn">
                                                            @if (Auth::guard('customer')->check())
                                                                <li class="add-to-cart"><a class="addToCart"
                                                                        data-id="{{ $value_sp->id }}"><i
                                                                            class="icon-basket-loaded"></i>Mua hàng</a>
                                                                </li>
                                                            @else
                                                                <li class="add-to-cart"><a data-toggle="modal"
                                                                        data-target="#loginModal"><i
                                                                            class="icon-basket-loaded"></i>Mua hàng</a>
                                                                </li>
                                                            @endif

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a
                                                            href="/product/{{ $value_sp->slug_san_pham }}">{{ $value_sp->ten_san_pham }}</a>
                                                    </h6>
                                                    @if ($value_sp->gia_khuyen_mai == 0)
                                                        <span class="price">{{ number_format($value_sp->gia, 0) }}
                                                            đ</span>
                                                    @else
                                                        <div class="product_price">
                                                            <span
                                                                class="price">{{ number_format($value_sp->gia_khuyen_mai, 0) }}
                                                                đ</span>
                                                            <del>{{ number_format($value_sp->gia, 0) }} đ</del>

                                                        </div>
                                                    @endif

                                                    <div class="pr_desc">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Phasellus blandit massa enim. Nullam id varius nunc id
                                                            varius
                                                            nunc.</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->
