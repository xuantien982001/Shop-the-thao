<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaiViet\CreateBaiVietRequest;
use App\Http\Requests\BaiViet\UpdateBaivietRequest;
use App\Models\Admin;
use App\Models\BaiViet;
use App\Models\ChuyenMuc;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{

    public function index()
    {
        $chuyenMuc = ChuyenMuc::where('is_open', '=',1)->get();
        $admin = Admin::where('is_block', '=',0)->get();
        return view('Admin.Pages.BaiViet.index',compact('chuyenMuc','admin'));
    }

    public function store(CreateBaiVietRequest $request)
    {
        $data = $request->all();
        BaiViet::create($data);
        return response()->json([
            'status'    => true,
        ]);
    }

    public function getData(){
        $baiViet = BaiViet::join('chuyen_mucs','bai_viets.chuyenmuc_id','chuyen_mucs.id')
        ->join('admins','bai_viets.admin_id','admins.id')
                        ->select('bai_viets.*','chuyen_mucs.ten_chuyen_muc','admins.name')
                        ->get();
        return response()->json([
            'data' => $baiViet,
        ]);
    }



    public function edit($id)
    {
        $baiViet = BaiViet::find($id);
        if ($baiViet) {
            return response()->json([
                'status'    => true,
                'data'  => $baiViet,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }


    public function update(UpdateBaivietRequest $request)
    {
        $baiViet = BaiViet::find($request->id);
        $baiViet->tieu_de = $request->tieu_de;
        $baiViet->noi_dung = $request->noi_dung;
        $baiViet->chuyenmuc_id = $request->ten_chuyen_muc;
        $baiViet->save();
        return response()->json([
            'status'  => true,
        ]);
    }


    public function destroy($id)
    {
        $baiViet = BaiViet::find($id);
        if ($baiViet) {
            $baiViet->delete();
            return response()->json([
                'status'    => true,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }
}
