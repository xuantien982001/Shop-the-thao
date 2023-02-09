<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              =>  'required|min:5',
            'email'             =>  'required|email|unique:admins,email,' . $this->id,
            'password'          =>  'nullable|min:6|max:30',
            're_password'       =>  'nullable|same:password',
            'gioi_tinh'         =>'required|numeric|min:0|max:2',
            'is_master'         =>'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'required'      =>':attribute không được để trống',
            'unique'        =>  ':attribute đã tồn tại trong hệ thống',
            'min'           =>  ':attribute quá nhỏ/ngắn',
            'max'           =>  ':attribute quá lớn/dài',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            're_password'=>'Nhập lại mật khẩu',
            'gioi_tinh' => 'Giới tính',
            'is_master' =>'Admin',
        ];
    }
}
