<?php

namespace App\Services;

use App\Models\Equipment;
use Exception;
use Illuminate\Support\Facades\DB;

class EquipmentService
{
    /**
     * @param $request
     * @return array
     */
    public function create($request): array
    {
        try {
            DB::beginTransaction();
            foreach ($request as $value){
                Equipment::create($value);
            }
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Оборудование успешно добавлено.'
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
            Equipment::edit($request,$id);
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Оборудование успешно изменено.'
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
            Equipment::where('id',$id)->delete();
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Оборудование успешно удалено.'
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
