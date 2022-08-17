<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Equipment::class)->orderBy('name');
    }

    /**
     * @param int $count
     * @param string $search
     * @return mixed
     */
    public static function pagination(int $count,string $search){
        return self::where('name','like',"%{$search}%")->paginate($count);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public static function edit($data,$id){
        return self::where('id',$id)->update([
            'name'=>$data->name,
        ]);
    }
}
