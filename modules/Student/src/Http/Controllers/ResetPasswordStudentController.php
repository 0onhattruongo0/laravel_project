<?php

namespace Modules\Student\src\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordStudentController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/';

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', 'min:6'],
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'token.required' => 'Token không được để trống',
            'email.requered' => 'Email không được để trống',
            'email.email' => 'Định dạng email không đúng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
        ];
    }

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('student::reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return Password::broker('students');
    }

    protected function guard()
    {
        return Auth::guard('student');
    }
}
