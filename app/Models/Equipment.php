<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'equipments';

    protected $fillable = [
        'name',
        'price',
        'category_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function arrivals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Arrival::class)->orderBy('arrival');
    }

    /**
     * @param $request
     * @param int $size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function pagination($request,int $size): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $equipment = self::with('category');
        if(isset($request->name)){
            $equipment =$equipment->where('name','like',"%{$request->name}%");
        }
        if(isset($request->price_start)){
            $equipment=$equipment->where('price','>=',$request->price_start);
        }
        if(isset($request->price_end)){
            $equipment=$equipment->where('price','<=',$request->price_end);
        }
        if(isset($request->category)){
            $equipment=$equipment->whereIn('category_id',$request->category);
        }
        return $equipment->paginate($size);
    }

    /**
     * @param $data
     * @param int $id
     * @return mixed
     */
    public static function edit($data,int $id){
        return self::where('id',$id)->update([
            'name'=>$data->name,
            'price'=>$data->price,
            'category_id'=>$data->category_id
        ]);
    }
}
