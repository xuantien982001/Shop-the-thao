<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.Pages.admin.index');
    }
    public function checkEmail(Request $request)
    {
        $account = Admin::where('email', $request->email)->first();
        if ($account) {
            return response()->json([
                'status' => false,
            ]);
        } else{
            return response()->json([
                'status' => true,
            ]);
        }
    }

    public function store(CreateAdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        Admin::create($data);

    }

    public function getData()
    {
        $accAdmin = Admin::select('admins.*')->get();
        return response()->json([
            'data' => $accAdmin,
        ]);
    }

    public function updateStatus($id){
        $idAdmin = Admin::find($id);
        if ($idAdmin) {

            $idAdmin->is_block = $idAdmin->is_block == 0 ? 1 : 0;
            $idAdmin->save();

            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'status'  => false,
            ]);
        }
    }

    public function viewLogin()
    {

        return view('Admin.Login');

    }
    public function actionLogin(Request $request)
    {
        $checkEmail = Auth::guard('admin')->attempt([
            'email'    => $request->username,
            'password' => $request->password,
        ]);
        if($checkEmail){
            return response()-> json([
                'status' => true
            ]);
        } else {
            return response()-> json([
                'status' => false
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->back();
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            return response()->json([
                'status'    => true,
                'data'  => $admin,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }


    public function update(UpdateAdminRequest $request)
    {

        $login_id = Auth::guard('admin')->user();
        if($login_id->id == $request->id && $request->is_block == 1){
            return response()->json(['status' =>0, 'message' => 'Bạn không thể hủy chính mình']);
        }
        $admin = admin::find($request->id);
        if(!$request->password) {
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->gioi_tinh = $request->gioi_tinh;
            $admin->is_block = $request->is_block;
            $admin->is_master = $request->is_master;
            $admin->save();
        }
        else
        {
            $data = $request->all();
            $data['password']   = bcrypt($request->password);
            $admin->update($data);
        }
        return response()->json(['status' =>1]);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->delete();
            return response()->json([
                'status'    => true,
            ]);
        } else {
            return response()->json([
                'status'    => false,
            ]);
        }
    }

    public function create()
    {
        //
    }





    public function show(Admin $admin)
    {
        //
    }








}
