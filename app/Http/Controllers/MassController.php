<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Mass;
use Illuminate\Http\Request;
use App\Mail\MassAdminNotifyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class MassController extends Controller
{
    // //Teacher List
    // public function list(){
        
    //     $data['getRecord'] = User::getTeacher();


    //     $data['header_title'] = "Teacher List";
    //     return view('admin.teacher.list',$data);
    // }

    public function list(Request $request){

        /** Search filters */
            // //Filters
            // $statusArray = [];


            // /**status filter */
            //     if(!empty($request->get('status'))){
            //         $statusArray = explode(',',$request->get('status'));
            //     }
            // /**end of status filter */

            // $data['statusArray'] = $statusArray;

        /**end of Search filters */


        if(Auth::check() && Auth::user()->role == "user"){
            $getRecord = Mass::getMyRecord(Auth::user()->id, 0);
            // dd($getRecord);

            $data['getRecord'] = $getRecord;
            
            return view('user.mass.my_mass',$data);
        }else if(Auth::check() && Auth::user()->role == "admin"){
            $getRecord = Mass::getMyRecord(0, 0);

            // dd($getRecord);

            $data['getRecord'] = $getRecord;
            
            return view('admin.mass.my_mass',$data);
        }
        

        
    }

   

    // User insert  Mass
    public function insert(Request $request){
        // dd($request->all());

        //check if user is authenticated and user role , if not , redirect to login
        if(empty(Auth::check())){
            return response()->json([
                'status' => false,
                'message' => 'Invalid User',
                'url' => route('account.login')
            ]);
        }

        /**
         * 
         * $table->string('mass_intention');
            $table->longText('details');
            $table->datetime('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('location');
            $table->enum('status', ['pending','confirmed','cancelled'])->default('pending');
            $table->enum('is_delete',['not_deleted','deleted']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
         *
         * @return void
        */

        //validate input
        $validator = Validator::make($request->all(),[
            'mass_intention' => 'required',
            'details' => 'required',
            'location' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]); 

        if($validator->passes()){

            $entered_date = strtotime($request->date);
            // dd($entered_date);

            $now = strtotime(now());
            // dd($now);

            
  

            //check if entered date is more than or equal to now 
            if($entered_date < $now){

                $message = 'Date appointment must be after today';

                return response()->json([
                    'status' => false,
                    'errors' => ['date' => $message],
                    'message' => $message
                ]);
            }


            //check if start time is more than end time 
            if($request->start_time >= $request->end_time){
                $message = 'Start time must be before end time of the mass';

                return response()->json([
                    'status' => false,
                    'errors' => ['start_time' => $message],
                    'message' => $message
                ]);
            }


            //Database checkup
            //check for masses at the same date 
            

            $masses = Mass::getMassForDate($request->date);
            // dd($masses);

            $mass_available = true;
            $last_end_time = "";

            if(!empty($masses)){

                foreach ($masses as $mass_event) {
                    
                    //check the start time of the to-be created mass to see if it is more than the end time 
                    if($mass_event->end_time >= $request->start_time){ //if the mass starts not before the end time of an event

                        $last_end_time = $mass_event->end_time;

                        $mass_available = false;                        

                    }


                }


            }
                //if there are no masses for that date, automatically create the mass 
            if($mass_available == true){

            

                $request->session()->flash('success','Mass Intention Created Successfully');
                
                //create new mass
                $mass = new Mass;
                $mass->mass_intention = $request->mass_intention;
                $mass->details = $request->details;
                $mass->location = $request->location;
                $mass->date = $request->date;
                $mass->start_time = $request->start_time;
                $mass->end_time = $request->end_time;
                $mass->user_id = Auth::user()->id;
                $mass->save();

                /*Email notification to admin*/
                    //get user
                    $user = User::findOrFail($mass->user_id);

                    /**Add Mail Details */
                    $user->send_subject = "New Mass Intention Notification Mail";
                    $user->send_title = "Mass Intention Created";

                    //Notification email
                    Mail::to("arthurcervania13@gmail.com")->send(new MassAdminNotifyMail($user,$mass));
                /*end of Email notification to admin*/

                return response()->json([
                    'status' => true,
                ]);
            
            }else{
                $message = 'The start of the mass conflicts with a scheduled mass. Last mass ends in '.date('h:i a',strtotime($last_end_time)).'. Please try other time schedules.';
            
                return response()->json([
                    'status' => false,
                    'errors' => ['start_time' => $message],
                    'message' => $message
                ]);
            
            }

        }else{
            $message = count($validator->errors())." errors found";

            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => $message
                
            ]);
        }

    }

    // User update  Mass
    public function update(Request $request){
        // dd($request->all());

        $mass = Mass::getSingle($request->mass_id);


        if(empty($mass)){
            abort(404);
        }

        //check if user is authenticated and user role , if not , redirect to login
        if(empty(Auth::check())){
            return redirect()->route('account.login');
        }

        

        //validate input
        $validator = Validator::make($request->all(),[
            'mass_intention' => 'required',
            'details' => 'required',
            'location' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]); 

        if($validator->passes()){


            $entered_date = strtotime($request->date);
            // dd($entered_date);

            $now = strtotime(now());
            // dd($now);

            //check if entered date is more than or equal to now 
            if($entered_date < $now){

                $message = 'Date appointment must be after today';

                return response()->json([
                    'status' => false,
                    'errors' => ['date' => $message],
                    'message' => $message
                ]);
            }

            //check if start time is more than end time 
            if($request->start_time >= $request->end_time){
                $message = 'Start time must be before end time of the mass';

                return response()->json([
                    'status' => false,
                    'errors' => ['start_time' => $message],
                    'message' => $message,
                ]);
            }

            //create new mass
            $mass->mass_intention = $request->mass_intention;
            $mass->details = $request->details;
            $mass->location = $request->location;
            $mass->date = $request->date;
            $mass->start_time = $request->start_time;
            $mass->end_time = $request->end_time;
            // $mass->user_id = Auth::user()->id;
            $mass->updated_at = now();
            $mass->save();

            $message = 'Mass Intention Updated Successfully';

            $request->session()->flash('success',$message);

            // return response()->json([
            //     'status' => true,
            //     'message' => $message,
            // ]);
            return redirect()->route('user.mass.list')->with('success','Mass Intention Updated Successfully');

        }else{
            $message = 'Something went wrong';
            return redirect()->route('user.mass.list')->with('error','Something went wrong');
            // $request->session()->flash('error',$message);

            // return response()->json([
            //     'status' => false,
            //     'message' => $message,
            // ]);
        }

    }

    //delete mass
    public function delete(Request $request){
        // dd($request->all());

        $mass = Mass::getSingle($request->mass_id);

        if(!empty($mass)){
            $mass->is_delete = "deleted";
            $mass->save();
        }

        $request->session()->flash('success','Mass Deleted Successfully');

        return response()->json([
            'status' => true,
        ]);
    }
    
    
    //Ajax function to fetch mass values
    public function get_mass_values(Request $request){
        // dd($request->request); //check request

       
            $mass = Mass::getSingle($request->mass_id);
            // dd($mass);
            return response()->json([
                "status" => true,
                "success" => view('user.mass._mass_form_body',[
                    "getMass" => $mass
                ])->render(),
            ],200);

        
    }


    //print mass records 
    //print statement of account
    public function print_mass_records(Request $request){
        // dd($request->all());

        // if(Auth::user()->user_type == 'admin'){
            // $data['getRecord'] = Setting::getSingle(1);
            $data['today'] = now();

            if(Auth::user()->role == "user"){
                $data['getRecord'] = Mass::getMyRecord(Auth::user()->id, 1);
                // dd($data['getRecord']);
            
                return view('user.mass.statement',$data);
            }else if(Auth::user()->role == "admin") {
                $data['getRecord'] = Mass::getMyRecord(0, 1);
                // dd($data['getRecord']);
            
                return view('user.mass.statement',$data);
            }
            



    }

    

    // Admin confirm  Mass
    public function confirm(Request $request){
        // dd($request->all());


        $mass = Mass::getSingle($request->mass_id);

       

        //check if start time is more than end time 
        if($mass->start_time >= $mass->end_time){
            return response()->json([
                'status' => false,
                'errors' => ['start_time' => 'Start time must be before end time of the mass']
            ]);
        }


        //Database checkup
        //check for masses at the same date 
        

        $masses = Mass::getMassForDate($mass->date);
        // dd($masses);

        $mass_available = true;
        $last_end_time = "";

        if(!empty($masses)){

            foreach ($masses as $mass_event) {
                
                //check the start time of the to-be created mass to see if it is more than the end time 
                if($mass_event->end_time >= $mass->start_time){ //if the mass starts not before the end time of an event

                    $last_end_time = $mass_event->end_time;

                    $mass_available = false;

                }


            }


        }
        //if there are no masses for that date, automatically create the mass 
        if($mass_available == true){

        
            $request->session()->flash('Mass Intention Confirmed Successfully');
            
            //update the mass
            $mass->status = "confirmed";
            $mass->updated_at = now();

            $mass->save();

            /*Email notification to admin*/
                //get user
                $user = User::findOrFail($mass->user_id);

                /**Add Mail Details */
                $user->send_subject = "Mass Intention Confirmed for ".$mass->mass_intention;
                $user->send_title = "Mass Intention Confirmed for ".$mass->mass_intention;

                //Notification email //"arthurcervania13@gmail.com"
                Mail::to($user->email)->send(new MassAdminNotifyMail($user,$mass));
            /*end of Email notification to admin*/

           

            return response()->json([
                'status' => true,
            ]);
            
        }else {

            $message = 'The start of the mass conflicts with a scheduled mass. Last mass ends in '.date('h:i a',strtotime($last_end_time)).'. Please try other time schedules.';
            return response()->json([
                'status' => false,
                'errors' => ['start_time' => $message],
                'message' => $message
            ]);
        }



    }


    // Admin cancel  Mass
    public function cancel(Request $request){
        // dd($request->all());


        $mass = Mass::getSingle($request->mass_id);

       
            $request->session()->flash('Mass Intention Cancelled Successfully');
            
            //update the mass
            $mass->status = "cancelled";
            $mass->updated_at = now();

            $mass->save();


            /*Email notification to admin*/
                //get user
                $user = User::findOrFail($mass->user_id);

                /**Add Mail Details */
                $user->send_subject = "Mass Intention Cancelled for ".$mass->mass_intention;
                $user->send_title = "Mass Intention Cancelled for ".$mass->mass_intention;

                //Notification email //"arthurcervania13@gmail.com"
                Mail::to($user->email)->send(new MassAdminNotifyMail($user,$mass));
            /*end of Email notification to admin*/


            return response()->json([
                'status' => true,
            ]);
            
      



    }



}

