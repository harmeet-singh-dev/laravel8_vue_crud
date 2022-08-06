<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Carbon\Carbon;
use App\Models\Topic;
use App\Models\Speaker;
use App\Models\Course;
use App\Models\Courses_speaker;
use App\Models\User;
use Auth;
class TaskController extends Controller
{
    //

    public function index()
    {
        $topic = Topic::select(['id','name'])->get();
        return Inertia::render('Task',['topic' => $topic]);
    }

    public function search($id)
    {
          $course =  Course::where('topic_ID',$id)->get(['name','price_range']);
              return Response::json(array(
            'course' => $course
        ), 200);
    }

    public function topic()
    {
        return Inertia::render('Topic');
    }

    public function create(Request $request)
    {

         $this->validate($request, [
            'name' => 'required',
        ]);

        $topic = new Topic;
        $topic->name = $request->name;
        $topic->save();
        return response()->json([
            'success' => 'Done'
        ]);
    }

    public function speaker()
    {
        return Inertia::render('Speaker');
    }


     public function speaker_create(Request $request)
    {
           $this->validate($request, [
            'name' => 'required',
        ]);

        $speaker = new Speaker;
        $speaker->name = $request->name;
        $speaker->save();
        return response()->json([
            'success' => 'Done'
        ]);
    }

    public function course()
    {
        $topic = Topic::select(['id','name'])->get();
        return Inertia::render('Course', ['topic' => $topic]);
    }

    public function course_create(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
            'topic' => 'required',
            'price' => 'required',
        ]);

        $course = new Course;
        $course->name = $request->name;
        $course->topic_ID = $request->topic;
        $course->price_range = $request->price;
        $course->save();
        return response()->json([
            'success' => 'Done'
        ]);
    }

    public function course_speaker()
    {
        $course = Course::select(['id','name'])->get();
        $speaker = Speaker::select(['id','name'])->get();
        return Inertia::render('Course_Speaker', ['course' => $course,'speaker' => $speaker]);
    }

    public function course_speaker_create(Request $request)
    {
         $this->validate($request, [
            'course' => 'required',
            'speaker' => 'required',
        ]);

        $course_speaker = new Courses_speaker;
        $course_speaker->course_ID = $request->course;
        $course_speaker->speaker_ID = $request->speaker;
        $course_speaker->save();
        return response()->json([
            'success' => 'Done'
        ]);

    }
    }

