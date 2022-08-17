<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arrival extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'arrival';
    protected $fillable = [
        'equipment_id',
        'user_id',
        'count',
        'arrival'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $request
     * @param int $count
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function pagination($request, int $count): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $arrival= self::with('equipment.category','user');
        if(isset($request->equipment)){
            $arrival=$arrival->whereIn('equipment_id',$request->equipment);
        }
        if(isset($request->category)){
            $arrival=$arrival->whereHas('equipment.category',function($query)use($request){
                return $query->whereIn('category_id',$request->category);
            });
        }
        if(isset($request->user)){
            $arrival=$arrival->whereHas('user',function($query)use($request){
                return $query->whereIn('users.id',$request->user);
            });
        }
        if(isset($request->arrival_start)){
            $arrival=$arrival->where('arrival','>=',$request->arrival_start);
        }
        if(isset($request->arrival_end)){
            $arrival=$arrival->where('arrival','<=',$request->arrival_end);
        }
        if(isset($request->count_start)){
            $arrival=$arrival->where('count','>=',$request->count_start);
        }
        if(isset($request->count_end)){
            $arrival=$arrival->where('count','<=',$request->count_end);
        }
        return $arrival->paginate($count);
    }

    /**
     * @param $data
     * @param int $id
     * @return mixed
     */
    public static function edit($data,int $id){
        return self::where('id',$id)->update([
            'equipment_id'=>$data->equipment_id,
            'count'=>$data->count,
            'arrival'=>$data->arrival
        ]);
    }

    /**
     * @param $request
     * @param $user_id
     * @return void
     */
    public static function add($request,$user_id){
        foreach ($request as $value){
            $value=(object)$value;
            self::create([
                'equipment_id'=>$value->equipment_id,
                'user_id'=>$user_id,
                'count'=>$value->count,
                'arrival'=>$value->arrival
            ]);
        }
        return;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public static function getId(int $id){
        return self::with('equipment.category','user')->where('id',$id)->first();
    }
}
