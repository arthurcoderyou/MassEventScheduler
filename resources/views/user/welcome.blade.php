  
@extends('user.layout.app')

@section('style')
  <style>
    .red-border {
        border: 1px solid red!important; /* Red border with !important for specificity */
        }
  </style>
@endsection

@section('content')
    

    <!-- Home -->

        @if(Auth::check() && Auth::user()->role == "admin")

            <header id="header" class="header py-20 text-center md:pt-28 lg:text-left xl:pb-32">
                
                    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
                        
                            <div class="w-auto mx-14 sm:w-full sm:mx-0 text-left mb-16 xl:mr-12 ">
                                <h1 class="text-md h1-large mb-5">Dashboard</h1>
                                <p class="p-large mb-5">Shortcut to your data </p>

                                    {{-- <div class="grid grid-cols-1 sm:grid-cols-2"> --}}
                                    
                                    <div class="container  grid grid-cols-1 gap-y-4 sm:gap-x-4 sm:grid-cols-2 mb-4">
                                        <!-- Card -->
                                        <div class="card bg-white px-4 py-4 sm:px-8 sm:py-8 rounded-lg cursor-pointer" 
                                            onclick="window.location.href = '{{ route('admin.mass.list') }}?&status%5B%5D=pending'"
                                            >
                                            <div class="card-image w-20 mx-auto my-4">
                                                <img src="{{ asset('template/pavo/images/features-icon-2.svg') }}" alt="alternative" />
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title text-center">{{ !empty($pendingMassCount) ? $pendingMassCount : 0 }} Pending Appointments</h5>
                                                {{-- <p class="mb-4">You sales force can use the app on any smartphone platform without compatibility issues</p> --}}
                                            </div>
                                        </div>
                                        <!-- end of card -->

                                        <!-- Card -->
                                        <div class="card bg-white px-4 py-4 sm:px-8 sm:py-8 rounded-lg cursor-pointer" 
                                            onclick="window.location.href = '{{ route('admin.mass.list') }}?&from_date={{ date('Y-m-d',strtotime(now())) }}&to_date={{ date('Y-m-d',strtotime(now())) }}&status%5B%5D=confirmed'">
                                            <div class="card-image w-20 mx-auto my-4">
                                                <img src="{{ asset('template/pavo/images/features-icon-3.svg') }}" alt="alternative" />
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title text-center">{{ !empty($allMassTodayCount) ? $allMassTodayCount : 0 }} Appointments Today</h5>
                                                {{-- <p class="mb-4">You sales force can use the app on any smartphone platform without compatibility issues</p> --}}
                                            </div>
                                        </div>
                                        <!-- end of card -->

                                        <!-- Card -->
                                        <div class="card bg-white px-4 py-4 sm:px-8 sm:py-8 rounded-lg cursor-pointer"
                                            onclick="window.location.href = '{{ route('admin.user.list') }}'" >
                                            <div class="card-image w-20 mx-auto my-4">
                                                <img src="{{ asset('template/pavo/images/features-icon-5.svg') }}" alt="alternative" />
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title text-center">{{ !empty($userCount) ? $userCount : 0 }} Users</h5>
                                                {{-- <p class="mb-4">You sales force can use the app on any smartphone platform without compatibility issues</p> --}}
                                            </div>
                                        </div>
                                        <!-- end of card -->

                                        <!-- Card -->
                                        <div class="card bg-white px-4 py-4 sm:px-8 sm:py-8 rounded-lg cursor-pointer"
                                            onclick="window.location.href = '{{ route('admin.mass.list') }}'">
                                            <div class="card-image w-20 mx-auto my-4">
                                                <img src="{{ asset('template/pavo/images/features-icon-4.svg') }}" alt="alternative" />
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title text-center">{{ !empty($allMassCount) ? $allMassCount : 0 }} Total Appointments</h5>
                                                {{-- <p class="mb-4">You sales force can use the app on any smartphone platform without compatibility issues</p> --}}
                                            </div>
                                        </div>
                                        <!-- end of card -->
                                    
                                    </div>
                                 
                            </div>
                            <div class="xl:text-right">
                                <img class="inline" src="{{ asset('upload/appointment.gif') }}" alt="alternative" />
                            </div>
                        
                    </div> <!-- end of container -->
                
            </header>

        @else 

            <header id="header" class="header py-20 text-center md:pt-28 lg:text-left xl:pb-32">
                <form action="" id="massForm">
                    @csrf
                    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
                        
                            <div class="w-auto mx-14 sm:w-full sm:mx-0 text-left mb-16 xl:mr-12 ">
                                <h1 class="text-md h1-large mb-5">Book Your Mass Today</h1>
                                <p class="p-large mb-5">Secure your spot for mass! Fill out the details below.</p>

                                    <div class="mb-4">

                                        <div>
                                            <label class="block text-gray-700 text-sm text-md font-bold mb-2" for="pair">
                                                Intention for the Mass: <span class="text-red-500">*</span>
                                            </label>
                                            <select
                                                class="selectpicker " style="width: 100%; background: white;" 
                                                data-placeholder="Select an Intention or enter your other answer..."
                                                data-allow-clear="false"
                                                name="mass_intention"
                                                id="mass_intention"
                                                title="Select an Intention or enter your other answer...">
                                                <option value="">Select an Intention or enter your other answer...</option>
                                                <option value="Baptism">Baptism</option>
                                                <option value="Confirmation">Confirmation</option>
                                                <option value="Anointing of the Sick">Anointing of the Sick</option>
                                                <option value="Holy Orders">Holy Orders</option>
                                                <option value="Matrimony">Matrimony</option>
                                                <option value="Marriage">Marriage</option>
                                                <option value="Wedlock">Wedlock</option>
                                                <option value="Thanksgiving">Thanksgiving</option>
                                                <option value="Healing">Healing</option>
                                                <option value="Guidance">Guidance & Strength</option>
                                                <option value="Peace">Peace & Justice</option>
                                                <option value="Deceased">For the Deceased</option>
                                            </select>
                                            <p class="text-red-500 text-sm mb-3 mt-2"></p>
                                        </div>

                                        
                                        <div>
                                            <label for="details" class="block text-gray-700 text-sm font-bold mb-2">Add Details about your intention <span class="text-red-500">*</span></label>
                                            <textarea name="details" id="details" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " rows="3"></textarea> <!-- add border-red-500 for error-->
                                            <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
                                        </div>

                                        <div>
                                            <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location <span class="text-red-500">*</span></label>
                                            
                                            <input type="text" name="location" id="location" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "> <!-- add border-red-500 for error-->
                                            <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
                                        </div>


                                        <div class="grid grid-cols-3 gap-x-2 lg:gap-x-8">

                                        
                                            <div>

                                                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date <span class="text-red-500">*</span></label>
                                                <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->
                                                
                                            </div>

                                            <div>

                                                <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">Start time <span class="text-red-500">*</span></label>
                                                <input type="time" name="start_time" id="start_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->

                                            </div>

                                            <div>

                                                <label for="end_time" class="block text-gray-700 text-sm font-bold mb-2">End time <span class="text-red-500">*</span></label>
                                                <input type="time" name="end_time" id="end_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <p class="text-red-500 text-sm mb-3 mt-2"></p> <!-- for error-->

                                            </div>

                                        </div>
                                        
                                        
                                    </div>
                                    
                                @auth
                                    <button class="btn-solid-lg" ><i class="fas fa-paper-plane"></i> Submit</button>
                                @endauth

                                    
                                @guest
                                    <button class="btn-solid-lg go_to_login_btn" ><i class="fas fa-paper-plane"></i> Submit</button>   
                                    {{-- <button class="submit" class="btn-solid-lg go_to_login_btn" type="button" id=""><i class="fas fa-paper-plane"></i> Submit</button> --}}
                                @endguest
                            </div>
                            <div class="xl:text-right">
                                <img class="inline" src="{{ asset('upload/appointment.gif') }}" alt="alternative" />
                            </div>
                        
                    </div> <!-- end of container -->
                </form>
            </header>
        @endif
        

    <!-- end of Home -->



    <!-- Mass -->
        <div id="mass" class="cards-1">
            <div class="container px-4 sm:px-8 xl:px-4">
                <p class="mb-8 text-gray-800 text-3xl leading-10 lg:max-w-5xl lg:mx-auto">Mass Appointments for today</p>
            </div> <!-- end of container -->


            <div class="container px-4 sm:px-8 lg:px-16 xl:px-32">
        
                <ol class="relative text-left border-s border-gray-200 dark:border-gray-700 ">
                    @foreach($getMassToday as $record)
                        
        
                                          
                        <li class="mb-10 ms-4">
                            <div class="absolute w-3 h-3 bg-indigo-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-indigo-900 dark:bg-indigo-700"></div>
                            <time class="mb-1 text-sm font-normal leading-none text-indigo-400 dark:text-indigo-500">{{ date('M d, Y',strtotime($record->date)) }} | {{ date('h:i A',strtotime($record->start_time)) }} to {{ date('h:i A',strtotime($record->end_time)) }} | 
                                @switch($record->status)
                                    @case("pending")
                                        <span class="text-yellow-400 dark:text-yellow-500">
                                            <i class="fas fa-exclamation-circle "></i> <span class="capitalize">{{ $record->status }}</span>
                                        </span>
                                        
                                        @break
                                    @case("confirmed")
                                        <span class="text-green-400 dark:text-green-500">
                                            <i class="fas fa-check"></i> <span class="capitalize">{{ $record->status }}</span>
                                        </span>
                                        
                                        @break
                                    @case("cancelled")
                                        <span class="text-red-400 dark:text-red-500">
                                            <i class="fas fa-ban"></i> <span class="capitalize">{{ $record->status }}</span>
                                        </span>
                                        
                                        @break
                                    @default
                                        
                                @endswitch
                            
                            </time>
                            <p class="my-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                <i class="fas fa-crosshairs"></i> {{ $record->location }}
                            </p>
                            
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $record->mass_intention }}</h3>
                            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $record->details }}</p>
        
                            
                            @if($record->status == "pending")
                                <button data-id="{{ $record->id }}" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="view_mass inline-flex items-center px-4 py-2 text-sm font-medium text-blue-900 bg-white border border-blue-200 rounded-lg hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-100 focus:text-blue-700 dark:bg-blue-800 dark:text-blue-400 dark:border-blue-600 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-blue-700">
                                    Edit <i class="fa fa-edit w-3 h-3 ms-2 rtl:rotate-180"></i> 
                                </button>
        
                                <button type="button" data-id="{{ $record->id }}" class="delete_btn inline-flex items-center px-4 py-2 text-sm font-medium text-red-900 bg-white border border-red-200 rounded-lg hover:bg-red-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-red-100 focus:text-red-700 dark:bg-red-800 dark:text-red-400 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700 dark:focus:ring-red-700">
                                    Delete <i class="fa fa-trash w-3 h-3 ms-2 rtl:rotate-180"></i> 
                                </button>
                            @endif
                            {{-- 
                            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Cancel <i class="fa fa-ban w-3 h-3 ms-2 rtl:rotate-180"></i> 
                            </a> --}}
        
                        </li>
                        
        
                    @endforeach
                </ol>
        
                @if(count($getMassToday) == 0)
                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ asset('template/pavo/images/features-icon-6.svg') }}" alt="alternative" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">0 Records</h5>
                            <p class="mb-4">No Appointments found</p>
                        </div>
                    </div>
                    <!-- end of card -->
        
                @endforelse
        
        
              </div> <!-- end of container -->
        
              
            


        </div> 
    <!-- end of Mass -->



    <!-- Donate -->
        <div id="donation" class="cards-2">
            <div class="absolute bottom-0 h-40 w-full bg-white"></div>
            <div class="container px-4 pb-px sm:px-8">
                <h2 class="mb-2.5 text-white lg:max-w-xl lg:mx-auto">Consider a donation to support our church.</h2>
                <p class="mb-16 text-white lg:max-w-3xl lg:mx-auto">Feeling blessed? Consider sharing your blessings with a donation to our church, and help us continue serving our community.</p>

                <!-- Card-->
                <div class="card py-1 px-3">
                    <div class="card-body">
                        <div class="card-title">Thank you</div>
                        
                        <p style="text-align: center" class="text-right ">Your support enables us to continue our mission within our community.</p>

                        <div class="button-wrapper">
                            @auth
                                <form action="{{ route('account.donate') }}" method="post">
                                    @csrf 

                                    <input required type="number" name="amount" id="amount" class="shadow appearance-none border rounded w-72 mx-auto  text-gray-700  focus:outline-none focus:shadow-outline " placeholder="&#8369;">
                                    


                                    <button type="submit" class="mt-4 btn-solid-reg page-scroll" href="#download">Donate with Paypal</button>
                                </form>
                                
                            @endauth

                            @guest
                                <button class="btn-solid-reg page-scroll go_to_login_btn" type="button" id=""><i class="fas fa-paper-plane"></i> Donate with Paypal</button>
                            @endguest
                            
                        </div>
                    </div>
                </div> <!-- end of card -->
                <!-- end of card -->

                

            </div> 
        </div> 
    <!-- end of Donate -->


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



        $(document).ready(function() {
            $('.selectpicker').select2();
            $('.select2-container .select2-selection--single').addClass('custom-select2');

            


        });

        $('.go_to_login_btn').on('click', function(){

            var url = "{{ route('account.login') }}";
            

            Swal.fire({
                title: "Login to your account first",
                text: "You must login to your account or create a new one to make a mass intention",
                type: "info"
            }).then(function() {
                // Redirect the user
                window.location.href = url;
                // console.log('The Ok Button was clicked.');
            });
            
           console.log(url);
            
        });


        // $(".select2-container .select2-selection--single").addClass("border-red-500");

        //ajax code for the form
        $("#massForm").submit(function(event){
            event.preventDefault();

            //disable the submit button
            $("button[type='submit']").prop('disabled',true);

            $("#loader").removeClass('invisible');


            $.ajax({
                url: '{{ route("user.mass.insert") }}',
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

                    if(errors.mass_intention){
                        // $("#mass_intention").addClass('border border-2 border-red-500');
                        $(".select2-container.select2-selection--single").addClass("border-red-500");
                        // $(".select2-selection--single").addClass
                        $("#mass_intention").siblings("p").addClass('text-red-700 text-xs ').html(errors.mass_intention);
                    }else{
                        $(".select2-container .select2-selection--single ").removeClass("border-red-500");
                        $("#mass_intention").siblings("p").removeClass('text-red-700 text-xs ').html('');
                    }


                    if(errors.details){
                        $("#details").addClass('border border-2 border-red-500');
                        $("#details").siblings("p").addClass('text-red-700 text-xs ').html(errors.details);
                    }else{
                        $("#details").removeClass('border border-2 border-red-500');
                        $("#details").siblings("p").removeClass('text-red-700 text-xs ').html('');
                    }


                    if(errors.location){
                        $("#location").addClass('border border-2 border-red-500');
                        $("#location").siblings("p").addClass('text-red-700 text-xs ').html(errors.location);
                    }else{
                        $("#location").removeClass('border border-2 border-red-500');
                        $("#location").siblings("p").removeClass('text-red-700 text-xs ').html('');
                    }

                    
                    if(errors.date){
                        $("#date").addClass('border border-2 border-red-500');
                        $("#date").siblings("p").addClass('text-red-700 text-xs ').html(errors.date);
                    }else{
                        $("#date").removeClass('border border-2 border-red-500');
                        $("#date").siblings("p").removeClass('text-red-700 text-xs ').html('');
                    }

                
                    if(errors.start_time){
                        $("#start_time").addClass('border border-2 border-red-500');
                        $("#start_time").siblings("p").addClass('text-red-700 text-xs ').html(errors.start_time);
                    }else{
                        $("#start_time").removeClass('border border-2 border-red-500');
                        $("#start_time").siblings("p").removeClass('text-red-700 text-xs ').html('');
                    }

                    if(errors.end_time){
                        $("#end_time").addClass('border border-2 border-red-500');
                        $("#end_time").siblings("p").addClass('text-red-700 text-xs ').html(errors.end_time);
                    }else{
                        $("#end_time").removeClass('border border-2 border-red-500');
                        $("#end_time").siblings("p").removeClass('text-red-700 text-xs ').html('');
                    }

                    $("#loader").addClass('invisible');


                }else{
                    //remove errors class and messages
                    $(".select2-container .select2-selection--single ").removeClass("border-red-500");
                        $("#mass_intention").siblings("p").removeClass('text-red-700 text-xs ').html('');
                        $("#details").removeClass('border border-2 border-red-500');
                        $("#details").siblings("p").removeClass('text-red-700 text-xs ').html('');
                        $("#location").removeClass('border border-2 border-red-500');
                        $("#location").siblings("p").removeClass('text-red-700 text-xs ').html('');
                        $("#date").removeClass('border border-2 border-red-500');
                        $("#date").siblings("p").removeClass('text-red-700 text-xs ').html('');
                        $("#start_time").removeClass('border border-2 border-red-500');
                        $("#start_time").siblings("p").removeClass('text-red-700 text-xs ').html('');
                        $("#end_time").removeClass('border border-2 border-red-500');
                        $("#end_time").siblings("p").removeClass('text-red-700 text-xs ').html('');

                    // Swal.fire('Login Successfull!', '', 'success');
                    //redirect to login
                    window.location.href = "{{ route('user.mass.list') }}";

                }


                },
                error: function(jQXHR, exception){
                console.log("Something went wrong");
                }

            });


        });






    </script>



@endsection
