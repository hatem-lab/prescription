<?php


namespace App\services;

use App\enums\Constents;
use App\enums\ErrorCode;
use App\Models\API\notification\ListNotificationsResult;
use App\Models\API\other\ApiMessage;
use App\Models\Notification;

class NotificationService
{
    public static function Index()
    {
        if(user()) {
            $query = Notification::where(['user_id' => user()->id]);
        }
        else if(admin()) {
            $query = Notification::where(['admin_id' => admin()->id]);
        }
        else return [false , null , 'Unauthenticated' ,''];

        $query->orderBy('date' , 'desc')
              ->get();


        return self::transferList($query);
    }


    public static function transferList($dataProvider)
    {
        try {
            $data = [];
            /** @var Notification $one */

            foreach ($dataProvider as $one) {
                $item = FillApiModelService::FillListNotificationsApiModel($one);
                if (!$item) {
                    $one->delete();
                    continue;
                }
                $one->publish = 1;
                $one->save();
                $data[] = $item;
            }
            $res =  new ListNotificationsResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);
            return [true , $res , '' , ''];

        }catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception ,$ex->getMessage()];
        }
    }

    public static function read($id)
    {
        try {
            $notification = Notification::find($id);
            $notification->is_read = 1;
            $notification->save();

            return returnSuccess('Notification read');
        }catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function create($user, $title, $content, $url, $icon = null, $image = null)
    {
        try {
            $model = new Notification();
            $model->user_id = $user;
            $model->title = $title;
            $model->content = $content;
            $model->date = date(Constents::full_date_format);
            $model->icon = $icon;
            $model->image = $image;
            $model->url = $url;
            $model->save();

            return [true , $model , '' , ''];

        }catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception ,$ex->getMessage()];
        }
    }

    public static function SendNotification($type, $dataId)
    {
//        $comment = Comment::findOne(['id' => '043f2fbe-f062-413d-96dd-acd8cae3530b']);
//        $comment->content = $type. $dataId;
//        $comment->save();
//        return "fff";
        $model = null;
        $notify = null;
        switch ($type) {
            case NotificationType::NEW_COMMENT:
                $model = Comment::findOne(['id' => $dataId]);
                $notify = new NewCommentNotification($model);
                break;
            case NotificationType::NEW_COMMENT_REPLY:
                $model = Comment::findOne(['id' => $dataId]);
                $notify = new NewCommentReplyNotification($model);
                break;
            case NotificationType::NEW_COMPLAINT_REPLY:
                $model = Complaint::findOne(['id' => $dataId]);
                $notify = new NewComplaintReplyNotification($model);
                break;
            case NotificationType::CHANGE_STATUS_JOIN_UNIVERSITY:
            case NotificationType::NEW_JOIN_UNIVERSITY:
                break;
            case NotificationType::REMINDER_NOTIFICATION:
                $notify = new ReminderNotification();
                \common\models\notifications\Notification::send($notify, true);
                return true;
                break;
            case NotificationType::NEW_MESSAGE:
                $model = Chat::findOne(['id' => $dataId]);
                $notify = new NewMessageNotification($model);
                break;
            case NotificationType::NEW_PATH:
                $model = Path::findOne(['id' => $dataId]);
                $notify = new NewPathNotification($model);
                break;
            case NotificationType::NEW_SUBJECT:
                $model = Subject::findOne(['id' => $dataId]);
                $notify = new NewSubjectNotification($model);
                break;
            case NotificationType::NEW_RATE:
                $model = Review::findOne(['id' => $dataId]);
                $notify = new NewSubjectRateNotification($model);
                break;
            case NotificationType::NEW_SUBSCRIBER:
                $model = UserSubscription::findOne(['id' => $dataId]);
                $notify = new NewSubjectSubscriptionNotification($model);
                break;
            case NotificationType::NEW_SURVEY:
                $model = Feedback::findOne(['id' => $dataId]);
                $notify = new NewSurveyNotification($model);
                break;
            case NotificationType::UPDATE_SUBJECT:
                $model = Topic::findOne(['id' => $dataId]);
                $notify = new UpdateTopicNotification($model);
        }

        if($model) {
            \common\models\notifications\Notification::sendNotification($notify);
            return true;
        }
        return false;
    }

//    public static function DeleteNotificationOfObject($type, $data_id)
//    {
//        $notifications = Notification::find()
//            ->andWhere(['data_id' => $data_id])
//            ->andWhere(['type' => $type])
//            ->all();
//        foreach ($notifications as $one){
//            $one->delete();
//        }
//        return true;
//    }
}
