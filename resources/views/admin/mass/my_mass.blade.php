@extends('user.layout.app')

@section('content')



<div class=" py-4 md:py-28 text-center md:pt-0 lg:text-left xl:pt-16 xl:pb-32">

  <!-- Mass -->
    <div id="mass" class="cards-1">
      <div class="container mb-8 px-4 sm:px-8 xl:px-4">
        <p class="mb-4 text-gray-800 text-3xl leading-10 lg:max-w-5xl lg:mx-auto cursor-pointer"  onclick="window.location.href = '{{ route('admin.mass.list') }}'">Mass Appointments</p>

        <div class="mb-4 container ">
            <form class="max-w-lg mx-auto" method="get">
                <div class="flex">
                    <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
                    <button type="button" id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" >
                        All Filters
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-auto dark:bg-gray-700">

                        <!-- Sorting -->
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                           
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sort Records</label>
                            <select name="sort_by" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a sorting option</option>
                                
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "name-asc" ? 'selected' : '' }} value="name-asc">Sort by Name - Ascending</option>
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "name-desc" ? 'selected' : '' }} value="name-desc">Sort by Name - Descending</option>
                                
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "date-asc" ? 'selected' : '' }} value="date-asc">Sort by Mass Date - Oldest</option>
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "date-desc" ? 'selected' : '' }} value="date-desc">Sort by Mass Date - Latest</option>
                                
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "created-asc" ? 'selected' : '' }} value="created-asc">Sort by Creation Date - Oldest</option>
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "created-desc" ? 'selected' : '' }} value="created-desc">Sort by Creation Date - Latest</option>
                            </select>
                        </div>

                        <!-- end of Sorting -->

                        <!-- Status-->
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div>Status</div>
                            </div>
                            <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">

                                <!-- status:pending -->
                                    <li>
                                        <div class="flex items-center">
                                            <input {{ !empty(Request::get('status')) && (in_array('pending',Request::get('status') ) ) ? 'checked' : '' }} id="pending" type="checkbox" name="status[]" value="pending" class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="pending" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pending</label>
                                        </div>
                                    </li>
                                <!-- end of  status:pending -->
                                <!-- status:confirmed -->
                                    <li>
                                        <div class="flex items-center">
                                            <input {{ !empty(Request::get('status')) && (in_array('confirmed',Request::get('status'))) ? 'checked' : '' }} id="confirmed" type="checkbox" name="status[]" value="confirmed" class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="confirmed" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirmed</label>
                                        </div>
                                    </li>
                                <!-- end of  status:confirmed -->
                                <!-- status:cancelled -->
                                    <li>
                                        <div class="flex items-center">
                                            <input {{ !empty(Request::get('status')) && (in_array('cancelled',Request::get('status'))) ? 'checked' : '' }} id="cancelled" type="checkbox" name="status[]" value="cancelled" class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="cancelled" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cancelled</label>
                                        </div>
                                    </li>
                                <!-- end of  status:cancelled -->
                                
                            </ul>
                        <!-- end of Status -->

                        <!-- date -->
                            
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <label for="date" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Date:</label>

                                <div class="p-3 space-x-3 grid grid-cols-2 ">
                                    <div class="max-w-[8rem] mx-auto">
                                        <label for="from_date" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">From:</label>
                                        <input name="from_date" type="date" id="from_date" value="{{ !empty(Request::get('from_date')) ? Request::get('from_date') : old('from_date') }}"  class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                                    </div>

                                    <div class="max-w-[8rem] mx-auto">
                                        <label for="to_date" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">To:</label>
                                        <input name="to_date" type="date" id="to_date" value="{{ !empty(Request::get('to_date')) ? Request::get('to_date') : old('to_date') }}"  class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                                    </div>
                                

                                </div>
                            </div>
                        <!-- end of date-->

                        <!-- start time -->
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div>Start Time</div>
                            
                                <div class="p-3 space-x-3 grid grid-cols-2 ">
                                    <div class="max-w-[8rem] mx-auto">
                                        <label for="from_start_time" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">From:</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <input type="time" id="from_start_time" name="from_start_time" value="{{ !empty(Request::get('from_start_time')) ? Request::get('from_start_time') : old('from_start_time') }}" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                                        </div>
                                    </div>


                                    <div class="max-w-[8rem] mx-auto">
                                        <label for="to_start_time" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">To:</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <input type="time" id="to_start_time" name="to_start_time" value="{{ !empty(Request::get('to_start_time')) ? Request::get('to_start_time') : old('to_start_time') }}" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <!-- end of start time-->
    
                        <!-- end time -->
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white border-solid border-t-indigo-500">
                                <div>End Time:</div>
                            
                                <div class="p-3 space-x-3 grid grid-cols-2 ">
                                    <div class="max-w-[8rem] mx-auto">
                                        <label for="from_end_time" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">From:</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <input type="time" id="from_end_time" name="from_end_time" value="{{ !empty(Request::get('from_end_time')) ? Request::get('from_end_time') : old('from_end_time') }}" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                                        </div>
                                    </div>


                                    <div class="max-w-[8rem] mx-auto">
                                        <label for="to_end_time" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">To:</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <input type="time" id="to_end_time" name="to_end_time" value="{{ !empty(Request::get('to_end_time')) ? Request::get('to_end_time') : old('to_end_time') }}" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <!-- end of end time-->
                        
                    </div>


                    <div class="relative w-full">
                        <!-- Search input -->
                            <input type="search" name="search" value="{{ !empty(Request::get('search')) ? Request::get('search') : old('search') }}" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Mass Intention or location..." />
                        <!-- end of Search input -->

                        <!-- Submit btn-->
                            <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                
                            </button>
                        <!-- end of Submit btn-->

                        

                    </div>


                    

                    
                </div>

                

                


            </form>
        </div>


      </div> <!-- end of container -->


      
      <div class="container mb-4 text-left px-4 sm:px-8 lg:px-16 xl:px-32 ">
        <div class="grid grid-cols-2 justify-between">
            <div>
                @if(!empty($getRecord))
                    {{ $getRecord->total() }} results found
                @else 
                    0 results found
                @endif

               
            </div>
            
            <div class="justify-self-end">

                
                <div id="donwloadTooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-indigo-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Download copy of mass intention records in pdf format
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>


                <form action="{{ route('admin.mass.print_mass_records') }}" method="post" class="" >
                    @csrf
                    <!-- http://127.0.0.1:8000/account/mass/list?sort_by=Choose+a+sorting+option&from_date=&to_date=&from_start_time=&to_start_time=&from_end_time=&to_end_time=&search=-->
                    <!-- for the export variables-->
                    <input type="hidden" value="{{ Request::get('sort_by') }}" name="sort_by">

                    <input type="hidden" value="{{ Request::get('from_date') }}" name="from_date">
                    <input type="hidden" value="{{ Request::get('to_date') }}" name="to_date">
  
                    <input type="hidden" value="{{ Request::get('from_start_time') }}" name="from_start_time">
                    <input type="hidden" value="{{ Request::get('to_start_time') }}" name="to_start_time">

                    <input type="hidden" value="{{ Request::get('from_end_time') }}" name="from_end_time">
                    <input type="hidden" value="{{ Request::get('to_end_time') }}" name="to_end_time">
  
                    <input type="hidden" value="{{ Request::get('search') }}" name="search">

                    <input {{ !empty(Request::get('status')) && (in_array('pending',Request::get('status') ) ) ? 'checked' : '' }} id="pending" type="checkbox" name="status[]" value="pending" class="invisible" >

                    <input {{ !empty(Request::get('status')) && (in_array('confirmed',Request::get('status') ) ) ? 'checked' : '' }} id="confirmed" type="checkbox" name="status[]" value="confirmed" class="invisible" >

                    <input {{ !empty(Request::get('status')) && (in_array('cancelled',Request::get('status') ) ) ? 'checked' : '' }} id="cancelled" type="checkbox" name="status[]" value="cancelled" class="invisible" >
                    
  
                    <button type="submit" data-tooltip-target="donwloadTooltip" class=" inline-flex items-center px-4 py-2 text-sm font-medium text-blue-900 bg-white border border-blue-200 rounded-lg hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-100 focus:text-blue-700 dark:bg-blue-800 dark:text-blue-400 dark:border-blue-600 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-blue-700">
                        Download <i class="fa fa-download w-3 h-3 ms-2 rtl:rotate-180"></i> 
                    </button>
  
                  </form>
               
            </div>
            
        </div>
        

      </div>

 
      <div class="container px-4 sm:px-8 lg:px-16 xl:px-32">
        
        <ol class="relative text-left border-s border-gray-200 dark:border-gray-700">
            @foreach($getRecord as $record)
                

                                  
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

                    @php 
                        $user_info = App\Models\User::find($record->user_id);
                    @endphp

                    @if(!empty($user_info))
                        <p class="my-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                            
                            <i class="fas fa-user"></i> {{ $user_info->name }}
                        </p>

                        <p class="my-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                            
                            <i class="fas fa-envelope"></i> {{ $user_info->email }}
                        </p>
                    @endif
                    
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $record->mass_intention }}</h3>
                    <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $record->details }}</p>

                    
                    @if($record->status == "pending")
                        <button data-id="{{ $record->id }}" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class=" confirm_btn inline-flex items-center px-4 py-2 text-sm font-medium text-blue-900 bg-white border border-blue-200 rounded-lg hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-100 focus:text-blue-700 dark:bg-blue-800 dark:text-blue-400 dark:border-blue-600 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-blue-700">
                            Confirm <i class="fa fa-check w-3 h-3 ms-2 rtl:rotate-180"></i> 
                        </button>

                        <button type="button" data-id="{{ $record->id }}" class="cancel_btn inline-flex items-center px-4 py-2 text-sm font-medium text-red-900 bg-white border border-red-200 rounded-lg hover:bg-red-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-red-100 focus:text-red-700 dark:bg-red-800 dark:text-red-400 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700 dark:focus:ring-red-700">
                            Cancel <i class="fa fa-ban w-3 h-3 ms-2 rtl:rotate-180"></i> 
                        </button>
                    @endif
                    

                </li>
                

            @endforeach
        </ol>

        @if(count($getRecord) == 0)
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

        @endif


      </div> <!-- end of container -->

      <div class="container px-4 sm:px-8 lg:px-16 xl:px-32">
        {{ $getRecord->links() }}
      </div>
    </div> 
  <!-- end of Mass -->

