<?php

namespace App\Http\Controllers;

use App\Http\Requests\DanhMuc\CreateDanhMucRequest;
use App\Http\Requests\DanhMuc\UpdateDanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DanhMucController extends Controller
{
    public function index()
    {
        $danh_muc_cha = DanhMuc::where('is_open', '=', 1)->get();
        return view('Admin.Pages.DanhMuc.index', compact('danh_muc_cha'));
    }
    public function store(CreateDanhMucRequest $request)
    {
        $data = $request->all();
        DanhMuc::create($data);
        return response()->json([
            'status'    => true,
        ]);
    }
    public function getData()
    {
        $danhMuc = 'SELECT a.*, b.ten_danh_muc as ten_danh_muc_cha
        FROM `danh_mucs` a LEFT JOIN `danh_mucs` b
        on a.id_danh_muc_cha = b.id';
        $data = DB::select($danhMuc);

        $danhMucCha = DanhMuc::where('id_danh_muc_cha', 0)->get(); // trả về 1 array

        return response()->json([
            'data'      => $data,
            'dataCha'   => $danhMucCha,

        ]);
    }
    public function edit($id){
        $danhMuc = DanhMuc::find($id);
        if($danhMuc){
            return response()->json([
                'status'    => true,
                'data'  => $danhMuc,
            ]);
        }
        else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
    public function update(UpdateDanhMucRequest $request){
        $danhMuc = DanhMuc::find($request->id);
        $danhMuc->ma_danh_muc = $request->ma_danh_muc;
        $danhMuc->ten_danh_muc = $request->ten_danh_muc;
        $danhMuc->slug_danh_muc = $request->slug_danh_muc;
        $danhMuc->id_danh_muc_cha = $request->id_danh_muc_cha;
        $danhMuc->is_open = $request->is_open;
        $danhMuc->hinh_anh = $request->hinh_anh;
        $danhMuc->save();
        return response()->json([
            'status'  => true,
        ]);
    }
    public function destroy($id){
        $danhMuc = DanhMuc::find($id);
        if ($danhMuc) {
            $danhMuc->delete();
            return response()->json([
                'status'    => true,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
    public function updateStatus($id){
        $danhMuc = DanhMuc::find($id);
        if ($danhMuc) {

            $danhMuc->is_open = $danhMuc->is_open == 0 ? 1 : 0;
            $danhMuc->save();

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
