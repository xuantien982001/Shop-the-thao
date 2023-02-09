@extends('Client.share.master')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>{{$danhMucCha->ten_danh_muc}}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#"></a></li>
                    <li class="breadcrumb-item active">{{$danhMucCha->ten_danh_muc}}</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

 <!-- START SECTION SHOP -->
 <div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="row shop_container loadmore" data-item="8" data-item-show="4"
                    data-finish-message="No More Item to Show" data-btn="Load More">
                    @foreach ($listSanPham as $value)
                        <div class="col-lg-3 col-md-4 col-6 grid_item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="/product/{{ $value->id }}">
                                        <img src="{{ $value->hinh_anh_chinh }}" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">

                                            @if (Auth::guard('customer')->check())
                                                    <li class="add-to-cart"><a  class="addToCart" data-id="{{ $value->id }}"><i
                                                        class="icon-basket-loaded"></i>Mua hàng</a></li>
                                                @else
                                                <li class="add-to-cart"><a data-toggle="modal" data-target="#loginModal"><i
                                                    class="icon-basket-loaded"></i>Mua hàng</a></li>
                                                @endif

                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a
                                            href="/product/{{ $value->slug_san_pham}}">{{ $value->ten_san_pham }}</a>
                                    </h6>
                                    @if ($value->gia_khuyen_mai == 0)
                                    <span class="price">{{ number_format($value->gia, 0) }} đ</span>
                                    @else
                                    <div class="product_price">
                                        <span class="price">{{ number_format($value->gia_khuyen_mai, 0) }} đ</span>
                                        <del>{{ number_format($value->gia, 0) }} đ</del>

                                    </div>
                                    @endif
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit
                                            massa
                                            enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>

                                </div>
                            </div>
                            {{-- <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img  src="assets/images/product_img1.jpg" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                    Add To Cart</a></li>
                                            <li><a href="shop-compare.html" class="popup-ajax"><i
                                                        class="icon-shuffle"></i></a></li>
                                            <li><a href="shop-quick-view.html" class="popup-ajax"><i
                                                        class="icon-magnifier-add"></i></a></li>
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="shop-product-detail.html">{{$value->ten_san_pham}}</a></h6>
                                    <div class="product_price">
                                        <span class="price">$45.00</span>
                                        <del>$55.25</del>
                                        <div class="on_sale">
                                            <span>35% Off</span>
                                        </div>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:80%"></div>
                                        </div>
                                        <span class="rating_num">(21)</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit
                                            massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            <span class="active" data-color="#87554B"></span>
                                            <span data-color="#333333"></span>
                                            <span data-color="#DA323F"></span>
                                        </div>
                                    </div>
                                    <div class="list_product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                    Add To Cart</a></li>
                                            <li><a href="shop-compare.html" class="popup-ajax"><i
                                                        class="icon-shuffle"></i></a></li>
                                            <li><a href="shop-quick-view.html" class="popup-ajax"><i
                                                        class="icon-magnifier-add"></i></a></li>
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>


                        @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
    <!-- END SECTION SHOP -->
@endsection
@include('Client.Share.model')
