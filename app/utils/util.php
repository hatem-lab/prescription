<?php


use App\Models\API\other\ApiMessage;
use App\Models\API\other\ApiResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

function getCurrentLang()
{
    return app()->getLocale();
}
function getActive($status){

    /* return $status == 1 ? 'مفعل' : 'غير مفعل'; */
    return $status == 1 ? 'Published' :' Un-published';
 }

function getFolder()
{

    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}

function returnError($msg, $ex = '' , $errNum = \App\enums\ErrorCode::error )
{
    return response()->json(api_error_msg($msg , $errNum , 'Error' , $ex));
}

function returnSuccess($msg , $ex = '' , $errNum = \App\enums\ErrorCode::success )
{
    return response()->json(api_error_msg($msg , $errNum , 'Success' , $ex));
}

function stopv($obj = '', $msg = '') {
    echo $msg ? "$msg<br/>" : "";
    var_dump($obj);
    die();
}

function api_error_msg($message, $code , $type , $ex) {
    if(!$code){
        $code = \App\enums\ErrorCode::error;
    }
    $model = new ApiResult([
        'isOk' => $type == 'Success',
        'message' => new ApiMessage([
            'type' => $type,
            'code' => (int)$code,
            'content' => is_array($message) ? implode($message) : $message,
        ]),
        'exception' => $ex
    ]);
    return $model;
}

function user() {
    return Auth::guard('user-api')->user();
}

function admin() {
    return Auth::guard('admin-api')->user();
}

function uploadImage($image , $fileName)
{
    $imageName =  time().'.'. $image->extension();
    $imageToSave = $fileName . DIRECTORY_SEPARATOR . time().'.'. $image->extension();

    $image->move(public_path('storage'. DIRECTORY_SEPARATOR .$fileName), $imageName);
    return $imageToSave;
}

function uploadImage1($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
 }

function getImage($image)
{
    return URL::to('/') . 'assets/images/courses/' . $image;
}
