<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'           => 'required|min:2',
            'password'       => 'required|min:6|max:30',
            'email'          => 'required|unique:admins,email',
            'gioi_tinh'      => 'required|boolean',
            'is_master'      => 'required|numeric',

        ];
    }

    public function messages()
    {
        return [
            'required'      =>  ':attribute không được để trống',
            'min'           =>  ':attribute quá nhỏ/ngắn',
            'boolean'       =>  ':attribute không phải Yes/No',
            'numeric'       =>  ':attribute không phải là số',
            'max'           =>  ':attribute quá lớn/dài',
            'unique'        =>  ':attribute đã tồn tại trong hệ thống',
            'digits'        =>  ':attribute phải đủ 10 số',
        ];
    }
    public function attributes()
    {
        return [
            'name'              => 'Họ và tên',
            'password'          => 'Mật khẩu',
            'email'             => 'Email',
            'gioi_tinh'         => 'Giới tính',
            'is_master'         => 'Loại Admin',
        ];
    }
}
