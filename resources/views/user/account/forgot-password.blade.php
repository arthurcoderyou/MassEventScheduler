@extends('user.layout.app')

@section('style')
  
@endsection 

@section('content')

<div class="py-28 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32">
  
  <form action="" id="forgotPasswordForm">
    @csrf
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
        
      <div class="mb-16 xl:mr-12 w-72 sm:w-full mx-14 text-left">
          <h1 class=" text-md h1-large mb-5">Forgot Password</h1>
          <p class=" p-large mb-5">Recover your account</p>

              <div class="mb-4">
                  <div class=" ">
                      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                      <input type="text" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "></input> <!-- add border-red-500 for error-->

                      @if(!empty(session('success')))
                        <p class="text-green-500 text-sm mb-3 mt-2">{!! session('success') !!}</p> <!-- for error-->
                      @else 
                        <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->

                      @endif
                     

                      
                  </div>
                  

                  
              </div>
              
          
          <button class="btn-solid-lg" ><i class="fas fa-paper-plane"></i> Recover</button>

          <div class="grid grid-cols-2 ">
            <div class="text-sm">
              Already have an account? <a href="{{ route('account.login') }}" class="text-indigo-500 hover:text-indigo-300">Login</a>
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
      Swal.fire('Check your email for the password reset link!', '', 'success');         
    </script>
  @endif


  <script type="text/javascript">

/*
 Swal.fire({
                title: 'Please Wait !',
                html: 'data uploading',// add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });

*/
    
   
    //ajax code for the form
    $("#forgotPasswordForm").submit(function(event){
      event.preventDefault();

      //disable the submit button
      // $("button[type='submit']").prop('disabled',true);

      // Swal.fire({
      //   title: 'Please Wait. We are sending your recovery email !',
      //   html: 'Email sending',// add html attribute if you want or remove
      //   allowOutsideClick: false,
      //   onBeforeOpen: () => {
      //       Swal.showLoading()
      //   },
      // });

      $("#loader").removeClass('invisible');


      $.ajax({
        url: '{{ route("account.postForgotPassword") }}',
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

            
           

          }else{
            //remove errors class and messages
            $("#email").removeClass('border border-2 border-red-500');
            $("#email").siblings("p").removeClass('text-red-500 text-xs ').html('');
            
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