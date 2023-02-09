<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoaDon\CreateHoaDonRequest;
use App\Models\ChiTietDonHang;
use App\Models\HoaDon;
use App\Models\SanPham;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HoaDonController extends Controller
{
    public function admin_index(){
        return view('Admin.Pages.DonHang.index');
    }
    public function getData()
    {
        $data = HoaDon::join('khach_hangs','hoa_dons.customer_id','khach_hangs.id')
        ->select('hoa_dons.*','khach_hangs.ho_ten')
        ->orderBy('hoa_dons.created_at', 'desc')->get();

        return response()->json([
            'bill'  => $data,
        ]);
    }
    public function store(CreateHoaDonRequest $request)
    {
        DB::beginTransaction();
        try {
            $list_cart = [];

            foreach($request->list_cart as $value){
                if(isset($value['check'])){
                    array_push($list_cart, $value);
                }
            }

            if(count($list_cart) > 0) {
                $cutommer = Auth::guard('customer')->user();

                $bill = HoaDon::create([
                    'ship_fullname'     => $request->ship_fullname,
                    'ship_address'      => $request->ship_address,
                    'ship_phone'        => $request->ship_phone,
                    'customer_id'       => $cutommer->id,
                    'customer_fullname' => $cutommer->ho_ten,
                    'customer_phone'    => $cutommer->so_dien_thoai,
                    'customer_email'    => $cutommer->email,
                ]);

                $check    = true;
                $tongTien = 0;

                $gioHang = ChiTietDonHang::whereNull('id_don_hang')->where('id_khach_hang', $cutommer->id)->get();
                // dd($gioHang->toArray(), $list_cart);
                foreach($gioHang as $key => $value) {
                    foreach($list_cart as $value_cart) {
                        // dd($value->id, $value_cart['id']);
                        if($value->id == $value_cart['id']) {
                            $sanPham = SanPham::find($value->id_san_pham);
                            if($sanPham && $sanPham->is_open == true && $sanPham->so_luong >= $value->so_luong_mua) {
                                $donGia = $sanPham->gia_khuyen_mai == 0 ? $sanPham->gia : $sanPham->gia_khuyen_mai;
                                $value->ten_san_pham = $sanPham->ten_san_pham;
                                $value->don_gia_mua  = $donGia;
                                $value->hinh_anh     = $sanPham->hinh_anh_chinh;
                                $value->id_don_hang  = $bill->id;

                                $value->save();

                                $tongTien += $donGia * $value->so_luong_mua;
                            } else {
                                $check = false;
                            }
                            $sanPham->so_luong = $sanPham->so_luong - $value->so_luong_mua;
                            $sanPham->save();
                        }
                    }
                    // dd('here');
                }
                $bill->bill_name  = "HDĐH" . (10000 + $bill->id);
                $bill->bill_total = $tongTien;
                $bill->save();

                if($check) {
                    DB::commit();
                } else {
                    DB::rollBack();
                }
            }
        } catch(Exception $e) {
            DB::rollBack();
        }
    }
    public function index(){
        return view('Client.Pages.my_account');
    }
    public function listOrder(){
        $cutommer = Auth::guard('customer')->user();
        $listOrder = HoaDon::join('chi_tiet_don_hangs', 'hoa_dons.id', 'chi_tiet_don_hangs.id_don_hang')
                            ->join('san_phams', 'chi_tiet_don_hangs.id_san_pham', 'san_phams.id')
                            ->join('danh_mucs', 'san_phams.ma_danh_muc_id', 'danh_mucs.id')
                            ->where('id_khach_hang', $cutommer->id)
                            ->select('chi_tiet_don_hangs.*', 'hoa_dons.bill_total', 'danh_mucs.ten_danh_muc')
                            ->get();

        return response()->json(['listOrder' => $listOrder]);
    }
    public function listBill()
    {
        $listBill = HoaDon::orderBy('hoa_dons.created_at', 'desc')->get();

        return response()->json(['listBill' => $listBill]);
    }
    public function viewAnalytic($begin, $end)
    {
        $data = HoaDon::select(DB::raw('date(created_at) as date'),  DB::raw('sum(bill_total) as total'))
                             ->whereDate('created_at', '>=', $begin)
                             ->whereDate('created_at', '<=', $end)
                             ->groupBy('date')
                             ->get();

        return $data;
    }

    public function analytic()
    {

        $end     = Carbon::now();
        $begin   = Carbon::now()->subDays(10);

        $data    = $this->viewAnalytic($begin, $end);

        $labels  = [];
        $data_js = [];
        foreach ($data as $key => $value) {
            array_push($labels,  $value->date);
            array_push($data_js, $value->total);
        }

    // dd($data->toArray(), $labels, $data_js);

    return view('Admin.Pages.ThongKe.index', compact('begin', 'end', 'data', 'labels', 'data_js'));
    }

    public function analyticPost(Request $request)
     {
        $end    = $request->end_date;
        $begin  = $request->from_date;

        $data    = $this->viewAnalytic($begin, $end);

        $labels  = [];
        $data_js = [];

        foreach ($data as $key => $value) {
            array_push($labels,  $value->date);
            array_push($data_js, $value->total);
        }

        return view('Admin.Pages.ThongKe.index', compact('begin', 'end', 'data', 'labels', 'data_js'));
    }
    public function changeStatus(Request $request){
        $bill = HoaDon::find($request->id);
        if($bill) {
            $bill->is_payment = !$bill->is_payment;
            $bill->save();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);

    }
    public function changeType(Request $request){
        $bill = HoaDon::find($request->id);
        if($bill) {
            if($bill->is_type == 0)
            $bill->is_type = $bill->is_type = 1;
            elseif ($bill->is_type == 1)
            $bill->is_type = $bill->is_type = 2;
            else if($bill->is_type == 2)
            $bill->is_type = $bill->is_type = 3;
            else
            $bill->is_type = $bill->is_type = 0;

            $bill->save();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
    public function search(Request $request){
        $search = $request->search;
        $listBill = HoaDon::where('bill_name', 'like', '%'.$search.'%')
        ->orWhere('ho_ten', 'like', '%'.$search.'%')
       ->join('khach_hangs','hoa_dons.customer_id','khach_hangs.id')
        ->select('hoa_dons.*','khach_hangs.ho_ten')
        ->get();
        return response()->json([
            'bill' => $listBill,
        ]);

    }
}
