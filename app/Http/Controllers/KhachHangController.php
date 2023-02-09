<?php

namespace App\Http\Controllers;

use App\Http\Requests\KhachHang\CustomerChangePassRequest;
use App\Http\Requests\KhachHang\RegisterCustomerRequest;
use App\Jobs\sendMailActiveJob;
use App\Jobs\sendMailPassJob;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KhachHangController extends Controller
{
    public function viewAuth(){
        $user = Auth::guard('customer')->check();
        if($user){
            return redirect('/');
        }
        return view('Client.Pages.auth.login');
    }
    public function login(Request $request){
        $data = $request->all();

        $login = Auth::guard('customer')->attempt($data);

        if ($login) {

            $user = Auth::guard('customer')->user();
            if ($user->is_active == 1) {
                return response()->json([
                    'status' => 1,
                ]);
            } else {
                Auth::guard('customer')->logout();
                return response()->json([
                    'status' => 2,
                ]);
            }
        } else {
            return response()->json([
                'status' => 0,
            ]);
        }
    }
    public function viewRegister(){

        return view('Client.pages.auth.register');
    }
    public function register(RegisterCustomerRequest $request){
        $hash = Str::uuid()->toString();
        $data = $request->all();

        $data['hash'] = $hash;
        $data['password'] = bcrypt($request->password);
        $link = env('APP_URL') . '/kich-hoat/' . $hash;

        KhachHang::create($data);


        sendMailActiveJob::dispatch($request->ho_ten,$link,$request->email);
        return response()->json([
            'status' => true,
        ]);

    }
    public function active($hash){
        $khach_hang = KhachHang::where('hash', $hash)->first();
        if($khach_hang){
            if($khach_hang->is_active == 1){
                toastr()->warning("Tài khoản đã được kích hoạt trước đó!");

            }
            else
            {
                toastr()->success("Email " . $khach_hang->email . " đã được kích hoạt!");
                $khach_hang->is_active = 1;
                $khach_hang->save();
            }
        }
        else
        {
            toastr()->error("Mã không tồn tại!");
        }
        return redirect('/');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        // toastr()->success('Đã đăng xuất thành công!');
        return redirect('/');
    }
    public function viewReset(){
        return view('Client.Pages.auth.reset_pass');
    }
    public function actionReset(Request $request)
    {
        $customer = KhachHang::where('email', $request->email)->first();
        if($customer) {
            $hash = Str::uuid();
            $customer->hash_reset = $hash;
            $customer->save();

            // Gửi email
            sendMailPassJob::dispatch($hash, $customer->email, $customer->full_name);
        }

        return response()->json([
            'status'    => true,
        ]);
    }
    public function viewChangePass($hash){
        $customer = KhachHang::where('hash_reset', $hash)->first();
        if($customer) {
            return view('Client.pages.auth.chage_pass', compact('hash'));
        } else {
            toastr()->error('Liên kết không tồn tại!');
            return redirect('/');
        }
    }
    public function actionChangePass(CustomerChangePassRequest $request)
    {
        $customer = KhachHang::where('hash_reset', $request->hash)->first();
        $customer->password = bcrypt($request->password);
        $customer->hash_reset = '';
        $customer->save();

        return response()->json([
            'status'    => true,
        ]);
    }
}
