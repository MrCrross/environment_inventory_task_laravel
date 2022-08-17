<?php

namespace App\Services;

use App\Models\Arrival;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArrivalService
{
    /**
     * @param $request
     * @return array
     */
    public function create($request): array
    {
        try {
            DB::beginTransaction();
            $user_id =Auth::user()->getAuthIdentifier();
            Arrival::add($request,$user_id);
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Прибытие успешно зарегистрировано.'
            ];
        }catch (Exception $e){
            DB::rollBack();
            return [
                'success'=>false,
                'code'=>$e->getCode(),
                'message'=>$e->getMessage()
            ];
        }
    }

    /**
     * @param $request
     * @param int $id
     * @return array
     */
    public function update($request,int $id): array
    {
        try{
            DB::beginTransaction();
            Arrival::edit($request,$id);
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Данные о прибытии успешно изменены.'
            ];
        }catch (Exception $e){
            DB::rollBack();
            return [
                'success'=>false,
                'code'=>$e->getCode(),
                'message'=>$e->getMessage()
            ];
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        try{
            DB::beginTransaction();
            Arrival::where('id',$id)->delete();
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Данные о прибытии успешно удалены.'
            ];
        }catch (Exception $e){
            DB::rollBack();
            return [
                'success'=>false,
                'code'=>$e->getCode(),
                'message'=>$e->getMessage()
            ];
        }
    }
}
