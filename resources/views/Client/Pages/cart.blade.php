@extends('Client.share.master')
@section('content')
    <div id="app">
        <!-- START SECTION BREADCRUMB -->
        <div class="breadcrumb_section bg_gray page-title-mini">
            <div class="container">
                <!-- STRART CONTAINER -->
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-title">
                            <h1>Giỏ Hàng</h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Giỏ Hàng</li>
                        </ol>
                    </div>
                </div>
            </div><!-- END CONTAINER-->
        </div>
        <!-- END SECTION BREADCRUMB -->
        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive shop_cart_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product"></th>
                                        <th class="product">Hình ảnh</th>
                                        <th class="product">Dịch vụ</th>
                                        <th class="product">Giá</th>
                                        <th class="product">Số lượng</th>
                                        <th class="product">Tổng tiền</th>
                                        <th class="product">Xóa</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(value, key) in listCart">
                                        <td><input type="checkbox" class="form-control" v-model="value.check" /></td>
                                        <td class="product-thumbnail"><a><img v-bind:src="value.hinh_anh_chinh"></a></td>
                                        <td class="product-name" data-title="Product"><a
                                                :href="'/product/' + value.id_san_pham">@{{ value.ten_san_pham }}</a></td>
                                        <template v-if="value.gia_khuyen_mai==0">
                                            <td class="product-price" data-title="Price">@{{ formatPrice(donGia(value.gia)) }} đ</td>
                                        </template>
                                        <template v-else>
                                            <td class="product-price" data-title="Price">@{{ formatPrice(donGia(value.gia_khuyen_mai)) }} đ</td>
                                        </template>

                                        <td>
                                            <input v-on:change="update(value)" v-model="value.so_luong_mua" type="number"
                                                class="form-control text-center" style="margin-left: 50px; width: 160px;" />
                                            {{-- <input type="number" v-on:change="update(value)" v-model="value.so_luong_mua" class="form-control" /> --}}
                                        </td>
                                        <template v-if="value.gia_khuyen_mai==0">
                                            <td class="product-subtotal" data-title="Total">@{{ formatPrice(donGia(value.gia) * value.so_luong_mua) }} đ</td>
                                        </template>
                                        <template v-else>
                                            <td class="product-subtotal" data-title="Total">@{{ formatPrice(donGia(value.gia_khuyen_mai) * value.so_luong_mua) }} đ</td>
                                        </template>

                                        <td class="product-remove"><a><i class="ti-close"
                                                    v-on:click="remove(value.id)"></i></a></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="medium_divider"></div>
                        <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-8">
                        <div class="border p-3 p-md-4">
                            <div class="heading_s1 mb-3">
                                <h6>Thông tin đặt hàng</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_amount"><input required="required" placeholder="Họ và tên"
                                                    class="form-control" v-model="ship_fullname" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_amount"><input required="required"
                                                    placeholder="Số điện thoại" class="form-control" v-model="ship_phone"
                                                    type="number"></td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_amount"><input required="required" placeholder="Địa chỉ"
                                                    class="form-control" v-model="ship_address" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Tổng Tiền</td>
                                            <td class="cart_total_amount"><strong>@{{ formatPrice(totalRequest()) }} VNĐ</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                           <button class="btn btn-fill-out" v-on:click="createBill()">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                listCart: [],
                ship_phone: '',
                ship_fullname: '',
                ship_address: '',
            },
            created() {
                this.getData();
            },
            methods: {
                getData() {
                    axios
                        .get('/client/cart/data')
                        .then((res) => {

                            this.listCart = res.data.chiTiet;
                        });
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
                totalRequest() {
                    var total = 0;
                    for (var i in this.listCart) {
                        if (this.listCart[i]['check'] == true) {
                            total = total + this.thanhTien(this.listCart[i]);
                        }
                    }
                    return total;
                },
                remove(id) {
                    axios
                        .get('/client/cart/remove/' + id)
                        .then((res) => {
                            toastr.success("Đã xóa sản phẩm khỏi giỏ hàng");
                            this.getData();
                        });
                },
                update(x) {
                    axios
                        .post('/client/cart/update', x)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.getData();
                            } else {
                                toastr.warning(res.data.message);
                                this.getData();
                            }

                        })
                        .catch((res) => {
                            var listError = res.response.data.errors;
                            $.each(listError, function(key, value) {
                                toastr.error(value[0]);
                            });
                            x.so_luong_mua = 1;
                        });
                },


                createBill() {
                    var payload = {
                        ship_phone: this.ship_phone,
                        ship_fullname: this.ship_fullname,
                        ship_address: this.ship_address,
                        list_cart: this.listCart,
                    };
                    // console.log(payload);
                    axios
                        .post('/client/bill/create', payload)
                        .then((res) => {
                            toastr.success('Đã tạo đơn hàng thành công!');
                           //window.location.href('/checkout/'+ bill_name);
                                window.location.reload();
                        })
                        .catch((res) => {
                            var listError = res.response.data.errors;
                            $.each(listError, function(key, value) {
                                toastr.error(value[0]);
                            });
                        });

                },
                formatPrice(value) {
                    let val = (value / 1).toFixed(0).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                },
            },
        });
    </script>
@endsection
