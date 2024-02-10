<?php

namespace Modules\Auth\src\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $page_title = 'Đăng nhập';
        return view('auth::admin.login',compact('page_title'));
    }

    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                $this->username() => 'required|string',
                'password' => 'required|string|min:6',
            ],
            [
                $this->username().'.required' => 'Tên đăng nhập bắt buộc phải nhập',
                $this->username().'.string' => 'Kiểu dữ liệu không hợp lệ',
                'password.required' => 'Mật khẩu bắt buộc phải nhập',
                'password.string' => 'Kiểu dữ liệu không hợp lệ',
                'password.min' => 'Mật khẩu bắt buộc phải từ 6 ký tự',
            ]
        );
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [__('auth::messages.login.fails')],
        ]);
    }

    protected function loggedOut(Request $request)
    {
        return redirect($this->redirectTo);
    }
}
