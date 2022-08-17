<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    /**
     * @param array $request
     * @return mixed
     */
    public function create(array $request){
        try{
            DB::beginTransaction();
            foreach ($request as $value) {
                Category::create($value);
            }
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Категория(и) добавлена(ы) успешно.'
            ];
        }catch (\Exception $e){
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
     * @return mixed
     */
    public function update($request,int $id){
        try{
            DB::beginTransaction();
            Category::edit($request,$id);
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Категория изменена успешно.'
            ];
        }catch (\Exception $e){
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
            Category::where('id',$id)->delete();
            DB::commit();
            return [
                'success'=>true,
                'message'=>'Категория удалено успешно.'
            ];
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'success'=>false,
                'code'=>$e->getCode(),
                'message'=>$e->getMessage()
            ];
        }
    }
}
