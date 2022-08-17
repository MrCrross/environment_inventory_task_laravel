<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function arrivals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Arrival::class)->orderBy('arrival');
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function checkName(string $name){
        return self::where('name',$name)->first();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public static function register(Request $request){
        return self::create([
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
        ]);
    }
}
