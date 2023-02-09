@extends('Admin.Share.master')
@section('title')
    <h1 class="text-center mb-4" style="padding-top: 30px"> Quản Lý Đơn Hàng</h1>
@endsection
@section('content')
    <div id="app">
        <div class="">
            <div class="">
                <div class="card">
                    <div class="card-header">

                        <input type="text" class="form-control" v-model="search" v-on:keyup="searchBill(search)" placeholder="Nhập vào hóa đơn cần tìm">
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr class="bg-primary text-nowrap ">
                                    <th class="text-center"><b>#</b></th>
                                    <th class="text-center"><b>Mã hóa đơn</b></th>
                                    <th class="text-center"><b>Người dùng</b></th>
                                    <th class="text-center"><b>Người nhận</b></th>
                                    <th class="text-center"><b>Ngày</b></th>
                                    <th class="text-center"><b>Tổng Tiền</b></th>
                                    <th class="text-center"><b>Thanh Toán</b></th>
                                    <th class="text-center"><b>Tình Trạng</b></th>
                                    <th class="text-center"><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in listBill" class="bg-light text-nowrap text-center">
                                    <th class="align-middle">@{{ (key + 1) }}</th>
                                    <td class="align-middle">@{{ value.bill_name}}</td>
                                    <td class="align-middle">@{{ value.ho_ten}}</td>
                                    <td class="align-middle">@{{ value.ship_fullname}}</td>
                                    <td class="align-middle">@{{ formatDate(value.created_at) }}</td>
                                    <td class="align-middle">@{{ formatPrice(value.bill_total) }}đ</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="changeOpen(value)" v-if="value.is_payment == 0"
                                            class="btn btn-warning">Chưa thanh toán</button>
                                        <button v-on:click="changeOpen(value)" v-else class="btn btn-success">Đã thanh
                                            toán</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="changeType(value)" v-if="value.is_type == 0"
                                            class="btn btn-info">Đang xử lý</button>
                                        <button v-on:click="changeType(value)" v-else-if="value.is_type == 1"
                                            class="btn btn-warning">Đang vận chuyển</button>
                                        <button v-on:click="changeType(value)" v-else-if="value.is_type == 2"
                                            class="btn btn-success">Đã giao</button>
                                        <button v-on:click="changeType(value)" v-else class="btn btn-danger">Đã hoàn
                                            trả</button>
                                    </td>
                                    {{-- <td class="align-middle">@{{ value.is_payment == 0 ? 'Chưa Thanh Toán' : 'Đã Thanh Toán' }}</td> --}}
                                    {{-- <td class="align-middle">@{{ showType(value.is_type) }}</td> --}}
                                    <td>

                                        <button class="btn btn-outline-primary " v-on:click="chiTiet(value)"
                                            data-bs-toggle="modal" data-bs-target="#editModal">Chi tiết</button>
                                    </td>
                                </tr>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Chi Tiết Bán Hàng</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tên Sản Phẩm</th>
                                    <th class="text-center">Số Lượng</th>
                                    <th class="text-center">Đơn Giá</th>
                                    <th class="text-center">Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in listDetail" class="bg-light">
                                    <th class="align-middle">@{{ (key + 1) }}</th>
                                    <td class="align-middle">@{{ value.ten_san_pham }}</td>
                                    <td class="align-middle">@{{ formatPrice(value.so_luong_mua) }}</td>
                                    <td class="align-middle">@{{ formatPrice(value.don_gia_mua) }}</td>
                                    <td class="align-middle">@{{ formatPrice(value.don_gia_mua * value.so_luong_mua) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered mt-3 bg-primary">
                            <tr>
                                <th>Tên Người Nhận</th>
                                <td>@{{ ship_name }}</td>
                            </tr>
                            <tr>
                                <th>Số Điện Thoại Nhận</th>
                                <td>@{{ ship_phone }}</td>
                            </tr>
                            <tr>
                                <th>Địa Chỉ</th>
                                <td>@{{ ship_add }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> --}}
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <form id="updateSanPham">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Bán Hàng</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="text-center"><b>#</b></th>
                                                    <th class="text-center"><b>Tên Sản Phẩm</b></th>
                                                    <th class="text-center"><b>Hình Ảnh</b></th>
                                                    <th class="text-center"><b>Số Lượng</b></th>
                                                    <th class="text-center"><b>Đơn Giá</b></th>
                                                    <th class="text-center"><b>Thành Tiền</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(value, key) in listDetail" class="bg-light text-center">
                                                    <th class="align-middle">@{{ (key + 1) }}</th>
                                                    <td class="align-middle">@{{ value.ten_san_pham }}</td>
                                                    <td class="align-middle" style="width: 50px;"><img v-bind:src="value.hinh_anh"
                                                        class="img-fluid br-sm shadow-sm" alt="Image title"></td>
                                                    <td class="align-middle">@{{ formatPrice(value.so_luong_mua) }}</td>
                                                    <td class="align-middle">@{{ formatPrice(value.don_gia_mua) }}đ</td>
                                                    <td class="align-middle">@{{ formatPrice(value.don_gia_mua * value.so_luong_mua) }}đ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered mt-3 bg-primary text-center ">
                                            <tr>
                                                <th><b style="color: black;">Tên Người Nhận</b></th>
                                                <td class="bg-light text-center"
                                                    style="color: black;">
                                                    @{{ ship_name }}</td>
                                            </tr>
                                            <tr>
                                                <th><b style="color: black;">Số Điện Thoại Nhận</b></th>
                                                <td class="bg-light text-center"
                                                    style="color: black;">
                                                    @{{ ship_phone }}</td>
                                            </tr>
                                            <tr>
                                                <th><b style="color: black;">Địa Chỉ</b></th>
                                                <td class="bg-light text-center"
                                                    style="color: black;">
                                                    @{{ ship_add }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                listBill: [],
                listDetail: [],
                listsearchBill:[],
                ship_name: '',
                ship_phone: '',
                ship_add: '',
                search: '',

            },
            created() {
                this.getData();
                // this.searchBill();
                //this.searchBill();
            },
            methods: {
                changeOpen(a) {
                    axios
                        .post('/admin-shop/hoa-don-ban-hang/change-status', a)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success("Đã Thay Đổi Trạng Thái!");
                                this.getData();
                            } else {
                                toastr.error("Thanh toán lỗi!");
                            }
                        })
                        .catch((res) => {
                            var errors = res.response.data.errors;
                            $.each(errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                changeType(x) {
                    axios
                        .post('/admin-shop/hoa-don-ban-hang/change-type', x)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success("Đã Thay Đổi Trạng Thái!");
                                this.getData();
                            } else {
                                toastr.error("Thanh toán lỗi!");
                            }

                        })
                        .catch((res) => {
                            var errors = res.response.data.errors;
                            $.each(errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                getData() {
                    axios
                        .get('/admin-shop/hoa-don-ban-hang/data')
                        .then((res) => {
                            this.listBill = res.data.bill;
                        });
                },
                chiTiet(value) {
                    this.ship_name = value.ship_fullname;
                    this.ship_phone = value.ship_phone;
                    this.ship_add = value.ship_address;
                    axios
                        .get('/admin-shop/hoa-don-ban-hang/detail/' + value.id)
                        .then((res) => {
                            this.listDetail = res.data.chiTiet;
                        });
                },
                // showType(type) {
                //     if (type == 0) {
                //         return 'Đang xử lý';
                //     } else if (type == 1) {
                //         return 'Đang vận chuyển';
                //     } else if (type == 2) {
                //         return 'Đã thành công';
                //     } else {
                //         return 'Đã hoàn trả';
                //     }
                // },
                searchBill(){
                    var payload ={
                        'search': this.search,
                    };
                    console.log(payload);
                    axios
                        .post('/admin-shop/hoa-don-ban-hang/search', payload)
                        .then((res) => {
                            this.listBill = res.data.bill;
                        });
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
                formatPrice(value) {
                    let val = (value / 1).toFixed(0).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                },
            },
        });
    </script>
@endsection
