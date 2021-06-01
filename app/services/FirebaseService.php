<?php

namespace common\services;

use api\models\notification\ListNotifications;
use common\enums\NotificationType;
use common\interfaces\IFirebaseInterface;
use common\models\Bid;
use common\models\Chat;
use common\models\Comment;
use common\models\Complaint;
use common\models\Feedback;
use common\models\notifications\bid\NewBidNotification;
use common\models\notifications\comment\NewCommentNotification;
use common\models\notifications\comment\NewCommentReplyNotification;
use common\models\notifications\complaint\NewComplaintReplyNotification;
use common\models\notifications\message\NewMessageNotification;
use common\models\notifications\Notification;
use common\models\notifications\path\NewPathNotification;
use common\models\notifications\request\NewOrderNotification;
use common\models\notifications\request\RequestAnswerNotification;
use common\models\notifications\subject\NewSubjectNotification;
use common\models\notifications\subject\NewSubjectRateNotification;
use common\models\notifications\subject\NewSubjectSubscriptionNotification;
use common\models\notifications\subject\NewSurveyNotification;
use common\models\notifications\subject\ReminderNotification;
use common\models\notifications\topic\UpdateTopicNotification;
use common\models\Path;
use common\models\Request;
use common\models\Review;
use common\models\Subject;
use common\models\Topic;
use common\models\UserSubscription;
use paragraph1\phpFCM\Recipient\Device;

class FirebaseService {

    public static function send($device_token, $title, $body, $data = []) {
        $fcm = \Yii::$app->fcm_understeam;
        $note = $fcm->createNotification($title, $body);
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ffffff')
            ->setBadge(1);

        $message = $fcm->createMessage();
        $message->addRecipient(new Device($device_token));
        $data_array = [];
        foreach ($data as $one){
            $data_array[$one->key] = $one->value;
        }
        $message->setNotification($note)->setData($data_array);

        $response = $fcm->send($message);
        return $response->getStatusCode();
    }

    public static function sendToTopic($topic, $title, $body, $data = []) {
        $result = \Yii::$app->fcm
            ->createRequest(\aksafan\fcm\source\builders\StaticBuilderFactory::FOR_TOPIC_SENDING)
            ->setTarget(\aksafan\fcm\source\builders\legacyApi\MessageOptionsBuilder::TOPIC, $topic)
            ->setNotification($title, $body)
            ->send();
        $res = false;
        $msg = '';
        if ($result->isResultOk()) {
            $res = true;
            $msg = '';
        } else {
//            echo 'ErrorMessage '.$result->getErrorMessage().'<br/>';
//            echo 'ErrorStatusDescription '.$result->getErrorStatusDescription();
            $res = false;
            $msg = $result->getErrorMessage();
        }
        return [$res, $msg];
    }

    public static function SendNotification($type)
    {
        $model = null;
        $notify = null;
        switch ($type) {
            case NotificationType::NEW_BID:
                $model = Bid::find()
                    ->one();
                $notify = new NewBidNotification($model);
                break;

            case NotificationType::NEW_REQUEST:
                $model = Request::find()
                    ->one();
                $notify = new NewOrderNotification($model);
                break;

            default:
                break;
        }

        if($model) {
            Notification::send($notify, true);
            return true;
        }
        return false;
    }




}
