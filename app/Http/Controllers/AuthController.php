<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\PasswordStrengthValidation;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
use Str;
use App\Mail\ForgotPasswordMail; //for the forgot password
use App\Mail\VerifyEmail; //for the email verification
use Mail;


class AuthController extends Controller
{
    //login
    public function login(){
        return view('user.account.login');
    }


    //register
    public function register(){
        return view('user.account.register');
    }

    //post : register 
    public function processRegister(Request $request){
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            
            'password' => [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->passes()){
            //create the new User
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $request->session()->flash('success','Account registered successfully');

            return response()->json([
                'status' => true
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


    }

    //post : login
    public function authenticate(Request $request){
        //validate
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users',
            'password' => [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            
        ],[
            'email.exists' => "The selected email is not registered"
        ]);

        if($validator->passes()){

            //attempt to login the user
            if(Auth::attempt(['email' => $request->email, 'password' =>  $request->password], $request->get('remember'))){
                $url = route("home");

                //to redirect the user to the intended url if the used is authenticated
                if(session()->has('url.intended')){
                    $url = session()->get('url.intended');
                }


                $request->session()->flash('success','Welcome '.Auth::user()->name.'!');


                //if login success
                return response()->json([
                    'status' => true,
                    'url' => $url
                ]);

            }else{
                //if login failed
                
                return response()->json([
                    'status' => false,
                    'errors' => ['password' => 'Wrong password, Please Try Again']
                ]);


            }

        }else{
            
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }
    }

    
    
    //update profile
    public function updateProfile(Request $request){
        // dd($request->all());
        // echo "hello";
        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'new_name' => 'required|unique:users,name,'.$userId.',id',
            'new_email' => 'required|email|unique:users,email,'.$userId.',id',
            'new_password' => [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            'confirm_new_password' => 'required|same:new_password',
        ]);

        if($validator->passes()){ // if the validator passes

            $user = User::find($userId);
            $user->name = $request->new_name;
            $user->email = $request->new_email;
            $user->password = Hash::make($request->new_password);
            $user->save();

            $message = 'Profile Updated Successfully';
            //session success
            session()->flash('success',$message);

            //json success response
            return response()->json([
                'status' => true,
                'message' => $message
            ]);

        }else{ //if not, return a error json response
            $message = count($validator->errors())." errors found";
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => $message
            ]);
        }


    }

    //logout
    public function logout(){
        Auth::logout();
        
        return redirect()->route('account.login')
            ->with('success','You have successfully logged out!');

    }


    //show change password
    public function showChangePasswordForm(){
        return view('front.account.change-password');
    }

    //change password
    public function changePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password' => [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            'new_password' =>  [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            'confirm_password' => 'required|same:new_password',
        ]); 

        if($validator->passes()){ //if input is valid

            //update the user password
            $user = User::select('password')->where('id',Auth::user()->id)->first();
            // dd($user);

            if(!Hash::check($request->old_password,$user->password)){ //if old password is not correct

                //return an error response
                session()->flash('error','Your old password is incorrect, Please try again');

                //error response
                return response()->json([
                    'status' => true
                ]);

            }

            //if no errors found update the password
            User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            $request->session()->flash('success','You have successfully changed your password');

            return response()->json([
                'status' => true
            ]);

            

        }else{// if input is not valid

            //return a json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


    }

    //forgot password
    public function forgotPassword(){
        // dd("run");
        return view('user.account.forgot-password');
    }

    //post : forgot password
    public function postForgotPassword(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            
        ]);

        $url = route('account.forgotPassword');

        if($validator->passes()){

            $user = User::where('email',$request->email)->first();

            //check if user with the email exists
            if(!empty($user)){

                //dd($user);

                //remember token
                $user->remember_token = Str::random(30);
                $user->save();

                //create a new mailer
                Mail::to($user->email)->send(new ForgotPasswordMail($user));

                $request->session()->flash('success','Reset Email Successfully Sent');

                return response()->json([
                    'status' => true,
                    'url' => $url
                ]);

            }else{
                //if login failed
                //session()->flash('error','Either email/password is incorrect');
                // return redirect()->route('account.forgotPassword')
                //     ->withInput($request->only('email'))
                //     ->with('error','Email is not registered');
                    //return a json error response
                return response()->json([
                    'status' => false,
                    'errors' => ['email' => 'The email does not exists']
                    
                ]);
            }

        }else{
            //return a json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                
            ]);
        }

        
    }


    //reset password form
    public function reset($token){
        // dd($token);

        //check if the passed token matches the code that we used
        $user = User::where('remember_token',$token)->first();

        // dd($user);


        if(!empty($user)){

            $data['user'] = $user;
            return view('user.account.reset',$data);

        }else{
            //if there is token mismatch
            abort(404);
        }


        //dd($token);
    }

    //post : reset password form
    public function postReset(Request $request,$token){
        //check if the passed token matches the code that we used
        $user = User::where('remember_token',$token)->first();
        if(!empty($user)){

            //validate the values
            $validator = Validator::make($request->all(),[
                'new_password' =>  [
                    'required',
                    'min:8',
                    new PasswordStrengthValidation(),
                ],
                'confirm_password' => 'required|same:new_password',
            ]); 

            if($validator->passes()){

                $user->password = Hash::make($request->new_password);
                $user->save();

                //success session
                
                $request->session()->flash('success','Password Successfully Updated');

                //success json response
                return response()->json([
                    'status' => true,

                ]);
            
            }else{
                //if values are not valid, return the json error response
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }





        }else{
            //if there is token mismatch
            abort(404);
        }

    }

    //verify email
    public function verifyEmail(){

        //check if the user is really verified 
        if(Auth::check() ){

            $user = Auth::user();

            //set the user remember_token
            $user->remember_token = Str::random(30);
            $user->save();

            //create a new mailer
            Mail::to($user->email)->send(new VerifyEmail($user));

            return redirect()->back()->with('success','Email verification sent. Please check you inbox and click the verification button');

        }else{
            Auth::logout();
            return redirect()->route("front.home");
        }
        
    }

    //email verified
    public function emailVerified($token){

        //check if user is auth
        if(Auth::check()){
            $user = Auth::user();

            if($token == $user->remember_token){

                $user->email_verified_at = now();
                $user->save();

                return redirect()->route("account.profile")->with('success','Email verified');

            }else{

                return redirect()->route("account.profile")->with('error','Token mismatch');
            }


        }else{
            Auth::logout();
            return redirect()->route("front.home");
        }

        

    }



    //donate
    public function donate(Request $request){


        //get the Teacher paypal email
        $user = Auth::user();
        //dd($getSetting);

        //if the teacher has no paypal email registered to receive the money, the transaction will not be proceeded
        if(empty($user)){
            abort(404);
        }

        $query = array();
        $query['business']        = "arthurcervania13@gmail.com"; // this is the email of the admin paypal email account where the payment will be sent
        $query['cmd']             = '_xclick';
        // $query['cmd']             = 'donations';
        $query['item_name']       = "Donation"; //name of the item being paid
        $query['no_shipping']     = '1';
        $query['item_number']     = $user->id; //to track which payment transaction is being paid
        $query['amount']          = $request->amount;
        $query['currency_code']   = 'PHP'; // the currency we are using on our paypal
        $query['cancel_return']   = route('account.donate.success'); //route to the error payment page
        $query['return']          = route('account.donate.error'); //route to the success payment page

        $query_string = http_build_query($query);

        header('Location: https://www.paypal.com/cgi-bin/webcsr?'.$query_string);
        exit();



    }

    //donation success
    public function donation_success(){

        return redirect()->route('home')->with('success','Donation Success. Thank you so much :) ');

    }

    //donation error
    public function donation_error(){

        return redirect()->route('home')->with('error','Donation Error. Something went wrong. Please Try Again ');

    }


}
