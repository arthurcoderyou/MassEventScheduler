@extends('user.layout.app')

@section('content')

<div class="py-28 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32">
  
  <form action="" id="resetPasswordForm">
    @csrf
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
        
      <div class="mb-16 xl:mr-12 w-72 sm:w-full mx-14 text-left">
          <h1 class=" text-md h1-large mb-5">Reset your password</h1>
          <p class=" p-large mb-5">Recover your account</p>

              <div class="mb-4">
                
                <div>
                  <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password <span class="text-red-500">*</span></label>
                  <input type="text" name="new_password" id="new_password" class="password_input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->
                  <p class="mb-3 mt-2"></p> <!-- for error-->
                </div>
                <div>
                  <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password <span class="text-red-500">*</span></label>
                  <input type="password" name="confirm_password" id="confirm_password" class="password_input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->
                  <p class="mb-3 mt-2"></p> <!-- for error-->
                </div>
    
                <div >
                  <div class="control">
                    <label class="checkbox">
                      <input type="checkbox" id="show_password">
                      <span class="check"></span>
                      <span class="control-label" >Show password</span>
                    </label>
                  </div>
                  {{-- <label for="show_password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                  <input type="checkbox" name="show_password" id="show_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->
                  <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error--> --}}
    
                  
                </div>

              </div>
              
          
          <button class="btn-solid-lg" ><i class="fas fa-paper-plane"></i> Confirm</button>

         

      </div>
      <div class="xl:text-right">
          <img class="inline" src="{{ asset('upload/login.gif') }}" alt="alternative" />
      </div>
  
    </div> <!-- end of container -->
  </form>
</div>



@endsection 

@section('script')
  <script type="text/javascript">
  //show password
  $("#show_password").on("click",function(){

    if($(this).is(":checked")){

      $(".password_input").each(function(){
        $(this).prop("type","text");
      });

    }else{

      $(".password_input").each(function(){
        $(this).prop("type","password");
      });

    }

  });

    //ajax code for the form
    $("#resetPasswordForm").submit(function(event){
      event.preventDefault();

      //disable the submit button
      $("button[type='submit']").prop('disabled',true);

      $.ajax({
        url: '{{ route("account.postResetPassword",["token" => $user->remember_token]) }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
          //disable the submit button
          $("button[type='submit']").prop('disabled',false);

          //errors
          var errors = response.errors;
          
          if(response.status == false){

            

            if(errors.new_password){
              $("#new_password").addClass('border border-2 border-red-500');
              $("#new_password").siblings("p").addClass('text-red-500 text-xs ').html(errors.new_password);
            }else{
              $("#new_password").removeClass('border border-2 border-red-500');
              $("#new_password").siblings("p").removeClass('text-red-500 text-xs ').html('');
            }

            if(errors.confirm_password){
              $("#confirm_password").addClass('border border-2 border-red-500');
              $("#confirm_password").siblings("p").addClass('text-red-500 text-xs ').html(errors.confirm_password);
            }else{
              $("#confirm_password").removeClass('border border-2 border-red-500');
              $("#confirm_password").siblings("p").removeClass('text-red-500 text-xs ').html('');
            }

            
           

          }else{
            //remove errors class and messages
            $("#new_password").removeClass('border border-2 border-red-500');
            $("#new_password").siblings("p").removeClass('text-red-500 text-xs ').html('');
            $("#confirm_password").removeClass('border border-2 border-red-500');
            $("#confirm_password").siblings("p").removeClass('text-red-500 text-xs ').html('');

            // Swal.fire('Password Changed Successfully', '', 'success');
            //redirect to login
            window.location.href = "{{ route('account.login') }}";

          }


        },
        error: function(jQXHR, exception){
          console.log("Something went wrong");
        }

      });


    });
  </script>
@endsection