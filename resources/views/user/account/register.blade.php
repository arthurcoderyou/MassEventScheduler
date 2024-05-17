@extends('user.layout.app')

@section('content')

<div class="py-28 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32">
 
  <form action="" id="registrationForm">
    @csrf
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
        
      <div class="mb-16 xl:mr-12 w-72 sm:w-full mx-14 text-left">
          <h1 class=" text-md h1-large mb-5">Register</h1>
          <p class=" p-large mb-5">Create Account</p>

          <div class="mb-4">
            <div class=" ">
              <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name <span class="text-red-500">*</span></label>
              <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->
              <p class="mb-3 mt-2"></p> <!-- for error-->
            </div>
            <div class=" ">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email <span class="text-red-500">*</span></label>
                <input type="text" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->
                <p class="mb-3 mt-2"></p> <!-- for error-->
            </div>
            <div>
              <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password <span class="text-red-500">*</span></label>
              <input type="password" name="password" id="password" class="password_input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->
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
              
          
          <button class="btn-solid-lg" ><i class="fas fa-paper-plane"></i> Register</button>

          <div class="grid grid-cols-1 sm:grid-cols-2 ">
            <div class="text-sm">
              Already have an account? <a href="{{ route('account.login') }}" class="text-indigo-500 hover:text-indigo-300">Login</a>
            </div>
            <div class="text-sm text-left mt-4 sm:mt-0 sm:text-right">
              <a href="{{ route('account.forgotPassword') }}" class="text-indigo-500 hover:text-indigo-300">Forgot password?</a>
            </div>
            
          </div>

      </div>
      <div class="xl:text-right">
          <img class="inline" src="{{ asset('upload/login.gif') }}" alt="alternative" />
      </div>

      {{-- <button id="show-alert">Show SweetAlert2 Alert</button>
         --}}
    </div> <!-- end of container -->
  </form>
</div>


@endsection

@section('script')
<script>

  // $(document).ready(function() {
  
  //     $('#show-alert').click(function() {
  
  //         Swal.fire('Hello!', 'This is a SweetAlert2 alert!', 'success');
  
  //     });
  
  // });
  
  </script>

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
    $("#registrationForm").submit(function(event){
      event.preventDefault();

      //disable the submit button
      $("button[type='submit']").prop('disabled',true);

      $.ajax({
        url: '{{ route("account.processRegister") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
          //disable the submit button
          $("button[type='submit']").prop('disabled',false);

          //errors
          var errors = response.errors;
          
          if(response.status == false){

            if(errors.name){
              $("#name").addClass('border border-2 border-red-500');
              $("#name").siblings("p").addClass('text-red-500 text-xs ').html(errors.name);
              
            }else{
              $("#name").removeClass('border border-2 border-red-500');
              $("#name").siblings("p").removeClass('text-red-500 text-xs ').html('');
              
            }

            if(errors.email){
              $("#email").addClass('border border-2 border-red-500');
              $("#email").siblings("p").addClass('text-red-500 text-xs ').html(errors.email);
              
            }else{
              $("#email").removeClass('border border-2 border-red-500');
              $("#email").siblings("p").removeClass('text-red-500 text-xs ').html('');
              
            }

            if(errors.password){
              $("#password").addClass('border border-2 border-red-500');
              $("#password").siblings("p").addClass('text-red-500 text-xs ').html(errors.password);
              
            }else{
              $("#password").removeClass('border border-2 border-red-500');
              $("#password").siblings("p").removeClass('text-red-500 text-xs ').html('');
             
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
              $("#name").removeClass('border border-2 border-red-500');
              $("#name").siblings("p").removeClass('text-red-500 text-xs ').html('');
             
              $("#email").removeClass('border border-2 border-red-500');
              $("#email").siblings("p").removeClass('text-red-500 text-xs ').html('');
             
              $("#password").removeClass('border border-2 border-red-500');
              $("#password").siblings("p").removeClass('text-red-500 text-xs ').html('');
              
              $("#confirm_password").removeClass('border border-2 border-red-500');
              $("#confirm_password").siblings("p").removeClass('text-red-500 text-xs ').html('');
              
              // Swal.fire('Registration Successfull!', '', 'success');
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