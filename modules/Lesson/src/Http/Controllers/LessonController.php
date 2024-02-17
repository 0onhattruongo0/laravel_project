<?php

namespace Modules\Lesson\src\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Lesson\src\Http\Requests\LessonRequest;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Lesson\src\Repositories\LessonRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;

class LessonController extends Controller
{
    protected $coursesRepository;
    protected $videoRepository;
    protected $documentRepository;
    protected $lessonRepository;
    public function __construct(CoursesRepositoryInterface $coursesRepository, VideoRepositoryInterface $videoRepository, DocumentRepositoryInterface $documentRepository, LessonRepositoryInterface $lessonRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->videoRepository = $videoRepository;
        $this->documentRepository = $documentRepository;
        $this->lessonRepository = $lessonRepository;
    }
    public function index($courseId)
    {
        $course = $this->coursesRepository->find($courseId);
        $page_title = 'Bài giảng: ' . $course->name;
        return view('lesson::list', compact('page_title', 'courseId'));
    }

    public function data($courseId)
    {
        $lessons = $this->lessonRepository->getData($courseId);
        return DataTables::of($lessons)
            ->addColumn('edit', function ($lesson) {
                return '<a href="' . route('admin.lessons.edit', $lesson) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($lesson) {
                return '<a href="' . route('admin.lessons.delete', $lesson) . '" class="btn btn-danger delete_action">Xóa</a>';
            })
            ->editColumn('created_at', function ($lesson) {
                return Carbon::parse($lesson->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('is_trial', function ($lesson) {
                return $lesson->is_trial == 1 ? '<button class="btn btn-success">Có</button>' : '<button class="btn btn-warning">Không</button>';
            })
            ->rawColumns(['edit', 'delete', 'is_trial'])
            ->toJson();
    }

    public function create($courseId)
    {
        $course = $this->coursesRepository->find($courseId);
        $page_title = 'Thêm bài giảng: ' . $course->name;
        return view('lesson::add', compact('page_title', 'courseId'));
    }
    public function store($courseId, LessonRequest $request)
    {
        $videoId = $this->videoId($request->video);
        if ($request->document) {
            $documentId = $this->documentId($request->document);
        } else {
            $documentId = null;
        }
        if ($request->position) {
            $position = $request->position;
        } else {
            $position = 0;
        }
        $this->lessonRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'course_id' => $courseId,
            'is_trial' => $request->is_trial,
            'position' => $position,
            'video_id' => $videoId,
            'document_id' => $documentId,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.lessons.index', $courseId)->with('msg', __('lesson::messages.success'));
    }

    public function edit($lesson)
    {
        $lesson = $this->lessonRepository->find($lesson);
        $page_title = 'Sửa bài giảng: ' . $lesson->course->name;
        $course_id = $lesson->course->id;
        return view('lesson::edit', compact('page_title', 'lesson', 'course_id'));
    }

    public function update($id, LessonRequest $request)
    {
        $videoId = $this->videoId($request->video);
        if ($request->document) {
            $documentId = $this->documentId($request->document);
        } else {
            $documentId = null;
        }
        if ($request->position) {
            $position = $request->position;
        } else {
            $position = 0;
        }
        $lesson = $this->lessonRepository->find($id);
        $courseId = $lesson->course->id;

        $this->lessonRepository->update($id, [
            'name' => $request->name,
            'slug' => $request->slug,
            'is_trial' => $request->is_trial,
            'position' => $position,
            'video_id' => $videoId,
            'document_id' => $documentId,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.lessons.index', $courseId)->with('msg', __('lesson::messages.success'));
    }

    public function delete($id)
    {
        $lesson = $this->lessonRepository->find($id);
        $courseId = $lesson->course->id;
        $this->lessonRepository->delete($id);
        return redirect(route('admin.lessons.index', $courseId))->with('msg', __('lesson::messages.delete_success'));
    }

    public function videoId($video_url)
    {
        $video = $this->videoRepository->getVideoId($video_url);
        if (!$video) {
            $add_video = $this->videoRepository->create(
                [
                    'name' => $video_url,
                    'url' => $video_url,
                ]
            );
            return $add_video->id;
        } else {
            return $video->id;
        }
    }

    public function documentId($document_url)
    {
        $document = $this->documentRepository->getDocumentId($document_url);
        if (!$document) {
            $add_document = $this->documentRepository->create(
                [
                    'name' => $document_url,
                    'url' => $document_url,
                ]
            );
            return $add_document->id;
        } else {
            return $document->id;
        }
    }
}
