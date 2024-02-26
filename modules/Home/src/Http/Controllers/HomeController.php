<?php

namespace Modules\Home\src\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Lesson\src\Repositories\LessonRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class HomeController extends Controller
{
    protected $coursesRepository;
    protected $lessonRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, LessonRepositoryInterface $lessonRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index()
    {
        $courses = $this->coursesRepository->getData()->get();
        return view('home::home', compact('courses'));
    }

    public function course($slug)
    {
        $course = $this->coursesRepository->getCourse($slug);
        $student = Auth::guard('student')->user();
        $courseActive = false;
        if ($student) {
            foreach ($student->courses as $i => $course) {
                if ($course->pivot->status == 1) {
                    $courseActive = true;
                }
            };
        }
        return view('home::course', compact('course', 'courseActive'));
    }

    public function lesson($slug)
    {
        $lesson = $this->lessonRepository->getLesson($slug);
        $course = $lesson->module->course;
        $more = $this->lessonRepository->find($lesson->id + 1);
        return view('home::lesson', compact('lesson', 'more', 'course'));
    }

    public function payment($courseId)
    {
        if (empty(Auth::guard('student')->user())) {
            return redirect(route('students.viewLogin'));
        }
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
                    'price' => $course->price
                ]
            ]
        );
        return view('home::payment', compact('course'));
    }

    public function updatefinish(Request $request)
    {
        $lesson = $this->lessonRepository->find($request->lessonId);
        if ($lesson->finish == 0) {
            $a = $this->lessonRepository->update($request->lessonId, ['finish' => 1]);
            return response()->json(['mes' => 'addsuccess']);
        } else {
            $this->lessonRepository->update($request->lessonId, ['finish' => 0]);
            return response()->json(['success' => '']);
        }
    }
}
