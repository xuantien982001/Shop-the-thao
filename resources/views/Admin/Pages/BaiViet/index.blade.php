@extends('Admin.share.master')
@section('title')
    <h1 class="text-center mb-4" style="padding-top: 30px"> Quản lý bài viết</h1>
@endsection
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form id="createBaiViet">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm mới bài viết</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề</label>
                                    <input tabindex="1" class="form-control" name="tieu_de" id="tieu_de" type="text"
                                        placeholder="Nhập tiêu đề bài viết">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Chuyên mục</label>
                                    <select name="chuyenmuc_id" id="chuyenmuc_id" class="form-control">
                                        @foreach ($chuyenMuc as $value)
                                            <option value={{ $value->id }}> {{ $value->ten_chuyen_muc }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên admin</label>
                            <select name="admin_id" id="admin_id" class="form-control">
                                @foreach ($admin as $value)
                                    <option value={{ $value->id }}> {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Nội dung</label>
                                <input tabindex="1" class="form-control" name="noi_dung" id="noi_dung" type="text">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình Ảnh</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-input="hinh_anh" data-preview="holder" class="btn btn-primary lfm">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="hinh_anh" class="form-control" type="text" name="hinh_anh">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary " type="button" data-bs-dismiss="modal">Đóng</button>
                        <button class="btn btn-secondary" id="add" type="submit">Thêm
                            mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">

                        <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search"
                                aria-label="Search" id="searchBaiViet">
                            <div class="input-group-append">
                                <span class="input-group-text red lighten-3" id="basic-text1"><i
                                        class="fas fa-search text-grey" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test"
                            data-bs-target="#exampleModal"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    </div>
                </div>

                <div class="mt-4 table-responsive">
                    <table class="table table-bordered table-responsive" id="listBaiViet">
                        <thead>
                            <tr class="text-center bg-primary text-nowrap">
                                <th scope="col"><b>#</b></th>
                                <th scope="col"><b>Tiêu đề</b></th>
                                <th scope="col"><b>Nội dung</b></th>
                                <th scope="col"><b>Chuyên mục</b></th>
                                <th scope="col"><b>Hình ảnh</b></th>
                                <th scope="col"><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Sửa --}}
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <form id="updateBaiViet">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="exampleModalLabel">Cập Nhật Bài
                                                    Viết
                                                </h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="id" id="id_bai_viet" hidden>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tiêu đề</label>
                                                                <input tabindex="1" class="form-control" name="tieu_de"
                                                                    id="tieu_de_edit" type="text"
                                                                    placeholder="Nhập vào tiêu đề">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nội dung</label>
                                                                <input tabindex="1" class="form-control"
                                                                    name="noi_dung" id="noi_dung_edit" type="text"
                                                                    placeholder="Nhập vào nội dung">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">Chuyên mục</label>
                                                                <select name="chuyenmuc_id" id="chuyenmuc_id_edit"
                                                                    class="form-control">
                                                                    @foreach ($chuyenMuc as $value)
                                                                        <option value={{ $value->id }}>
                                                                            {{ $value->ten_chuyen_muc }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">Hình Ảnh</label>
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <a data-input="thumbnail_edit" data-preview="holder"
                                                                        class="btn btn-primary lfm">
                                                                        <i class="fa fa-picture-o"></i> Choose
                                                                    </a>
                                                                </span>
                                                                <input id="thumbnail_edit" class="form-control"
                                                                    type="text" name="hinh_anh">
                                                            </div>
                                                            <div id="holder" style="margin-top:15px;max-height:100px;">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="button"
                                                            data-bs-dismiss="modal">Đóng</button>
                                                        <button class="btn btn-secondary" id="updateBaiViet" type="submit">Lưu Thay
                                                            Đổi</button>
                                                    </div>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Xoá bài viết</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" id="id_san_pham_delete" hidden>
                                            <div class="alert alert-secondary" role="alert">
                                                <h4 class="alert-heading">Xóa bài viết này!</h4>
                                                <p>Bạn có chắc chắn muốn xóa sản phẩm này không?.</p>
                                                <hr>
                                                <p class="mb-0"><i>Lưu ý: Hành động không thể khôi phục
                                                        lại</i>.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="button"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button id="deleteBaiViet" class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Xóa</button>
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

            $("#createBaiViet").submit(function(e) {

                e.preventDefault();
                var payload = window.getFormData($(this));
                axios
                    .post('/admin-shop/bai-viet/create', payload)
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
            loadData();

            $("body").on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/admin-shop/bai-viet/edit/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            $("#id_bai_viet").val(res.data.id);
                            $("#tieu_de_edit").val(res.data.tieu_de);
                            $("#noi_dung_edit").val(res.data.noi_dung);
                            $("#thumbnail_edit").val(res.data.hinh_anh);
                            $("#chuyenmuc_id_edit").val(res.data.chuyenmuc_id);
                        } else {
                            toastr.error("Đã có lỗi xảy ra!");
                        }
                    },
                });

            });
            $("#updateBaiViet").submit(function(e) {
                e.preventDefault();
                var payload = window.getFormData($(this));
                axios
                    .post('/admin-shop/bai-viet/update', payload)
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
                var bai_viet = $(this).data('id');
                $("#id_bai_viet").val(bai_viet);
            });

            $('#deleteBaiViet').click(function() {
                var id = $("#id_bai_viet").val();
                axios
                    .get('/admin-shop/bai-viet/destroy/' + id)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã xóa thành công!");
                            loadData();
                        } else {
                            toastr.error("Không tồn tại!");
                        }
                    })
            });



            function loadData() {
                axios
                    .get('/admin-shop/bai-viet/data')
                    .then((res) => {
                        var content = '';
                        $.each(res.data.data, function(key, value) {
                            content += '<tr class="text-nowrap text-center bg-light">';
                            content += '<td scope="col" class="text-center"><b>' + (key + 1) +
                                '</b></td>';
                            content += '<td scope="col">' + value.tieu_de + '</td>';
                            content += '<td scope="col">' + value.noi_dung + '</td>';
                            content += '<td scope="col">' + value.ten_chuyen_muc + '</td>';
                            content +=
                                '<td><img class="img-thumbnail" style="width: 50px" src="' +
                                value.hinh_anh + '"></td>';
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
                        $("#listBaiViet tbody").html(content);
                    })

            }
        });
    </script>
@endsection
