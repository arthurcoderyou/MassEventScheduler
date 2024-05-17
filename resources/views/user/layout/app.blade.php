<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- SEO Meta Tags -->
        <meta name="description" content="Church Mass Appointment" />
        <meta name="author" content="Arthur Cervania" />

        <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
        <meta property="og:site_name" content="" /> <!-- website name -->
        <meta property="og:site" content="" /> <!-- website link -->
        <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
        <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
        <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
        <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
        <meta name="twitter:card" content="summary_large_image" /> <!-- to have large image post format in Twitter -->

        {{-- csrf token for every form --}}
	    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Webpage Title -->
        <title>Church Mass Appointment</title>

        <!-- Styles -->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
        <link href="{{ asset('template/pavo/css/fontawesome-all.css') }}" rel="stylesheet" />
        {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" /> --}}
        <link href="{{ asset('template/pavo/css/swiper.css') }}" rel="stylesheet" />
        <link href="{{ asset('template/pavo/css/magnific-popup.css') }}" rel="stylesheet" />
        <link href="{{ asset('template/pavo/css/styles.css') }}" rel="stylesheet" />

        <!-- Favicon  -->
        <link rel="icon" href="{{ asset('template/pavo/images/logo2.svg') }}" />

        <!-- Sweetalert-->
        <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

        <!-- Select2-->
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" />

        
        <style>
            /* Absolute Center Spinner */
            .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            }

            /* Transparent Overlay */
            .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
                background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
            }

            /* :not(:required) hides these rules from IE9 and below */
            .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
            }

            .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
            }

            /* Animation */

            @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            }
            @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            }
            @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            }
            @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            }
        </style>

        @vite(['resources/css/app.css','resources/js/app.js'])

        @yield('style')
    </head>
    <body data-spy="scroll" data-target=".fixed-top">

        @include('user.layout.header')


        @yield('content')

        
        @include('user.layout.footer')




        <!-- Modal Profile -->

        @auth
            <!-- Main modal -->
            <div id="profile-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Update Profile
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="profile-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5" id="updateProfileForm">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">

                                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white col-span-2">
                                    <div>Change your details below and save changes</div>
                                </div>

                                <div class="col-span-2">
                                    <label for="new_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Name</label>
                                    <input type="text" name="new_name" id="new_name" value="{{ old('new_name',Auth::user()->name ) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter your new email" >
                                    <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
                                </div>
                                    
                                <div class="col-span-2">
                                    <label for="new_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Email</label>
                                    <input type="email" name="new_email" id="new_email" value="{{ old('new_email',Auth::user()->email ) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter your new email" >
                                    <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
                                </div>
                                    

                                

                                <div class="col-span-2">
                                    <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="password_input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter your new password" >
                                    <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
                                </div>

                                <div class="col-span-2">
                                    <label for="confirm_new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                                    <input type="password" name="confirm_new_password" id="confirm_new_password" class="password_input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Confirm your new password" >
                                    <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
                                </div>

                                <div>
                                    <div class="control">
                                        <label class="checkbox">
                                          <input type="checkbox" id="show_password">
                                          <span class="check"></span>
                                          <span class="control-label" >Show password</span>
                                        </label>
                                      </div>
                                </div>

                                
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                
                                <i class="fa fa-save mr-1"></i> Update 
                            </button>
                        </form>
                    </div>
                </div>
            </div> 
        @endauth

        <!-- end of Modal Profile -->

    

        <div class="loading invisible" id="loader">Loading&#8230;</div>

        <!-- Scripts -->
        <script src="{{ asset('template/pavo/js/jquery.min.js') }}"></script> <!-- jQuery for JavaScript plugins -->
        <script src="{{ asset('template/pavo/js/jquery.easing.min.js') }}"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
        <script src="{{ asset('template/pavo/js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders -->
        <script src="{{ asset('template/pavo/js/jquery.magnific-popup.js') }}"></script> <!-- Magnific Popup for lightboxes -->
        <script src="{{ asset('template/pavo/js/scripts.js') }}"></script> <!-- Custom scripts -->

        
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script> <!-- Sweetalert-->
        <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script> <!-- Sweetalert-->

        
        <script>
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


            @auth
                //ajax code for the form
                $("#updateProfileForm").submit(function(event){
                    event.preventDefault();

                    //disable the submit button
                    $("button[type='submit']").prop('disabled',true);

                    $.ajax({
                        url: '{{ route("account.updateProfile") }}',
                        type: 'post',
                        data: $(this).serializeArray(),
                        dataType: 'json',
                        success: function(response){
                        //disable the submit button
                        $("button[type='submit']").prop('disabled',false);

                        //errors
                        var errors = response.errors;
                        
                        if(response.status == false){

                            Swal.fire( response.message, '', 'error');  

                            
                            if(errors.new_name){
                                $("#new_name").addClass('border border-2 border-red-500');
                                $("#new_name").siblings("p").addClass('text-red-700 text-xs ').html(errors.new_name);
                            }else{
                                $("#new_name").removeClass('border border-2 border-red-500');
                                $("#new_name").siblings("p").removeClass('text-red-700 text-xs ').html('');
                            }
                            

                            if(errors.new_email){
                                $("#new_email").addClass('border border-2 border-red-500');
                                $("#new_email").siblings("p").addClass('text-red-700 text-xs ').html(errors.new_email);
                            }else{
                                $("#new_email").removeClass('border border-2 border-red-500');
                                $("#new_email").siblings("p").removeClass('text-red-700 text-xs ').html('');
                            }

                            if(errors.new_password){
                                $("#new_password").addClass('border border-2 border-red-500');
                                $("#new_password").siblings("p").addClass('text-red-700 text-xs ').html(errors.new_password);
                            }else{
                                $("#new_password").removeClass('border border-2 border-red-500');
                                $("#new_password").siblings("p").removeClass('text-red-700 text-xs ').html('');
                            }

                            if(errors.confirm_new_password){
                                $("#confirm_new_password").addClass('border border-2 border-red-500');
                                $("#confirm_new_password").siblings("p").addClass('text-red-700 text-xs ').html(errors.confirm_new_password);
                            }else{
                                $("#confirm_new_password").removeClass('border border-2 border-red-500');
                                $("#confirm_new_password").siblings("p").removeClass('text-red-700 text-xs ').html('');
                            }

                        }else{
                            //remove errors class and messages
                            $("#new_name").removeClass('border border-2 border-red-500');
                            $("#new_name").siblings("p").removeClass('text-red-700 text-xs ').html('');
                            $("#new_email").removeClass('border border-2 border-red-500');
                            $("#new_email").siblings("p").removeClass('text-red-700 text-xs ').html('');
                            $("#new_password").removeClass('border border-2 border-red-500');
                            $("#new_password").siblings("p").removeClass('text-red-700 text-xs ').html('');
                            $("#confirm_new_password").removeClass('border border-2 border-red-500');
                            $("#confirm_new_password").siblings("p").removeClass('text-red-700 text-xs ').html('');


                            // Swal.fire('Login Successfull!', '', 'success');
                            //redirect to login
                            @if(Auth::user()->role == "user")
                            
                                window.location.href = "{{ route('user.mass.list') }}";
                            @endif

                            @if(Auth::user()->role == "admin")
                                window.location.href = "{{ route('admin.mass.list') }}";
                            @endif

                        }


                        },
                        error: function(jQXHR, exception){
                        console.log("Something went wrong");
                        }

                    });


                });

            @endauth

        </script>
        @yield('script')




    </body>
</html>
