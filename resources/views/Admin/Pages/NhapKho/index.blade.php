@extends('Admin.share.master')
@section('title')
    Nhập Kho Sản Phẩm
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="input-group mb-3">
                    <input class="form-control" type="text">
                    <span class="input-group-text">
                        <i class="icofont icofont-ui-zoom-in"></i>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="listNhapKho">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Quần MU</td>
                            <td class="text-center">
                                <button class="btn btn-info">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>DANH SÁCH SẢN PHẨM NHẬP KHO</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="listNhapKho">
                            <thead>
                                <tr class="text-center"></tr>
                                    <th scope="col">#</th>
                                    <th scope="col" >Mã Sản Phẩm</th>
                                    <th scope="col">Tên Sản Phẩm</th>
                                    <th scope="col">Số Lượng</th>
                                    <th scope="col" >Đơn Giá</th>
                                    <th scope="col">Thành Tiền</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i < 5; $i++)
                                <tr>
                                    <th class="text-center">{{ $i }}</th>
                                    <td>Iphone {{ 5 + $i }} Pro Max</td>
                                    <td>Iphone {{ 5 + $i }} Pro Max</td>
                                    <td>
                                        <input type="number" class="form-control">
                                    </td>
                                     <td>20.000.000</td>
                                     <td>200.000.000</td>
                                      <td class="text-center">
                                    <button class="btn btn-danger">Remove</button>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="text-right mt-2">
                        <button id="nhapKho" class="btn btn-primary">Nhập Kho</button>
                    </div> --}}
                </div>
                <div class="card-footer text-end">
                <button class="btn btn-primary" type="button">Nhập Kho Hàng</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(e){
            // var listNhapKho = [];

            // function checkButton()
            // {
            //     var count = listNhapKho.length;
            //     if(count > 0) {
            //         $("#nhapKho").show();
            //     } else {
            //         $("#nhapKho").hide();
            //     }
            // }

            loadSanPham();
            function loadSanPham()
            {
                var html = '';
                $.ajax({
                    url     : '/admin/nhap-kho/list-san-pham',
                    type    : 'get',
                    success : function(res) {
                        var data = res.data;
                        $.each(data, function(key, value) {
                            html += '<tr>';
                            html += '<td>' + value.ten_san_pham + '</td>';
                            html += '<td class="text-right">';
                            html += '<button class="btn btn-info add" data-id="' + value.id + '" data-name="'+ value.ten_san_pham +'">Thêm</button></td></tr>';
                        });
                        $("#listSanPham tbody").html(html);
                    },
                });
            }

            // loadSanPham();
            // checkButton();
            // function loadKho(data)
            // {
            //     var html = '';
            //     $.each(data, function(key, value) {
            //         html += '<tr>';
            //         html += '<th scope="col">'+ (key + 1) +'</th>';
            //         html += '<td class="text-nowrap">'+ value.ten_san_pham +'</td>';
            //         html += '<td>';
            //         html += '<input type="number" required id="so_luong_'+ key +'" class="form-control" placeholder="Số Lượng">';
            //         html += '<input type="hidden" id="id_' + key +'" value='+ value.id +'>';
            //         html += '</td>';
            //         html += '<td>';
            //         html += '<input type="number" min="1000" required id="don_gia_' + key +'" class="form-control" placeholder="Đơn Giá">';
            //         html += '</td>';
            //         html += '<td class="text-right">';
            //         html += '<button class="btn btn-danger delete" data-id="'+ value.id +'">X</button>';
            //         html += '</td>';
            //         html += '</tr>';
            //     });
            //     $("#listNhapKho tbody").html(html);
            // }

            // $('body').on('click', '.add', function() {
            //     var id       = $(this).data('id');
            //     var name     = $(this).data('name');
            //     var san_pham = {
            //         'id'            :   id,
            //         'ten_san_pham'  :   name
            //     };
            //     var res = listNhapKho.findIndex(x => x.id === id);
            //     if(res < 0) {
            //         listNhapKho.push(san_pham);
            //         loadKho(listNhapKho);
            //     } else {
            //         toastr.warning('Sản phẩm đã tồn tại trong phiếu nhập');
            //     }
            //     checkButton();
            // });

            // $('body').on('click', '.delete', function() {
            //     var id = $(this).data('id');
            //     for(var i = 0; i < listNhapKho.length; i++) {
            //         if(listNhapKho[i].id == id) {
            //             listNhapKho.splice(i, 1);
            //             break;
            //         }
            //     }
            //     loadKho(listNhapKho);
            //     checkButton();
            // });

            // $("#nhapKho").click(function(e){
            //     var data = [];
            //     $.each(listNhapKho, function(k, v) {
            //         var id = "#id_" + k;
            //         var sl = "#so_luong_" + k;
            //         var dg = "#don_gia_" + k;
            //         var san_pham_nhap = {
            //             'id'        : $(id).val(),
            //             'so_luong'  : $(sl).val(),
            //             'don_gia'   : $(dg).val(),
            //         };
            //         data.push(san_pham_nhap);
            //     });

            //     var payload = {
            //         'send_data'  : data,
            //     };

            //     $.ajax({
            //         url     :   '/admin/nhap-kho/create',
            //         type    :   'post',
            //         data    :   payload,
            //         success :   function(res) {
            //             if(res.status) {
            //                 toastr.success('Đã nhập kho thành công!');
            //             } else {
            //                 toastr.error('Có lỗi xảy ra!');
            //             }
            //         },
            //     });
            // });

            // $("#search").keyup(function(e){
            //     var name = $("#search").val();
            //     if(name.length == 0) {
            //         loadSanPham();
            //     } else {
            //         var payload = {
            //             'name'  : name,
            //         }
            //         $.ajax({
            //             url     :   '/admin/nhap-kho/search',
            //             type    :   'post',
            //             data    :   payload,
            //             success :   function(res) {
            //                 var html = '';
            //                 var data = res.data;
            //                 $.each(data, function(key, value) {
            //                     html += '<tr>';
            //                     html += '<td>' + value.ten_san_pham + '</td>';
            //                     html += '<td class="text-right">';
            //                     html += '<button class="btn btn-info add" data-id="' + value.id + '" data-name="'+ value.ten_san_pham +'">Thêm</button></td></tr>';
            //                 });
            //                 $("#listSanPham tbody").html(html);
            //             },
            //         });
            //     }
            // });
        });
    </script>
@endsection
