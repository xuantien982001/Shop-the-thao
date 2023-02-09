<?php

namespace App\Http\Controllers;

use App\Http\Requests\SanPham\CreateSanPhamRequest;
use App\Http\Requests\SanPham\UpdateSanPhamRequest;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function index(){
        $danhMuc = DanhMuc::where('is_open', '=', 1)->get();
        return view('Admin.Pages.SanPham.index',compact('danhMuc'));
    }
    public function store(CreateSanPhamRequest $request){
        $data = $request->all();
        SanPham::create($data);
    }
    public function getData(){
        $sanPham = SanPham::join('danh_mucs','san_phams.ma_danh_muc_id','danh_mucs.id')
                        ->select('san_phams.*','danh_mucs.ten_danh_muc')
                        ->get();
        return response()->json([
            'data' => $sanPham,
        ]);
    }
    public function edit($id){
        $sanPham = SanPham::find($id);
        if($sanPham){
            return response()->json([
                'status'    => true,
                'data'  => $sanPham,
            ]);
        }
        else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
    public function update(UpdateSanPhamRequest $request){
        $sanPham = SanPham::find($request->id);
        $sanPham->ma_san_pham       = $request->ma_san_pham;
        $sanPham->ten_san_pham      = $request->ten_san_pham;
        $sanPham->slug_san_pham     = $request->slug_san_pham;
        $sanPham->ma_danh_muc_id    = $request->ma_danh_muc_id;
        $sanPham->hinh_anh_chinh    = $request->hinh_anh_chinh;
        $sanPham->hinh_anh_phu      = $request->hinh_anh_phu;
        $sanPham->gia               = $request->gia;
        $sanPham->gia_khuyen_mai    = $request->gia_khuyen_mai;
        $sanPham->chi_tiet          = $request->chi_tiet;
        $sanPham->is_open           = $request->is_open;
        $sanPham->so_luong          = $request->so_luong;
        $sanPham->save();
    }
    public function destroy($id){
        $sanPham = SanPham::find($id);
        if($sanPham){
            $sanPham->delete();
            return response()->json([
                'status'    => true,
            ]);
        }
        else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
    public function updateStatus($id){
        $sanPham = SanPham::find($id);
        if ($sanPham) {

            $sanPham->is_open = $sanPham->is_open == 0 ? 1 : 0;
            $sanPham->save();

            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'status'  => false,
            ]);
        }
    }
}
