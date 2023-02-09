<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\ChuyenMuc;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrangChuController extends Controller
{
    public function index(){
        $loaiSP  = DanhMuc::where('is_open', 1)->where('id_danh_muc_cha', 0)->inRandomOrder()->take(3)->get();
        $sql = 'SELECT san_phams.*, B.id as id_cha
                FROM san_phams JOIN danh_mucs As A on san_phams.`ma_danh_muc_id` = A.id JOIN danh_mucs as B on A.id_danh_muc_cha = B.id';
        $sanPham    = DB::select($sql);
        $sanPhamGiam = SanPham::where('is_open',1)->where('gia_khuyen_mai','>',0)->orderby('gia_khuyen_mai')->take(9)->get();
        $slide = Slides::where('is_open',1)->get();
        return view('Client.Pages.home', compact('loaiSP','sanPham','sanPhamGiam','slide'));
        //return view('Client.Share.master');

    }
    public function detailProduct($slug){
        $sanPhamdetail = SanPham::join('danh_mucs', 'san_phams.ma_danh_muc_id', 'danh_mucs.id')
                    ->where('san_phams.slug_san_pham', $slug)
                    ->select('san_phams.*', 'danh_mucs.ten_danh_muc')
                    ->first();
        $sanPhamDel = SanPham::where('is_open',1)->inRandomOrder()->take(4)->get();
        return view('Client.Pages.product', compact('sanPhamdetail','sanPhamDel'));
    }
    public function listProduct($id){
        $danhMucCha = DanhMuc::find($id);
        if($danhMucCha) {
            // Nếu là danh mục con
            if($danhMucCha->id_danh_muc_cha > 0) {
                $listSanPham = SanPham::where('is_open', 1)
                                ->where('ma_danh_muc_id', $danhMucCha->id)
                                ->get();
            } else {
                // Nó là danh mục cha. Tìm toàn bộ danh mục con
                $danhMucChaCon = DanhMuc::where('id_danh_muc_cha', $danhMucCha->id)
                                            ->get();
                $danhSach   = $danhMucCha->id;
                foreach($danhMucChaCon as $key => $value) {
                    $danhSach = $danhSach . ',' . $value->id;
                }
                $listSanPham = SanPham::whereIn('ma_danh_muc_id', explode(",", $danhSach))->get();
            }

            return view('Client.Pages.list_product', compact('listSanPham', 'danhMucCha'));
        }
    }
    public function search(Request $request){
        $products= SanPham::where('ma_san_pham', 'like', '%'.$request->input('query').'%')
                            ->orWhere('ten_san_pham', 'like', '%'.$request->input('query').'%')
                            ->join('danh_mucs', 'san_phams.ma_danh_muc_id','danh_mucs.id')
                            ->select('san_phams.*', 'danh_mucs.ten_danh_muc')
                            ->get();
        // return response()->json([
        //     'search' => $search,
        // ]);
       //return $request->input();
         return view('Client.Pages.search', compact('products'));
    }
    public function listBlog($id){
        $chuyenMuc = ChuyenMuc::find($id);

                $baiViet = BaiViet::
                    get();
                    return view('Client.Pages.blog', compact('baiViet'));


    }
}
