@extends('Admin.Share.master')
@section('title')
    <h1 class="text-center mb-4" style="padding-top: 30px"> Quản Lý Loại Danh Mục</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <form id="createDanhMuc">
                        <div class="mb-3">
                            <h4 class="form-label">Thêm mới danh mục </h4>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mã danh mục</label>
                            <input tabindex="1" class="form-control" id="ma_danh_muc" name="ma_danh_muc" type="text"
                                placeholder="Nhập vào mã danh mục">
                            <small class="text-danger" id="message_ma_danh_muc"><i></i></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input tabindex="1" class="form-control" id="ten_danh_muc" name="ten_danh_muc" type="text"
                                placeholder="Nhập vào tên danh mục">
                            <small class="text-danger" id="message_ten_danh_muc"><i></i></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug danh mục</label>
                            <input class="form-control" id="slug_danh_muc" name="slug_danh_muc" type="text"
                                placeholder="Nhập vào slug danh mục">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select name="id_danh_muc_cha" id="id_danh_muc_cha" class="form-control">

                                <option value=0>Root</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hình Ảnh</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-input="thumbnail" data-preview="holder" class="btn btn-primary lfm">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="hinh_anh">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                            </div>
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
                    <h4 class="text-center">Danh sách Danh Mục</h4>
                </div>
                <div class="card-header">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search"
                            aria-label="Search" id="searchDanhMuc">
                        <div class="input-group-append">
                            <span class="input-group-text red lighten-3" id="basic-text1"><i
                                    class="fas fa-search text-grey" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-responsive" id="listDanhMuc">
                        <thead>
                            <tr class="text-center  bg-primary text-nowrap">
                                <th scope="col"><b>#</b></th>
                                <th scope="col"><b>Mã Danh Mục</b></th>
                                <th scope="col"><b>Tên Danh Mục</b></th>
                                <th scope="col"><b>Danh Mục Cha</b></th>
                                <th scope="col"><b>Hình Ảnh</b></th>
                                <th scope="col"><b>Trạng thái</b></th>
                                <th scope="col"><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Sửa --}}
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form id="updateDanhMuc">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Danh Mục</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="id" id="id_danh_muc_edit" hidden>
                                                <div class="mb-3">
                                                    <label class="form-label">Mã danh mục</label>
                                                    <input tabindex="1" class="form-control" id="ma_danh_muc_edit"
                                                        name="ma_danh_muc" type="text" placeholder="Nhập vào mã loại">
                                                    <small class="text-danger"
                                                        id="message_ma_danh_muc_edit"><i></i></small>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tên danh mục</label>
                                                    <input tabindex="1" class="form-control" id="ten_danh_muc_edit"
                                                        name="ten_danh_muc" type="text"
                                                        placeholder="Nhập vào tên lọai">
                                                    <small class="text-danger"
                                                        id="message_ten_danh_muc_edit"><i></i></small>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Slug danh mục</label>
                                                    <input class="form-control" id="slug_danh_muc_edit"
                                                        name="slug_danh_muc" type="text"
                                                        placeholder="Nhập vào slug sản phẩm">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Danh mục cha</label>
                                                    <select name="id_danh_muc_cha" id="id_danh_muc_cha_edit"
                                                        class="form-control">

                                                        <option value=0>Root</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Hình Ảnh</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a data-input="thumbnail_edit" data-preview="holder"
                                                                class="btn btn-primary lfm">
                                                                <i class="fa fa-picture-o"></i> Choose
                                                            </a>
                                                        </span>
                                                        <input id="thumbnail_edit" class="form-control" type="text"
                                                            name="hinh_anh">
                                                    </div>
                                                    <div id="edit_holder" style="margin-top:15px;max-height:100px;">
                                                    </div>
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
                                                    <button id="updateLoaisp" class="btn btn-secondary"
                                                        type="submit">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Xóa --}}
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xóa Danh Mục</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" id="id_danh_muc" hidden>
                                            <div class="alert alert-danger" role="alert">
                                                <h4 class="alert-heading">Xóa Danh Mục!</h4>
                                                <p>Bạn có chắc chắn muốn xóa không?.</p>
                                                <hr>
                                                <p class="mb-0"><i>Lưu ý: Hành động không thể khôi phục
                                                        lại</i>.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="button"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button id="deleteDanhMuc" class="btn btn-danger" data-bs-dismiss="modal"
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
        $('.lfm').filemanager('image', {
            prefix: '/laravel-filemanager'
        });
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            function converToSlug(str) {
                str = str.toLowerCase();

                str = str
                    .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                    .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp

                // Thay ký tự đĐ
                str = str.replace(/[đĐ]/g, 'd');

                // Xóa ký tự đặc biệt
                str = str.replace(/([^0-9a-z-\s])/g, '');

                // Xóa khoảng trắng thay bằng ký tự -
                str = str.replace(/(\s+)/g, '-');

                // Xóa ký tự - liên tiếp
                str = str.replace(/-+/g, '-');

                // xóa phần dư - ở đầu & cuối
                str = str.replace(/^-+|-+$/g, '');

                // return
                return str;
            };


            $("#ten_danh_muc").keyup(function() {
                var ten_danh_muc = $("#ten_danh_muc").val();
                var slug = converToSlug(ten_danh_muc);
                $("#slug_danh_muc").val(slug);
            });
            $("#ten_danh_muc_edit").keyup(function() {
                var ten_danh_muc = $("#ten_danh_muc_edit").val();
                var slug = converToSlug(ten_danh_muc);
                $("#slug_danh_muc_edit").val(slug);
            });
            $("#createDanhMuc").submit(function(e) {
                e.preventDefault();
                var payload = window.getFormData($(this));
                axios
                    .post('/admin-shop/danh-muc/create', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã thêm mới thành công!");
                            $('#createDanhMuc').trigger('reset');
                            loadListDanhMuc();
                        }

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
                    url: '/admin-shop/danh-muc/edit/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            $("#id_danh_muc_edit").val(res.data.id);
                            $("#ma_danh_muc_edit").val(res.data.ma_danh_muc);
                            $("#ten_danh_muc_edit").val(res.data.ten_danh_muc);
                            $("#slug_danh_muc_edit").val(res.data.slug_danh_muc);
                            $("#id_danh_muc_cha_edit").val(res.data.id_danh_muc_cha);
                            $("#is_open_edit").val(res.data.is_open);
                            var a = res.data.hinh_anh.split(',');
                            var html_hinh_anh = '';
                            for (i = 0; i < a.length; i++) {
                                html_hinh_anh += '<img src="' + a[i] +
                                    '" style="height: 5rem;">';
                            }
                            $("#edit_holder").html(html_hinh_anh);
                            $("#thumbnail_edit").val(res.data.hinh_anh);
                        } else {
                            toastr.error("Sản phẩm không tồn tại!");
                        }
                    },
                });

            });
            $("#updateDanhMuc").submit(function(e) {
                e.preventDefault();
                var payload = window.getFormData($(this));
                axios
                    .post('/admin-shop/danh-muc/update', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã cập nhật thành công!");
                            loadListDanhMuc();
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
                var danh_muc = $(this).data('id');
                $("#id_danh_muc").val(danh_muc);
            });

            $('#deleteDanhMuc').click(function() {
                var id = $("#id_danh_muc").val();
                axios
                    .get('/admin-shop/danh-muc/destroy/' + id)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã xóa thành công!");
                            loadListDanhMuc();
                        } else {
                            toastr.error("Không tồn tại!");
                        }
                    })
            });

            $('body').on('click', '.doiTrangThai', function() {
                var id = $(this).data('id');
                axios
                    .get('/admin-shop/danh-muc/update-status/' + id)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã cập nhật trạng thái thành công!");
                            loadListDanhMuc();
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

            function loadDanhMucCha(listDanhMucCha) {
                var html_danh_muc_cha = "<option value=0>Root</option>";
                $.each(listDanhMucCha, function(key, value) {
                    html_danh_muc_cha = html_danh_muc_cha + '<option value=' + value.id + '>' + value
                        .ten_danh_muc + '</option>';
                });
                $("#id_danh_muc_cha").html(html_danh_muc_cha);
                $("#id_danh_muc_cha_edit").html(html_danh_muc_cha);
            }

            function loadListDanhMuc() {
                axios
                    .get('/admin-shop/danh-muc/data')
                    .then((res) => {
                        viewTable(res.data.data);
                        loadDanhMucCha(res.data.dataCha);
                    })
            }

            function viewTable(listDanhMuc) {
                var content = '';
                $.each(listDanhMuc, function(key, value) {
                    content += createRow(value, key + 1);
                });
                $("#listDanhMuc tbody").html(content);
            }
            loadListDanhMuc();

            function createRow(danhMuc, stt) {
                var content = '';

                content += '<tr class="align-middle text-center text-nowrap">';
                content += '<th scope="row" class="text-center">' + stt + '</th>';
                content += '<td>' + danhMuc.ma_danh_muc + '</td>';
                content += '<td>' + danhMuc.ten_danh_muc + '</td>';
                content += '<td>' + danhMuc.ten_danh_muc_cha + '</td>';
                content +='<td><img class="img-thumbnail" style="width: 50px" src="' +danhMuc.hinh_anh + '"></td>';
                content += '<td class="text-center">';
                if (danhMuc.is_open) {
                    content += '<button class="btn btn-success doiTrangThai" data-id="' + danhMuc.id +
                        '"> Hiển Thị';
                } else {
                    content += '<button class="btn btn-danger doiTrangThai" data-id="' + danhMuc.id + '"> Tạm Tắt';
                }
                content += '</button>';
                content += '</td>';
                content += '<td>';
                content += '<button class="btn edit" data-id="' + danhMuc.id +
                    '" style="width: 0px" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil-square text-primary"style="font-size: 20px"></i></i><span class="ps-3 text-success"></button>';
                content += '<button class="btn delete" data-id="' + danhMuc.id +
                    '" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash text-danger"style="font-size: 20px"></i></i><span class="ps-3 text-success"></button>';
                content += '</td>';
                content += '</tr>';

                return content;
            }
        });
    </script>
@endsection
