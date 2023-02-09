@extends('Client.Share.master')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>{{ Auth::guard('customer')->user()->ho_ten }}</h1>
                    <div class="text-muted">{{ Auth::guard('customer')->user()->email }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>

                    <li class="breadcrumb-item active">{{ Auth::guard('customer')->user()->ho_ten }}</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- START SECTION SHOP -->
<div id="app">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="dashboard_menu">
                        <ul class="nav nav-tabs flex-column" role="tablist">
                            {{-- <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Dashboard</a>
                        </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab"
                                    aria-controls="orders" aria-selected="false"><i
                                        class="ti-shopping-cart-full"></i>Dặt hàng</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                    aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i>My
                                    Address</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account-detail"
                                    role="tab" aria-controls="account-detail" aria-selected="true"><i
                                        class="ti-id-badge"></i>Account details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.html"><i class="ti-lock"></i>Logout</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content dashboard_content">

                        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <div class="accordion br-sm" id="accordionOrdersExample">
                                <div class="card-header">
                                    <h3>Đơn đặt hàng </h3>
                                </div>

                                <template v-for="(value, key) in listBill">
                                    <div class="card card-fill mb-3 shadow-sm rounded">
                                        <div class="card-header bg-white py-4 p-2 p-md-4 pointer" id="heading-1"
                                            role="button" data-toggle="collapse" v-bind:data-target="'#a'+key"
                                            aria-expanded="true" v-bind:aria-controls="'a'+key">
                                            <div class="row">
                                                <div class="col-md-3 text-nowrap">
                                                    <i class="icon icon-tag mr-3"></i>
                                                    <span>@{{ value.bill_name }}</span>
                                                </div>
                                                <div class="col-6 col-md-3 text-nowrap">
                                                    <i class="icon icon-clock mr-3"></i>
                                                    <span>@{{ formatDate(value.created_at) }}</span>
                                                </div>
                                                <div class="col-6 col-md-2 text-right text-nowrap">
                                                    <span>@{{ formatPrice(value.bill_total) }} VNĐ</span>
                                                </div>
                                                <div class="col-md-2 text-nowrap text-center">
                                                    <small v-if="value.is_payment == 0"
                                                        class="p-1 bg-light-danger rounded-sm text-warning  btn-block">
                                                        Chưa Thanh Toán
                                                    </small>
                                                    <small v-else class="p-1 bg-light-primary text-success rounded-sm  btn-block">
                                                        Đã Thanh Toán
                                                    </small>
                                                </div>
                                                <div class="col-md-2 text-nowrap text-center">
                                                    <small v-if="value.is_type == 0"
                                                        class="p-1 bg-light-danger rounded-sm text-infor  btn-block">
                                                        Đang xử lý
                                                    </small>
                                                    <small v-if="value.is_type == 1"
                                                        class="p-1 bg-light-danger rounded-sm text-waring  btn-block">
                                                        Đang vận chuyển
                                                    </small>
                                                    <small v-if ="value.is_type == 2" class="p-1 bg-light-primary text-success rounded-sm  btn-block">
                                                        Đã giao hàng
                                                    </small>
                                                </div>
                                                <div class="col-md-2 text-center pt-3 pt-xl-0 text-end">
                                                    <small class="p-1  rounded-sm  btn-block"
                                                        style="
                                                background: #26d24c;color: #1600ff; margin-left: 660px;">
                                                        Xem chi tiết
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-bind:id="'a'+key" class="collapse pt-0" aria-labelledby="heading-1"
                                            data-parent="#accordionOrdersExample">
                                            <hr class="m-0">
                                            <div class="card-body bg-white">
                                                <template v-if="value.id == value_sp.id_don_hang"
                                                    v-for="(value_sp, key_sp) in listOrder">
                                                    <div class="mb-3 mb-lg-4 bg-light shadow-sm px-4 py-3">
                                                        <div class="row align-items-center no-gutters p-md-2">
                                                            <div class="col-lg-2">
                                                                <img v-bind:src="value_sp.hinh_anh"
                                                                    class="img-fluid br-sm shadow-sm" alt="Image title">
                                                            </div>
                                                            <div class="col-lg-5 pl-lg-3 py-2 py-lg-0">
                                                                <div><strong>@{{ value_sp.ten_san_pham }}</strong></div>
                                                                <small class="text-muted">@{{ value_sp.ten_danh_muc }}</small>
                                                            </div>
                                                            <div class="col-6 col-lg-2">
                                                                <div><small class="pre-label text-center">Số Lượng</small></div>
                                                                <p class="text-center">@{{ value_sp.so_luong_mua }}</p>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-right">
                                                                <div><small class="pre-label">Tổng Tiền</small></div>
                                                                <span>@{{ formatPrice(thanhTien(value_sp)) }} đ</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                {{-- <div class="alert alert-warning" role="alert">

                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mb-3 mb-lg-0">
                                        <div class="card-header">
                                            <h3>Billing Address</h3>
                                        </div>
                                        <div class="card-body">
                                            <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212
                                            </address>
                                            <p>New York</p>
                                            <a href="#" class="btn btn-fill-out">Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Shipping Address</h3>
                                        </div>
                                        <div class="card-body">
                                            <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212
                                            </address>
                                            <p>New York</p>
                                            <a href="#" class="btn btn-fill-out">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-detail" role="tabpanel"
                            aria-labelledby="account-detail-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Account Details</h3>
                                </div>
                                <div class="card-body">
                                    <p>Already have an account? <a href="#">Log in instead!</a></p>
                                    <form method="post" name="enq">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>First Name <span class="required">*</span></label>
                                                <input required="" class="form-control" name="name"
                                                    type="text">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input required="" class="form-control" name="phone">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Display Name <span class="required">*</span></label>
                                                <input required="" class="form-control" name="dname"
                                                    type="text">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input required="" class="form-control" name="email"
                                                    type="email">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Current Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="password"
                                                    type="password">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>New Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="npassword"
                                                    type="password">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Confirm Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="cpassword"
                                                    type="password">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill-out" name="submit"
                                                    value="Submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                listOrder: [],
                listBill: [],
            },
            created() {
                this.getData();
                this.getBill();
            },
            methods: {
                getData() {
                    axios
                        .get('/client/bill/order')
                        .then((res) => {
                            this.listOrder = res.data.listOrder;
                        });
                },

                getBill() {
                    axios
                        .get('/client/all-bill')
                        .then((res) => {
                            this.listBill = res.data.listBill;
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
                    return this.donGia(v.don_gia_mua, v.gia_khuyen_mai) * v.so_luong_mua;
                },

                formatDate(datetime) {
                    const input = datetime;
                    const dateObj = new Date(input);
                    const year = dateObj.getFullYear();
                    const month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
                    const date = dateObj.getDate().toString().padStart(2, '0');

                    const result = `${date}/${month}/${year}`;

                    return result;
                },

                totalRequest() {
                    return this.listCart.reduce((acc, item) => acc + this.thanhTien(item), 0);
                },

                formatPrice(value) {
                    let val = (value / 1).toFixed(0).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                }
            },
        });
    </script>
@endsection
