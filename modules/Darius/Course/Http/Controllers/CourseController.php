<?php

namespace Darius\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Darius\Category\Repositories\CategoryRepo;
use Darius\Course\Http\Requests\CourseRequest;
use Darius\Course\Models\Course;
use Darius\Course\Repositories\CourseRepo;
use Darius\Media\Services\MediaFileService;
use Darius\User\Repositories\UserRepo;
use Darius\Common\Responses\AjaxResponses;

class CourseController extends Controller
{
    protected $userRepo;
    protected $categoryRepo;
    protected $courseRepo;

    public function __construct(UserRepo $userRepo, CategoryRepo $categoryRepo,
                CourseRepo $courseRepo)
    {
        $this->userRepo = $userRepo;
        $this->categoryRepo = $categoryRepo;
        $this->courseRepo = $courseRepo;
    }

    public function index()
    {
       $this->authorize('manage', Course::class);
       $courses = $this->courseRepo->paginate();
       return view('Courses::index', compact('courses'));
    }

    public function create()
    {
        $this->authorize('create', Course::class);
        $teachers = $this->userRepo->getTeachers();
        $categories = $this->categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request)
    {
        $this->authorize('create', Course::class);
        $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))->id]);
        $this->courseRepo->store($request);
        return redirect(route('courses.index'));
    }

    public function edit($id)
    {
        $course = $this->courseRepo->findById($id);
        $this->authorize('edit', $course);
        $teachers = $this->userRepo->getTeachers();
        $categories = $this->categoryRepo->all();
        return view('Courses::edit', compact('course', 'teachers', 'categories'));
    }

    public function update($id, CourseRequest $request)
    {
        $course = $this->courseRepo->findById($id);
        $this->authorize('edit', $course);
        if($request->hasFile('image')) {
            $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))->id]);
            if($course->banner) $course->banner->delete();
        }else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }

        $this->courseRepo->update($id, $request);
        return redirect(route('courses.index'));
    }

    public function destroy($id)
    {
        $course = $this->courseRepo->findById($id);
        $this->authorize('delete', $course);
        if($course->banner) $course->banner->delete();
        $course->delete();

        return AjaxResponses::SuccessResponse();
    }

    public function accept($id)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if($this->courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_ACCEPTED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function reject($id)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if($this->courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_REJECTED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function lock($id)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if($this->courseRepo->updateStatus($id, Course::STATUS_LOCKED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

}
