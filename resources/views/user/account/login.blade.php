@extends('user.layout.app')

@section('content')

<div class="py-28 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32">
 
  <form action="" id="loginForm">
    @csrf
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
        
      <div class="mb-16 xl:mr-12 w-72 sm:w-full mx-14 text-left">
          <h1 class=" text-md h1-large mb-5">Login</h1>
          <p class=" p-large mb-5">Welcome back! Login now</p>

              <div class="mb-4">
                  <div class=" ">
                      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                      <input type="text" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->
                      <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
                  </div>
                  <div>
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->
                    <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
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
              
          
          <button class="btn-solid-lg" ><i class="fas fa-paper-plane"></i> Login</button>

          <div class="grid grid-cols-2 ">
            <div class="text-sm">
              Did'nt have an account? <a href="{{ route('account.register') }}" class="text-indigo-500 hover:text-indigo-300">Register</a>
            </div>
            <div class="text-sm text-right">
              <a href="{{ route('account.forgotPassword') }}" class="text-indigo-500 hover:text-indigo-300">Forgot password?</a>
            </div>
            
          </div>

      </div>
      <div class="xl:text-right">
          <img class="inline" src="{{ asset('upload/login.gif') }}" alt="alternative" />
      </div>
  
    </div> <!-- end of container -->
  </form>
</div>



@endsection 

@section('script')
  @if(!empty(session('success')))
    <script>
      Swal.fire('{{ session("success") }}', '', 'success');         
    </script>
  @endif

  @if(!empty(session('error')))
    <script>
      Swal.fire('{{ session("error") }}', '', 'error');         
    </script>
  @endif

  <script type="text/javascript">






    //show password
    $("#show_password").on("click",function(){

      if($(this).is(":checked")){

        $("#password").each(function(){
          $(this).prop("type","text");
        });

      }else{

        $("#password").each(function(){
          $(this).prop("type","password");
        });

      }

    });

    //ajax code for the form
    $("#loginForm").submit(function(event){
      event.preventDefault();

      //disable the submit button
      $("button[type='submit']").prop('disabled',true);

      $.ajax({
        url: '{{ route("account.authenticate") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
          //disable the submit button
          $("button[type='submit']").prop('disabled',false);

          //errors
          var errors = response.errors;
          
          if(response.status == false){

            

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

           

          }else{
            //remove errors class and messages
            $("#email").removeClass('border border-2 border-red-500');
            $("#email").siblings("p").removeClass('text-red-500 text-xs ').html('');
            $("#password").removeClass('border border-2 border-red-500');
            $("#password").siblings("p").removeClass('text-red-500 text-xs ').html('');

            // Swal.fire('Login Successfull!', '', 'success');
            //redirect to login
            window.location.href = response.url;

          }


        },
        error: function(jQXHR, exception){
          console.log("Something went wrong");
        }

      });


    });
  </script>
@endsection