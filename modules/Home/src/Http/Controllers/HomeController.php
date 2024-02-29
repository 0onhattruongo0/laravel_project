<?php

namespace Modules\Home\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Student\src\Http\Requests\RegisterStudentRequest;
use Modules\Lesson\src\Repositories\LessonRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Student\src\Repositories\StudentRepositoryInterface;

class HomeController extends Controller
{
    protected $coursesRepository;
    protected $lessonRepository;
    protected $studentRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, LessonRepositoryInterface $lessonRepository, StudentRepositoryInterface $studentRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->lessonRepository = $lessonRepository;
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $myCourse = null;
        $student = Auth::guard('student')->user();
        if ($student) {
            $myCourse = $student->orders->where('status', 1);
        }
        $courses = $this->coursesRepository->getData()->get();
        return view('home::home', compact('courses', 'myCourse'));
    }

    public function course($slug)
    {
        $course = $this->coursesRepository->getCourse($slug);
        $student = Auth::guard('student')->user();
        $courseActive = false;
        if ($student) {
            foreach ($student->courses as $i => $item) {
                if ($item->pivot->status == 1) {
                    $courseActive = true;
                }
            };
        }
        return view('home::course', compact('course', 'courseActive'));
    }

    public function lesson($slug)
    {
        $student = Auth::guard('student')->user();
        if ($student) {
            if ($student->courses->count() == 0) {
                return back();
            };
            foreach ($student->courses as $i => $course) {
                if ($course->pivot->status != 1) {
                    return back();
                }
            };
        }
        $arrFinish = Auth::guard('student')->user()->finish;
        $arrFinish = json_decode($arrFinish);
        $lesson = $this->lessonRepository->getLesson($slug);
        $this->lessonRepository->update($lesson->id, ['views' => $lesson->views + 1]);
        $course = $lesson->module->course;
        $more = $this->lessonRepository->find($lesson->id + 1);
        return view('home::lesson', compact('lesson', 'more', 'course', 'arrFinish'));
    }

    public function payment($courseId)
    {
        $idStudent = Auth::guard('student')->user()->id;
        $course = $this->coursesRepository->find($courseId);

        if ($course->price != 0) {
            if ($course->sale_price != 0) {
                $course->price = $course->sale_price;
            }
        }
        $this->coursesRepository->createOrder(
            $course,
            [
                $idStudent = [
                    'student_id' => $idStudent,
                    'price' => $course->price,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            ]
        );
        return view('home::payment', compact('course'));
    }

    public function updatefinish(Request $request)
    {
        $student = Auth::guard('student')->user();
        $idStudent =  Auth::guard('student')->user()->id;
        $finish = [
            $request->courseId => [
                $request->lessonId
            ]
        ];

        if (!$student->finish) {
            $data = json_encode($finish);
            $this->studentRepository->update($idStudent, ['finish' => $data]);
            return response()->json(['mes' =>  'addsuccess']);
        } else {
            $arrFinish = json_decode($student->finish, true);
            if ($arrFinish[$request->courseId]) {
                $hasFinish = false;
                foreach ($arrFinish[$request->courseId] as $i => $item) {
                    if ($item == $request->lessonId) {
                        $index = $i;
                        $hasFinish = true;
                    }
                }
                if ($hasFinish) {
                    array_splice($arrFinish[$request->courseId], $index, 1);
                    $data = json_encode($arrFinish);
                    $this->studentRepository->update($idStudent, ['finish' => $data]);
                    return response()->json(['mes' =>  'removeSuccess']);
                } else {
                    $arrFinish[$request->courseId][] =  $request->lessonId;
                    $data = json_encode($arrFinish);
                    $this->studentRepository->update($idStudent, ['finish' => $data]);
                    return response()->json(['mes' =>  'addsuccess']);
                }
            }
            $arrFinish[$request->courseId][] =  $request->lessonId;
            $data = json_encode($arrFinish);
            $this->studentRepository->update($idStudent, ['finish' => $data]);
            return response()->json(['mes' =>  'addsuccess']);
        }
    }

    public function student()
    {
        $student = Auth::guard('student')->user();
        return view('home::student', compact('student'));
    }

    public function updateStudent(RegisterStudentRequest $request)
    {
        $student = Auth::guard('student')->user()->id;
        if ($request->password) {
            $this->studentRepository->update($student, [
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => $request->password,
                'address' => $request->address,
            ]);
        }
        $this->studentRepository->update($student, [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return back()->with('msg', 'Cập nhật thành công');
    }
}
