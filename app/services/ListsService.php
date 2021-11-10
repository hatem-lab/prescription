<?php

namespace App\services;

use App\enums\ActiveInactiveStatus;
use App\enums\ErrorCode;
use App\enums\RequestStatus;
use App\Models\API\lists\CarTypeResult;
use App\Models\API\lists\CourseTypeResult;
use App\Models\API\lists\OrderStatusListModel;
use App\Models\API\lists\OrderStatusListResult;
use App\Models\API\other\ApiMessage;
use App\Models\CarType;
use App\Models\Course;
use App\Models\CourseType;
use Illuminate\Support\Facades\DB;


class ListsService {


    public static function CourseTypeList($request) {

        try {
            $page_size = $request->pagesize ? $request->pagesize : 10;
            $query = DB::table('courses_types')
                ->where('status', ActiveInactiveStatus::active)->latest();

            if ($request->search) {
                $query = $query
                    ->where('name', 'LIKE', "%{$request->search}%");
            }
            $data = [];
            foreach ($query->paginate($page_size) as $one) {
                $item = FillApiModelService::FillListCoursesTypeApiModel($one);
                $data[] = $item;
            }


            $res = new CourseTypeResult([
                'items_count'=>CourseType::count(),
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


    public static function TeachersList($request) {


        try {
            $page_size = $request->pagesize ? $request->pagesize : 10;
            $query = DB::table('admins')
                ->where('user_type','teacher')->latest();

            if ($request->search) {
                $query = $query
                    ->where('name', 'LIKE', "%{$request->search}%");
            }
            $data = [];
            foreach ($query->paginate($page_size) as $one) {
                $course=Course::where('user_id',$one->id)->get();
                if($course->count() >=2)
                {
                    $item = FillApiModelService::FillListTeacherApiModel($one);
                    $data[] = $item;
                }

            }


            $res = new CourseTypeResult([
                'items_count'=>$query->count(),
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
