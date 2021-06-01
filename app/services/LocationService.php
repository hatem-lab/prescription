<?php

namespace App\services;



use App\enums\ActiveInactiveStatus;
use App\enums\ErrorCode;
use App\Models\API\location\LocationResult;
use App\Models\API\other\ApiMessage;
use App\Models\Country;

class LocationService {

    public static function Countries($pagesize = 20, $page = 0, $search = '') {
        $query = Country::find()
            ->andWhere(['is_active' => ActiveInactiveStatus::active])
        ;
        if($search && $search != '{search}' && $search != ','){
            $query = $query->andWhere(['OR', ['like', 'name', $search]]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => (isset($pagesize) ? $pagesize :  20),
                'page' => (isset($page) ? $page :  0),
            ],
        ]);
        $data = [];
        foreach ($dataProvider->getModels() as $one){
            $item = FillApiModelService::FillCountryApiModel($one);
            $data[] = $item;
        }

        $res = new CountryResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }

    public static function States($country_id = '', $pagesize = 20, $page = 0, $search = '') {
        $query = State::find()
            ->andWhere(['is_active' => ActiveInactiveStatus::active])
        ;
        if($search && $search != '{search}' && $search != ','){
            $query = $query->andWhere(['OR', ['like', 'name', $search]]);
        }
        if($country_id && $country_id != '{country_id}' && $country_id != ','){
            $query = $query->andWhere(['country_id' => $country_id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => (isset($pagesize) ? $pagesize :  20),
                'page' => (isset($page) ? $page :  0),
            ],
        ]);
        $data = [];
        foreach ($dataProvider->getModels() as $one){
            $item = FillApiModelService::FillStateApiModel($one);
            $data[] = $item;
        }

        $res = new StateResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }

    public static function Cities($state_id = '', $pagesize = 20, $page = 0, $search = '') {
        $query = City::find()
            ->andWhere(['is_active' => ActiveInactiveStatus::active])
        ;
        if($search && $search != '{search}' && $search != ','){
            $query = $query->andWhere(['OR', ['like', 'name', $search]]);
        }
        if($state_id && $state_id != '{state_id}' && $state_id != ','){
            $query = $query->andWhere(['state_id' => $state_id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => (isset($pagesize) ? $pagesize :  20),
                'page' => (isset($page) ? $page :  0),
            ],
        ]);
        $data = [];
        foreach ($dataProvider->getModels() as $one){
            $item = FillApiModelService::FillCityApiModel($one);
            $data[] = $item;
        }

        $res = new CityResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }

    public static function Areas($city_id = '', $pagesize = 20, $page = 0, $search = '') {
        $query = Area::find()
            ->andWhere(['is_active' => ActiveInactiveStatus::active])
        ;
        if($city_id && $city_id != '{city_id}' && $city_id != ','){
            $query = $query->andWhere(['city_id' => $city_id]);
        }
        if($search && $search != '{search}' && $search != ','){
            $query = $query->andWhere(['OR', ['like', 'name', $search]]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => (isset($pagesize) ? $pagesize :  20),
                'page' => (isset($page) ? $page :  0),
            ],
        ]);
        $data = [];
        foreach ($dataProvider->getModels() as $one){
            $item = FillApiModelService::FillAreaApiModel($one);
            $data[] = $item;
        }

        $res = new AreaResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }

    public static function index($request) {
        try {
            $query = Country::where(['countries.status' => ActiveInactiveStatus::active]);

            if ($request->country_id) {
                $query = $query->where(['id' => $request->country_id]);
            }


            $data = [];
            foreach ($query->get() as $one) {
                $item = FillApiModelService::FillLocationCountryApiModel($one);
                $data[] = $item;
            }


            $res = new LocationResult([
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

}
