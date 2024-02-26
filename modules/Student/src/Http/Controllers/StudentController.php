<?php

namespace Modules\Student\src\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Modules\Student\src\Http\Requests\RegisterStudentRequest;
use Modules\Student\src\Repositories\StudentRepositoryInterface;

class StudentController extends Controller
{

    use SendsPasswordResetEmails;

    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function viewLogin()
    {
        return view('student::login');
    }

    public function postLogin(Request $request)
    {
        $dataLogin = $request->except('_token');

        $request->validate(
            [
                'email' => 'required|string',
                'password' => 'required|string|min:6',
            ],
            [
                'email.required' => 'Tên đăng nhập bắt buộc phải nhập',
                'email.string' => 'Kiểu dữ liệu không hợp lệ',
                'password.required' => 'Mật khẩu bắt buộc phải nhập',
                'password.string' => 'Kiểu dữ liệu không hợp lệ',
                'password.min' => 'Mật khẩu bắt buộc phải từ 6 ký tự',
            ]
        );

        if (isStudentActive($dataLogin['email'])) {
            $checkLogin = Auth::guard('student')->attempt($dataLogin);
            if ($checkLogin) {
                return redirect(route('home'));
            } else {
                return back()->with('err', 'Email hoặc mật khẩu không đúng');
            }
        }
        return back()->with('err', 'Email hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect(route('students.viewLogin'));
    }

    public function viewRegister()
    {
        return view('student::register');
    }

    public function postRegister(RegisterStudentRequest $request)
    {
        $data = $request->except('_token');
        $this->studentRepository->create($data);
        return back()->with('msg', 'Đăng ký thành công');
    }





    public function forgetPassword()
    {
        return view('student::forget-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(
            ['email' => 'required|email'],
            [
                'email.requered' => 'Email bắt buộc phải nhập',
                'email.email' => 'Định dạng email chưa đúng'
            ]

        );
    }

    public function broker()
    {
        return Password::broker('students');
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => ['Không tìm thấy người dùng với email phù hợp'],
            ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Không tìm thấy người dùng với email phù hợp']);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => 'Đường dẫn thay đổi mật khẩu đã gửi vào email của bạn'], 200)
            : back()->with('status', 'Đường dẫn thay đổi mật khẩu đã gửi vào email của bạn');
    }
}
