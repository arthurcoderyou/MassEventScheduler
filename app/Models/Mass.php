<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Mass extends Model
{
    use HasFactory;

    protected $table = "masses";

    protected $fillable = [
        'mass_intention',
        'details',
        'date',
        'start_time',
        'end_time',
        'location',
        'status',
        'is_delete',
        'user_id'
    ];  


    // protected $dates = ['date'];


    //get mass records for user
    static public function getMyRecord($user_id = 0, $remove_pagination = 0){
        $return = self::select('masses.*')
            ->join('users','users.id','=','masses.user_id')
            ->where('masses.is_delete','=','not_deleted');

        

            if($user_id > 0){
                $return = $return->where('user_id','=',$user_id);
            }
            

        /** 
         * 
        http://127.0.0.1:8000/account/mass/list?
            sort_by=created-desc
            &status%5B%5D=pending&status%5B%5D=confirmed
            &from_date=
            &to_date=
            &from_start_time=
            &to_start_time=
            &from_end_time=
            &to_end_time=
            &search=
         */

        /**Search Filters */
            //check if search [ search ] filter is filled
            if(!empty(Request::get('search'))){
                $search = Request::get('search');
                $return = $return->where(function ($query) use ($search){
                    $query->where('masses.mass_intention','like','%'.$search.'%')
                        ->orWhere('masses.location','like','%'.$search.'%')
                        ->orWhere('users.name','like','%'.$search.'%')
                        ->orWhere('users.email','like','%'.$search.'%');
                });
            }

            //check if search [ status ] filter is filled
            if(!empty(Request::get('status'))){
                $return = $return->whereIn('masses.status',Request::get('status'));
            }

            // //check if search [ status[] ] filter is filled
            // if(!empty(Request::get('status[]'))){
            //     $return = $return->whereIn('status',Request::get('status[]'));
            // }

            //check if search [ from_date ] filter is filled
            if(!empty(Request::get('from_date'))){
                $return = $return->whereDate('masses.date','>=',Request::get('from_date'));
            }

            //check if search [ to_date ] filter is filled
            if(!empty(Request::get('to_date'))){
                $return = $return->whereDate('masses.date','<=',Request::get('to_date'));
            }


            //check if search [ from_start_time ] filter is filled
            if(!empty(Request::get('from_start_time'))){
                $return = $return->whereTime('masses.start_time','>=',Request::get('from_start_time'));
            }

            //check if search [ to_start_time ] filter is filled
            if(!empty(Request::get('to_start_time'))){
                $return = $return->whereTime('masses.start_time','<=',Request::get('to_start_time'));
            }

            //check if search [ from_end_time ] filter is filled
            if(!empty(Request::get('from_end_time'))){
                $return = $return->whereTime('masses.end_time','>=',Request::get('from_end_time'));
            }

            //check if search [ to_end_time ] filter is filled
            if(!empty(Request::get('to_end_time'))){
                $return = $return->whereTime('masses.end_time','<=',Request::get('to_end_time'));
            }



            //Sorting filter
            if(!empty(Request::get('sort_by'))){
                if(Request::get('sort_by') == "name-desc"){
                    $request = $return->orderBy('masses.mass_intention','desc');
                }else if(Request::get('sort_by') == "name-asc"){
                    $request = $return->orderBy('masses.mass_intention','asc');
                }else if(Request::get('sort_by') == "date-desc"){
                    $request = $return->orderBy('masses.date','desc');
                }else if(Request::get('sort_by') == "date-asc"){
                    $request = $return->orderBy('masses.date','asc');
                }else if(Request::get('sort_by') == "created-desc"){
                    $request = $return->orderBy('masses.created_at','desc');
                }else if(Request::get('sort_by') == "created-asc"){
                    $request = $return->orderBy('masses.created_at','asc');
                }
            }else{ //default
                $request = $return->orderBy('masses.id','desc');
            }
                
            //end of for Sorting Filter

        /**end of Search Filters */

        
        
        
        if(empty($remove_pagination)){
            $return = $return->paginate(9)->appends(request()->query());
        
        }else{
            $return = $return->get();
        
        }

        
        return $return;
    }


    //get single
    static public function getSingle($id){
        return self::where('id',$id)
            ->where('is_delete','=','not_deleted')
            ->first();
    }


    
    //mass dates for today 
    static public function getMassToday(){

        return self::whereDate('date','=',now())
            ->where('status' ,'=','confirmed')
            ->where('is_delete','=','not_deleted')
            ->get();

    }

    //get all masses on a date 
    static public function getMassForDate($date){
        return self::whereDate('date','=',$date)
            ->where('status' ,'=','confirmed')
            ->where('is_delete','=','not_deleted')
            ->get();
    }


    //count mass for today 
    static public function countMassToday(){

        return self::whereDate('date','=',now())
            ->where('status' ,'=','confirmed')
            ->where('is_delete','=','not_deleted')
            ->count();

    }

    //count mass for today 
    static public function countMassPending(){

        return self::where('status' ,'=','pending')
            ->where('is_delete','=','not_deleted')
            ->count();

    }

    //count all mass 
    static public function countMassAll(){

        return self::where('is_delete','=','not_deleted')
            ->count();

    }


}
