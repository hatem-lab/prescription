<?php

namespace App\services;

use App\enums\ActiveInactiveStatus;
use App\enums\ErrorCode;
use App\enums\OfferStatus;
use App\enums\RequestStatus;
use App\enums\UserStatus;
use App\Http\Requests\OfferRequest;
use App\Models\API\lists\CarTypeResult;
use App\Models\API\orders\OfferResult;
use App\Models\API\orders\OrderResult;
use App\Models\API\other\ApiMessage;
use App\Models\CarType;
use App\Models\Location;
use App\Models\notifications\Notification;
use App\Models\notifications\offer\DeleteOfferNotification;
use App\Models\notifications\offer\NewOfferNotification;
use App\Models\notifications\order\NewOrderNotification;
use App\Models\Offer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Queue\RedisQueue;


class OrdersService {

    public static function index($request) {

        $query = Order::all();

        if ($request->order_id) {
            $query = $query->where('id', $request->order_id);
        }

        $data = [];
        foreach ($query as $one) {

            $item = FillApiModelService::FillOrderApiModel($one);
            $data[] = $item;
        }

        return new OrderResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
    }

    public static function createOrder($request){
        try{

            $order = (isset($request->order_id)) ? Order::find($request->order_id) : new Order();

            if(isset($request->order_id)) {
                if ($order->user_id != user()->id)
                    return returnError("This order is not found");
                if ($order->status != RequestStatus::new_request && $order->status != RequestStatus::reserved)
                    return returnError("You can't update this order!");
            }


            $order->user_id = user()->id;
            $order->description = isset($request->description) ? $request->description : $order->description;
            $order->dateTime = isset($request->dateTime) ? Carbon::make($request->dateTime) : Carbon::make($order->dateTime);
            $order->from = isset($request->from) ? $request->from : $order->from;
            $order->to = isset($request->to) ? $request->to : $order->to;
            $order->price = isset($request->price) ? $request->price : $order->price;
            $order->status = RequestStatus::new_request;
            $order->isWantRide = isset($request->isWantRide) ? $request->isWantRide : $order->isWantRide;
            $order->car_type_id = isset($request->car_type_id) ? $request->car_type_id : $order->car_type_id;

            $location_to = Location::where('id' , $order->to)->where('user_id' ,  user()->id)->first();
            $location_from = Location::where('id' , $order->from)->where('user_id' ,  user()->id)->first();

            if(!$location_to || !$location_from){
                return returnError("This Location is not found! ");
            }

            $order->address_to = $location_to->address;
            $order->region_id_to = $location_to->region_id;
            $order->lat_to = $location_to->lat;
            $order->lng_to = $location_to->lng;

            $order->address_from = $location_from->address;
            $order->region_id_from = $location_from->region_id;
            $order->lat_from = $location_from->lat;
            $order->lng_from = $location_from->lng;

            $order->save();

            if(!isset($request->order_id)){
                Notification::send(new NewOrderNotification($order));
            }


            self::removeOffers($order->offers);

            return isset($request->order_id) ? returnSuccess("A new order has been updated")
                                             : returnSuccess("A new order has been added");

        }catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage());
        }

    }

    public static function createOffer($request){
        try{
            $admin = admin();

            $order = Order::with('regionFrom')
                ->get()
                ->where('id' , $request->order_id)
                ->where('regionFrom.city.id', admin()->region->city->id)
                ->first();


            if(!$order){
                return returnError("This Order is not found");
            }

            if($order->status != RequestStatus::new_request){
                return returnError("This Order is reserved");
            }

            foreach ($order->offers as $one){
                if($one->admin_id == admin()->id) return returnError("You have already submitted an offer to this order!");
            }


            $offer = new Offer();
            $offer->admin_id = $admin->id;
            $offer->order_id = $request->order_id;
            $offer->description = $request->description;
            $offer->price = $request->price;
            $offer->ET = Carbon::make($request->ET);
            $offer->status = UserStatus::STATUS_ACTIVE;

            $offer->save();

            Notification::send(new NewOfferNotification($offer));

            return returnSuccess("A new offer has been added");

        }catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage());
        }

    }

    public static function getOrders($isUser = false , $isNewRequest = false){

        try {
            if ($isUser) {
                $query = Order::where('user_id', user()->id)
                    ->orderBy('id' , 'desc');

                $query = $isNewRequest ?
                    $query->where('status' , RequestStatus::new_request)
                    ->get():
                    $query->get();

            } else {

                $query1 = isset(admin()->region_id) ?
                    Order::with('regionFrom')
                        ->get()
                    ->where('regionFrom.city.id', admin()->region->city->id)
                    : [];

                $query2 = isset(admin()->region_id) ?
                    Order::with('regionTo')
                        ->get()
                        ->where('regionTo.city.id', admin()->region->city->id)
                    : [];

                $query = $query1->merge($query2)
                    ->where('status', RequestStatus::new_request)
                    ->where('car_type_id', admin()->car_type_id)
                    ->sortByDesc('id');

            }
           // return [true , $query , '' , ''];

            $data = [];
            foreach ($query as $one) {
                $item = FillApiModelService::FillOrderApiModel($one);
                $data[] = $item;
            }



            $res = new OrderResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true , $res , '' , ''];
        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }

    }

    public static function getOrdersDelivery()
    {
        try {

            $query = Offer::with('order')
                    ->where('admin_id', admin()->id)
                    ->where('status', OfferStatus::accepted)
                    ->get();


            $data = [];
            foreach ($query as $one) {
                $item = FillApiModelService::FillOrderApiModel($one->order, 2);
                $data[] = $item;
            }


            $res = new OrderResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true , $res , '' , ''];

        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }

    }


    public static function getOffers($request){

        try {
            $query = Order::where('id', $request->order_id)
                ->where('user_id', user()->id)
                ->first();

            if (!$query) return [false, null, "This order not found" , ''];

            $items = FillApiModelService::FillOfferApiModel($query->offers);

            $data = new OfferResult([
                'result' => $items,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true, $data, '' , ''];
        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }

    }

    public static function getMyOffers($request){

        try {
            $query = Offer::where('admin_id', admin()->id)
                ->orderBy('created_at' , 'desc')
                ->get();

            $items = FillApiModelService::FillOrderOfferApiModel($query);

            $res = new OfferResult([
                'result' => $items,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true , $res , '' , ''];

        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }

    }

    public static function getOrderDetails($request){

        try {
            $user = user();
            $order = Order::where('id', $request->order_id)
                ->where('user_id', $user->id)
                ->first();

            if (!$order) {
                return [false, null, "This order is not found", ''];
            }

            $item = FillApiModelService::FillOrderApiModel($order, 1);


            $data = new OrderResult([
                'result' => $item,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);
            return [true, $data, '', ''];

        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }

    }


    public static function getOrderDetailsDelivery($request){

        try {

            $query1 = isset(admin()->region_id) ?
                Order::with('regionFrom')
                    ->get()
                    ->where('regionFrom.city.id', admin()->region->city->id)
                : [];

            $query2 = isset(admin()->region_id) ?
                Order::with('regionTo')
                    ->get()
                    ->where('regionTo.city.id', admin()->region->city->id)
                : [];

            $order =  $query1->merge($query2)
                ->where('id', $request->order_id)
                ->where('car_type_id', admin()->car_type_id)
                ->first();

            if (!$order) {
                return [false, null, "This order is not found", ''];
            }

            $item = FillApiModelService::FillOrderApiModel($order, 3);


            $data = new OrderResult([
                'result' => $item,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true, $data, '', ''];

        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }
    }

    public static function removeOffers($offers){

        foreach($offers as $offer){
            $offer->delete();
        }

    }

    public static function rejectOffers($offers){

        foreach($offers as $offer){
            $offer->status = OfferStatus::rejected;
            $offer->save();
        }

    }

    public static function deleteOrder($request){

        try {
            $order = Order::find($request->order_id);

            if ($order->user_id != user()->id)
                return returnError("This order not found");

            if ($order->status != RequestStatus::new_request && $order->status != RequestStatus::reserved)
                return returnError("You can't delete this order!");

            self::removeOffers($order->offers);
            $order->delete();
            return returnSuccess("This order has been deleted");
        }catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }

    }

    public static function deleteOffer($request){

        try {
            $offer = Offer::find($request->offer_id);

            $order = $offer->order;

            if ($offer->admin_id != admin()->id)
                return returnError("This offer not found");

            if ($order->status != RequestStatus::new_request && $order->status != RequestStatus::reserved)
                return returnError("You can't delete this offer!");

            if ($offer->status == OfferStatus::accepted) {
                $order->status = RequestStatus::new_request;
                $order->save();
            }
            $offer->delete_resion = $request->delete_resion;
            Notification::send(New DeleteOfferNotification($offer));

            $offer->delete();
            return returnSuccess("This offer has been deleted");
        } catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function acceptOffer($request)
    {
        try {
            $offer = Offer::find($request->offer_id);
            $order = $offer->order;

            if (!$order || $order->user_id != user()->id) {
                return returnError("This offer is not found");
            } elseif ($offer->status != OfferStatus::new_offer) {
                return returnError("You can't accept this offer");
            }

            $offers = $order->offers;

            self::rejectOffers($offers);

            $offer->status = OfferStatus::accepted;
            $offer->save();
            $order->status = RequestStatus::reserved;
            $order->save();
            return returnSuccess("This offer has been accepted");

        } catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }

    }

    public static function changeStatusOrder($request){
        try {
            $order = Order::find($request->order_id);
            $offer = $order->offers
                ->where('admin_id' , admin()->id)
                ->where('status' , OfferStatus::accepted);

            if(!$offer) return returnError("You can't change status this order!");

            if ($order->status == RequestStatus::reserved) $order->status = RequestStatus::on_way;
            else if ($order->status == RequestStatus::on_way) $order->status = RequestStatus::delivered;
            else return returnError("You can't change status this order!");

            $order->save();
            return returnSuccess("Done !");
        } catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }

    }

    public static function changePaidStatus($request){
        try {
            $order = Order::find($request->order_id);
            $offer = $order->offers
                ->where('admin_id' , admin()->id)
                ->where('status' , OfferStatus::accepted);

            if(!$offer || $order->status == RequestStatus::reserved
            || $order->status == RequestStatus::new_request )
                return returnError("You can't change paid status this order!");

            $order->isPaid = !$order->isPaid;

            $order->save();
            return returnSuccess("Done !");
        } catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }

    }

}
