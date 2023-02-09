@extends('Admin.Share.master')
@section('title')
    <h1 class="text-center mb-4" style="padding-top: 30px"> Quản Lý Chuyên Mục</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <form id="createChuyenMuc">
                        <div class="mb-3">
                            <h4 class="form-label">Thêm mới chuyên mục </h4>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên chuyên mục</label>
                            <input tabindex="1" class="form-control" id="ten_chuyen_muc" name="ten_chuyen_muc"
                                type="text" placeholder="Nhập vào tên chuyên mục">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hiển Thị</label>
                            <select name="is_open" class="form-control">
                                <option value=1>Hiển Thị</option>
                                <option value=0>Tạm Tắt</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-secondary" type="submit">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Danh sách Chuyên Mục</h4>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-responsive" id="listChuyenMuc">
                        <thead>
                            <tr class="text-center  bg-primary text-nowrap">
                                <th scope="col"><b>#</b></th>
                                <th scope="col"><b>Tên Chuyên Mục</b></th>
                                <th scope="col"><b>Trạng thái</b></th>
                                <th scope="col"><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Sửa --}}
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form id="updateChuyenMuc">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Chuyên Mục</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="id" id="id_chuyen_muc_edit" hidden >
                                                <div class="mb-3">
                                                    <label class="form-label">Tên chuyên mục</label>
                                                    <input tabindex="1" class="form-control" id="ten_chuyen_muc_edit"
                                                        name="ten_chuyen_muc" type="text"
                                                        placeholder="Nhập vào tên chuyên mục">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Hiển Thị</label>
                                                    <select name="is_open" id="is_open_edit" class="form-control">
                                                        <option value=1>Hiển Thị</option>
                                                        <option value=0>Tạm Tắt</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" type="button"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button id="updateChuyenMuc" class="btn btn-secondary"
                                                        type="submit">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xóa Chuyên Mục</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" id="id_chuyen_muc" hidden>
                                            <div class="alert alert-danger" role="alert">
                                                <h4 class="alert-heading">Xóa Chuyên Mục!</h4>
                                                <p>Bạn có chắc chắn muốn xóa không?.</p>
                                                <hr>
                                                <p class="mb-0"><i>Lưu ý: Hành động không thể khôi phục
                                                        lại</i>.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="button"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button id="deleteChuyenMuc" class="btn btn-danger" data-bs-dismiss="modal"
                                                type="button">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#ten_chuyen_muc").keyup(function() {
                var ten_chuyen_muc = $("#ten_chuyen_muc").val();

            });
            $("#ten_chuyen_muc_edit").keyup(function() {
                var ten_chuyen_muc = $("#ten_chuyen_muc_edit").val();
            });
            $("#createChuyenMuc").submit(function(e) {
                e.preventDefault();
                var payload = window.getFormData($(this));
                axios
                    .post('/admin-shop/chuyen-muc/create', payload)
                    .then((res) => {
                        toastr.success("Đã thêm mới thành công!");
                        loadData();
                    })
                    .catch((res) => {
                        var listError = res.response.data.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    });
            });
            $("body").on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/admin-shop/chuyen-muc/edit/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            $("#id_chuyen_muc_edit").val(res.data.id);
                            $("#ten_chuyen_muc_edit").val(res.data.ten_chuyen_muc);
                            $("#is_open_edit").val(res.data.is_open);
                        } else {
                            toastr.error("Sản phẩm không tồn tại!");
                        }
                    },
                });

            });
            $("#updateChuyenMuc").submit(function(e) {
                e.preventDefault();
                var payload = window.getFormData($(this));
                axios
                    .post('/admin-shop/chuyen-muc/update', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã cập nhật thành công!");
                            loadData();
                        }

                    })
                    .catch((res) => {
                        var listError = res.response.data.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    });
            });
            $('body').on('click', '.delete', function() {
                var chuyen_muc = $(this).data('id');
                $("#id_chuyen_muc").val(chuyen_muc);
            });

            $('#deleteChuyenMuc').click(function() {
                var id = $("#id_chuyen_muc").val();
                axios
                    .get('/admin-shop/chuyen-muc/destroy/' + id)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã xóa thành công!");
                            loadData();
                        } else {
                            toastr.error("Không tồn tại!");
                        }
                    })
            });

            $('body').on('click', '.doiTrangThai', function() {
                var id = $(this).data('id');
                axios
                    .get('/admin-shop/chuyen-muc/update-status/' + id)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã cập nhật trạng thái thành công!");
                            loadData();
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((res) => {
                        var listError = res.response.data.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    });
            });
            loadData();

            function loadData() {
                axios
                    .get('/admin-shop/chuyen-muc/data')
                    .then((res) => {
                        var content = '';
                        $.each(res.data.data, function(key, value) {
                            content += '<tr class="text-nowrap text-center bg-light">';
                            content += '<td scope="col" class="text-center"><b>' + (key + 1) +
                                '</b></td>';
                            content += '<td scope="col">' + value.ten_chuyen_muc + '</td>';
                            content += '<td>';
                            if (value.is_open == 1) {
                                content +=
                                    '<button class="btn btn-success doiTrangThai" data-id="' +
                                    value.id + '">Hiển thị</button>';
                            } else {
                                content +=
                                    '<button class="btn btn-danger doiTrangThai"data-id="' +
                                    value.id + '">Tạm tắt</button>';
                            }
                            content += '</td>';
                            content += '<td class="text-nowrap text-center">';
                            content +=
                                '<button type="button" class="btn edit" data-id="' +
                                value.id +
                                '" data-bs-toggle="modal" style="width: 0px" data-bs-target="#editModal"><i class="fa fa-pencil-square text-primary"style="font-size: 20px"></i></i><span class="ps-3 text-success"></button>';
                            content +=
                                '<button type="button" class="btn delete" data-id="' +
                                value.id +
                                '" data-bs-toggle="modal" style="width: 0px" data-bs-target="#deleteModal" style="margin-left: 10px"><i class="fa fa-trash text-danger"style="font-size: 20px"></i></i><span class="ps-3 text-success"></button>';
                            content += '</td>';
                            content += '</tr>';
                        });
                        $("#listChuyenMuc tbody").html(content);
                    })
            }
        });
    </script>
@endsection
