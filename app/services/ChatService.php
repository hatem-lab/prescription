<?php


namespace common\services;


use api\models\chat\UsersLastChatResult;
use api\models\other\ApiMessage;
use common\enums\Constents;
use common\enums\ErrorCode;
use common\enums\MessageStatus;
use common\models\base\BaseActiveDataProvider;
use common\models\base\BasePagination;
use common\models\Chat;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ChatService
{
    public static function webIndex()
    {
        $maxDates = Chat::find()
            ->select(['MAX(' . Chat::tableName() . '.date)'])
            ->andwhere([Chat::tableName() . '.receiver_id' => user()->id])
            ->groupBy([Chat::tableName() . '.sender_id'])
            ->orderBy('date desc')->column();

        $chatList = Chat::find()
            ->andwhere([Chat::tableName() . '.receiver_id' => user()->id])
            ->andWhere(['in', Chat::tableName() . '.date', $maxDates])
            ->groupBy([Chat::tableName() . '.sender_id'])
            ->orderBy('date desc')
            ->all();

//        $chatList = Chat::find()
//            ->andwhere([Chat::tableName() . '.receiver_id' => user()->guser_id])
//            ->groupBy([Chat::tableName() . '.sender_id'])
//            ->->orderBy('date desc')
//            ->all();

        $unseenCountList = Chat::find()
            ->select([Chat::tableName() . '.*', 'count(*) as unseen_count'])
            ->andwhere([Chat::tableName() . '.receiver_id' => user()->id])
            ->andWhere(['<>', Chat::tableName() . '.status', MessageStatus::SEEN])
            ->having(['<>', 'unseen_count', 0])
            ->groupBy([Chat::tableName() . '.sender_id'])
            ->orderBy('date desc')
            ->all();

        $unseenCountList = ArrayHelper::index($unseenCountList, 'sender_id');

        return [$chatList, $unseenCountList];
    }

    public static function view($pagesize = 20, $page = 0)
    {
        $chats = Chat::find()
            ->andwhere([
                'or',
                [Chat::tableName() . '.receiver_id' => user()->id],
                [Chat::tableName() . '.sender_id' => user()->id],
            ])
            ->orderBy('date desc');


        $dataProvider = new ActiveDataProvider([
            'query' => $chats,
            'pagination' => [
                'pagesize' => (isset($pagesize) ? $pagesize : 20),
                'page' => (isset($page) ? $page : 0),
            ],
        ]);
        $reverseChat = array_reverse($dataProvider->getModels());

        $data = [];
        /** @var Chat $chat */
        foreach ($reverseChat as $chat) {

            if ($chat->status != MessageStatus::SEEN && $chat->sender_id != user()->id) {
                $chat->status = MessageStatus::SEEN;
                if (!$chat->save()) {
                    stopv($chat->errors);
                }
            }

            $item = FillApiModelService::FillUserLastApiModel($chat);

            $data[] = $item;
        }

        $res = new UsersLastChatResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ]),
            'pagesCount' => ($dataProvider->getTotalCount() > $pagesize) ? (int)($dataProvider->getTotalCount() / $pagesize) : 1,
        ]);

        return $res;
    }

    public static function webView($receiverId)
    {
        $meId = user()->id;

        $chat = Chat::find()
            ->where([
                'and',
                [Chat::tableName() . '.receiver_id' => $meId],
                [Chat::tableName() . '.sender_id' => $receiverId]
            ])
            ->orWhere([
                'and',
                [Chat::tableName() . '.receiver_id' => $receiverId],
                [Chat::tableName() . '.sender_id' => $meId]
            ])
            ->orderBy(['date' => SORT_DESC]);

        $dataProvider = new BaseActiveDataProvider([
            'query' => $chat,
            'pagination' => [
                'class' => BasePagination::class,
                'params' => Yii::$app->getRequest()->getQueryParams(),
            ],
        ]);


        /** @var Chat $model */
        foreach ($dataProvider->getModels() as $model) {
            if ($model->status != MessageStatus::SEEN && $model->receiver_id == $meId) {
                $model->status = MessageStatus::SEEN;
                $model->save();
            }
        }

        return $dataProvider;

    }

    public static function createNewMessage($request){

        $model = new Chat();
        $model->sender_id = user()->id;
        $model->receiver_id = 6;
        $model->message = $request->message;
        $model->status = 0;
        $model->date = date(Constents::full_date_format);
        $model->dir = "user-admin";


        if (!$model->save()) {
            throw new \yii\web\HttpException(200, "Error saving a new message ", 200);
        } else {
            $data = api_success_msg('A new Message saved.');
        }

        return $data;
    }

    public static function deleteMessage($request){
        $model = Chat::findOne($request->message_id);
        if(!$model){
            throw new \yii\web\HttpException(200, "message not found", 200);
        }
        if($model->sender_id != userId()){
            throw new \yii\web\HttpException(200, "message not yours to delete", 200);
        }

        $model->delete();
        $data = api_success_msg('Message deleted.');

        return $data;
    }

}