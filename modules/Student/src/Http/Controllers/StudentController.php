<?php

namespace Modules\Student\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Modules\Order\src\Repositories\OrderRepositoryInterface;
use Modules\Student\src\Http\Requests\RegisterStudentRequest;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Student\src\Repositories\StudentRepositoryInterface;

class StudentController extends Controller
{

    use SendsPasswordResetEmails;

    protected $studentRepository;
    protected $coursesRepository;
    protected $orderRepository;

    public function __construct(StudentRepositoryInterface $studentRepository, CoursesRepositoryInterface $coursesRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->coursesRepository = $coursesRepository;
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $page_title = 'Danh sách học viên';
        return view('student::list', compact('page_title'));
    }

    public function data()
    {
        $students = $this->studentRepository->getData();
        return DataTables::of($students)
            ->addColumn('edit', function ($student) {
                return '<a href="' . route('admin.students.edit', $student) . '" class="btn btn-warning">Kích hoạt khóa học</a>';
            })
            ->addColumn('delete', function ($student) {
                return '<a href="' . route('admin.students.delete', $student) . '" class="btn btn-danger delete_action">Xóa</a>';
            })
            ->editColumn('created_at', function ($student) {
                return Carbon::parse($student->created_at)->format('d/m/Y H:i:s');
            })
            ->rawColumns(['edit', 'delete'])
            ->toJson();
    }

    public function edit($studentId)
    {
        $page_title = 'Kích hoạt khóa học';
        $ordered = $this->orderRepository->ordered($studentId);
        $student = $this->studentRepository->find($studentId);
        return view('student::active_course', compact('page_title', 'ordered', 'student'));
    }

    public function update($studentId, Request $request)
    {
        $coursesAll = $this->coursesRepository->getData()->get();
        foreach ($coursesAll as $item) {
            $order = $this->orderRepository->getIdUpdate($studentId, $item->id);
            if (!empty($order[0])) {
                $this->orderRepository->update($order[0]->id, ['status' => 0]);
            }
        }
        $courseActive = $request->courses;
        if ($courseActive) {
            foreach ($courseActive as $item) {
                $order = $this->orderRepository->getIdUpdate($studentId, $item);
                if (!empty($order[0])) {
                    $this->orderRepository->update($order[0]->id, ['status' => 1]);
                }
            }
        }
        return back()->with('msg', 'Cập nhật thành công');
    }

    public function delete($studentId)
    {
        $this->studentRepository->delete($studentId);
        return redirect(route('admin.students.index'))->with('msg', 'Xóa học viên thành công');
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