</div>



<!-- Modal for Mass Edit -->






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

    <script>
        window.addEventListener("load", function(event) {
            document.querySelector('[data-dropdown-toggle="dropdown"]').click();
        });

        
        $(".confirm_btn").on('click', function(){

            var mass_id = $(this).attr('data-id'); //get the mass id

            

            Swal.fire({
                title: "Are you sure to confirm this?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, confirm it!"
                }).then((result) => {
                if (result.isConfirmed) {

                    $("#loader").removeClass('invisible');

                    $.ajax({
                        url: "{{ route('admin.mass.confirm') }}", 
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}", //using a csrf token for the form
                            mass_id: mass_id, //fetching the mass_id
                        },
                        dataType: "json",
                        success: function(response){
                            
                            if(response.status == true){

                            
                                Swal.fire({
                                    title: "Confirmed!",
                                    text: "The mass had been confirmed.",
                                    icon: "success"
                                });


                                window.location.href = "{{ route('admin.mass.list') }}";

                            }else{

                                Swal.fire({
                                    title: "Schedule Conflict!",
                                    text: response.message,
                                    icon: "error"
                                });

                            }

                        },

                    });


                    

                }
            });
        });

        $(".cancel_btn").on('click', function(){

            var mass_id = $(this).attr('data-id'); //get the mass id

            Swal.fire({
                title: "Are you sure to cancel this?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, cancel it!"
                }).then((result) => {
                if (result.isConfirmed) {

                    $("#loader").removeClass('invisible');
                    
                    $.ajax({
                        url: "{{ route('admin.mass.cancel') }}", 
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}", //using a csrf token for the form
                            mass_id: mass_id, //fetching the mass_id
                        },
                        dataType: "json",
                        success: function(response){
                            
                            if(response.status == true){

                            
                                Swal.fire({
                                    title: "Cancelled!",
                                    text: "The mass had been cancelled.",
                                    icon: "success"
                                });


                                window.location.href = "{{ route('admin.mass.list') }}";

                            }

                        },

                    });


                    

                }
                });
        });

    </script>
@endsection