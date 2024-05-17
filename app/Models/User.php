<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    //get record
    static public function getRecord(){

        $return = self::select('*');

        //check if search [ search ] filter is filled
        if(!empty(Request::get('search'))){
            $search = Request::get('search');
            $return = $return->where(function ($query) use ($search){
                $query->where('name','like','%'.$search.'%')
                    ->orWhere('email','like','%'.$search.'%');
            });
        }

        //Sorting filter
        if(!empty(Request::get('sort_by'))){
            if(Request::get('sort_by') == "name-desc"){
                $request = $return->orderBy('name','desc');
            }else if(Request::get('sort_by') == "name-asc"){
                $request = $return->orderBy('name','asc');
            }else if(Request::get('sort_by') == "email-desc"){
                $request = $return->orderBy('email','desc');
            }else if(Request::get('sort_by') == "email-asc"){
                $request = $return->orderBy('email','asc');
            }else if(Request::get('sort_by') == "updated-desc"){
                $request = $return->orderBy('updated_at','desc');
            }else if(Request::get('sort_by') == "updated-asc"){
                $request = $return->orderBy('updated_at','asc');
            }else if(Request::get('sort_by') == "created-desc"){
                $request = $return->orderBy('created_at','desc');
            }else if(Request::get('sort_by') == "created-asc"){
                $request = $return->orderBy('created_at','asc');
            }
        }else{ //default
            $request = $return->orderBy('id','desc');
        }


        $return = $return->paginate(9)->appends(request()->query());

        return $return;

    }

    //count users 
    static public function countUsers(){
        return self::select("*")->count();
    }

}
