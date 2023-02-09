<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChuyenMuc\CreateChuyenMucRequest;
use App\Http\Requests\ChuyenMuc\UpdateChuyenMucRequest;
use App\Models\ChuyenMuc;
use Illuminate\Http\Request;

class ChuyenMucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Pages.ChuyenMuc.index',);
    }

    public function store(CreateChuyenMucRequest $request)
    {
        $data = $request->all();
        ChuyenMuc::create($data);
        return response()->json([
            'status'    => true,
        ]);
    }

    public function getData()
    {
        $chuyenMuc = ChuyenMuc::select('chuyen_mucs.*')->get();
        return response()->json([
            'data' => $chuyenMuc,
        ]);
    }

    public function updateStatus($id)
    {
        $chuyenMuc = ChuyenMuc::find($id);
        if ($chuyenMuc) {

            $chuyenMuc->is_open = $chuyenMuc->is_open == 0 ? 1 : 0;
            $chuyenMuc->save();

            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'status'  => false,
            ]);
        }
    }


    public function edit($id)
    {
        $chuyenMuc = ChuyenMuc::find($id);
        //dd($chuyenMuc);
        if ($chuyenMuc) {
            return response()->json([
                'status'    => true,
                'data'  => $chuyenMuc,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }


    public function update(UpdateChuyenMucRequest $request)
    {
        $chuyenMuc = ChuyenMuc::find($request->id);
        $chuyenMuc->ten_chuyen_muc = $request->ten_chuyen_muc;
        $chuyenMuc->is_open = $request->is_open;
        $chuyenMuc->save();
        return response()->json([
            'status'  => true,
        ]);
    }


    public function destroy($id)
    {
        $chuyen_muc = ChuyenMuc::find($id);
        if ($chuyen_muc) {
            $chuyen_muc->delete();
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
