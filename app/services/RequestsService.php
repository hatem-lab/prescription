<?php

namespace App\services;

use App\enums\ActiveInactiveStatus;
use App\enums\DealClosedEnum;
use App\enums\ErrorCode;
use App\enums\ItemType;
use App\Models\API\lists\MediaModel;
use App\Models\API\lists\MedicationResult;
use App\Models\API\services\CourseResult;
use App\Models\API\offers\View_Offer;
use App\enums\PropertyRequestStatus;
use App\enums\PropertySellRentEnum;
use App\enums\RequestStatus;

use App\Models\couresstudent;
use App\Models\CoureStudent;
use App\Models\Course;

use App\Models\Media;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

use App\Models\notifications\Notification;

use App\Models\API\other\ApiMessage;
use App\Models\API\other\IdValueApiModel;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use function Symfony\Component\Translation\t;


class RequestsService
{


    public static function CreateCourse($request)
    {
        try{

            $course = new Course();
            $course->title = $request->title;
            $course->content = $request->content;
            $course->type_id = $request->type_id;
            $course->user_id = $request->user_id;

            if (!$course->save()) {
                returnError('Error in saving course');
            }

            $medias = $request->media;
            $id = $course->id;
            $imageCollection = Collection::wrap($medias);
            $imageCollection->each(function($media) use ($id){
                if($media !== null)
                {
                    $basename = Str::random();
                    $original = $basename . "." . $media->getClientOriginalExtension();
                    $media->move(public_path("/storage/courses_images"), $original);

                    Media::create([
                        "course_id" => $id,
                        "file" => "courses_images/".$original,
                    ]);
                }

            });


            $data = FillApiModelService::FillCourseApiModel($course);
            $res = new CourseResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content'=>'course created successfully',
                ]),
            ]);



            return [true, $res, '', ''];

        }
        catch (\Exception $ex) {
            return [false, null, AdminService::Msg_Exception, $ex->getMessage()];
        }

    }


    public static function AllCourses($request)
    {
        try {
            $page_size = $request->pagesize ? $request->pagesize : 10;
            $query = Course::where('views_count','>=','2')->latest()->paginate($page_size);
            

            $data = [];
            foreach ($query as $one) {
                $item = FillApiModelService::FillCourseApiModel($one);
                $data[] = $item;
            }

            $res = new CourseResult([
                'items_count'=>Course::count(),
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ]),
            ]);

            return [true , $res , '' , ''];
        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }


    }

    public static function deleteCourse($request)
    {
        $course=Course::where('id',$request->course_id)
            ->first();
         

        if(!$course)
        {
            return returnError('course items doesnot founded');
        }
        foreach ( $course->medias as $media)
        {
            $media->delete();
        }

        $course->delete();
        return returnSuccess('course items deleted successfully');
    }


    public static function CourseDetails($request)
    {
        try {

            $course = Course::where('id', $request->id)->first();
            
           
            if(!$course){
                return [false, null, "course Not found", null];
            }
            $course->views_count= $course->views_count + 1;
            $course->update(['views_count'=>$course->views_count]);
            $data = FillApiModelService::FillCourseApiModel($course);

            $res = new CourseResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                ]),
            ]);
            return [true, $res, '', ''];
        } catch (\Exception $ex) {
            return [false, null, AdminService::Msg_Exception, $ex->getMessage()];
        }
    }



    public static function UpdateCourse($request)
    {
        try{
            $course = Course::where('id', $request->course_id)->first();
            if(!$course){
                return [false, null, "course Not Found", null];
            }

            if (!$request->course_id) {
                return [false, null, "course Not determinate", null];
            }

            $course->title = $request->title? $request->title: $course->title;
            $course->content = $request->content? $request->content: $course->content;
            $course->user_id = $request->user_id? $request->user_id: $course->user_id;
            $course->type_id = $request->type_id? $request->type_id: $course->type_id;
            $course->title = $request->title? $request->title: $course->title;
            $course->title = $request->title? $request->title: $course->title;
            if (!$course->save()) {
                returnError('Error in saving course');
            }


            $medias = $request->media;
            $id = $course->id;
            $imageCollection = Collection::wrap($medias);
            $imageCollection->each(function($media) use ($id){
                if($media !== null)
                {
                    $basename = Str::random();
                    $original = $basename . "." . $media->getClientOriginalExtension();
                    $media->move(public_path("/storage/courses_images"), $original);

                    Media::create([
                        "course_id" => $id,
                        "file" => "courses_images/".$original,
                    ]);
                }

            });

            $data = FillApiModelService::FillCourseApiModel($course);

            $res = new CourseResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content'=>'course updated successfully',
                ]),
            ]);
            return [true, $res, '', ''];
        }
        catch (\Exception $ex) {
            return [false, null, AdminService::Msg_Exception, $ex->getMessage()];
        }
    }


    public static function CoursesStudent($request)
    {
        try {
            $student=user();
           $courses_student=CoureStudent::where('student_id',$student->id)->get();
           $courses=[];
           foreach ($courses_student as $one)
           {
               $courses[]=Course::where('id',$one->course_id)->first();

           }
            $data = [];
            foreach ($courses as $one1) {

                $item = FillApiModelService::FillCourseApiModel($one1);
                $data[] = $item;
            }

            $res = new CourseResult([

                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ]),
            ]);

            return [true , $res , '' , ''];
        } catch (\Exception $ex){
            return [false , null , TeacherService::Msg_Exception , $ex->getMessage()];
        }


    }


}
