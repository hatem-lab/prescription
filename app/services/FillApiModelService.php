<?php

namespace App\services;


use App\enums\ActiveInactiveStatus;
use App\enums\Constents;
use App\enums\ErrorCode;
use App\enums\NotificationType;
use App\enums\OfferStatus;
use App\enums\RequestStatus;
use App\enums\UserStatus;
use App\Models\Admin;

use App\Models\API\auth\ApiResultProfileResult;
use App\Models\API\auth\ApiResultRegisterResult;
use App\Models\API\auth\ProfileResult;
use App\Models\API\auth\RegisterResult;
use App\Models\API\auth_admin\ApiResultProfileAdminResult;
use App\Models\API\auth_admin\ProfileAdminResult;
use App\Models\API\lists\TeacherModel;
use App\Models\API\services\ApiImages;
use App\Models\API\services\CourseApiModel;
use App\Models\API\lists\CourseTypeModel;
use App\Models\API\other\ApiMessage;
use App\Models\API\other\IdValueApiModel;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Media;
use App\User;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;


class FillApiModelService
{

    public static function FillProfileResultModel($item , $isOrder = false)
    {
        return new ProfileResult([
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'city' => $item->city,
            'region' => $item->region,
            'phone' => $item->phone,
            'image' => $item->photo ? getImage($item->photo ) : '',
        ]);

    }

    public static function FillProfileAdminResultModel($item)
    {
        return new ProfileAdminResult([
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'city' => $item->city,
            'region' => $item->region,
            'phone' => $item->phone,
            'image' => $item->photo ? getImage($item->photo ) : '',



        ]);
    }

    public static function FillApiResultRegisterResultModel($item, $msg = '')
    {
        return new ApiResultRegisterResult([
            'result' => new RegisterResult([
                'phone' => $item->phone,
                'message' => __($msg),
            ]),
            'isOk' => true,
            'message' => null,
        ]);
    }



    public static function FillApiResultProfileAdminResult($item)
    {

        $model = new ApiResultProfileAdminResult([
            'result' => $item,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);;

        return $model;
    }


    public static function FillListCoursesTypeApiModel($item){

        $model = new CourseTypeModel([
            'id' => $item->id,
            'type' => $item->type,
            'status' => getActive($item->status),
            //'categories'=>self::FillApiModel($item),
        ]);
        return $model;
    }
    public static function FillListTeacherApiModel($item)
    {


        $course=Course::where('user_id',$item->id)->get();

        $model = new TeacherModel([
            'id' => $item->id,
            'name' => $item->name,
            'categories' =>  $course ? self::FillApiModel($course) : '',

        ]);
        return $model;

    }

    public static function FillApiModel($item_)
    {
        $manycourse=[];
        foreach ( $item_ as $one )
        {
            $manycourse[] = self::FillCourseApiModel($one);
        }
        return $manycourse;
    }

    public static function FillModel($item)
    {
        $model = new CourseApiModel([
            'id' => $item->id,
            'title' => $item->title,
            'content' => $item->content,
            'user'=>$item->user_id ? self::FillProfileAdminResultModel(Admin::find($item->user_id)) : '',
            'media' => self::FillFiles($item->medias),

        ]);
        return $model;
    }





    public static function FillCourseApiModel($item)
    {

        $model = new CourseApiModel([
            'id' => $item->id,
            'title' => $item->title,
            'content' => $item->content,
            'coures_type' =>  $item->type_id ? self::FillListCoursesTypeApiModel(CourseType::find($item->type_id)) : '',
            'user'=>$item->user_id ? self::FillProfileAdminResultModel(Admin::find($item->user_id)) : '',
             'media' => self::FillFiles($item->medias),
             'view_count'=>$item->views_count,

        ]);
        return $model;

    }

    public static function FillFiles($items)
    {

        $data = [];
        foreach ($items as $one) {
            $data[] = new ApiImages([
                'id' => $one->id,
                'file' => $one->file ? getImage($one->file) : '',
            ]);
        }
        return $data;
    }




}
