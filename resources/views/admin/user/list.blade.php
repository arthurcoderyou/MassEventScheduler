@extends('user.layout.app')

@section('style')
  
@endsection

@section('content')


<div class=" py-4 md:py-28 text-center md:pt-0 lg:text-left xl:pt-16 xl:pb-32">

  <!-- Mass -->
    <div id="mass" class="cards-1">
      <div class="container mb-8 px-4 sm:px-8 xl:px-4">
        <p class="mb-4 text-gray-800 text-3xl leading-10 lg:max-w-5xl lg:mx-auto cursor-pointer"  onclick="window.location.href = '{{ route('admin.user.list') }}'">User</p>

        <div class="mb-4 container ">
            <form class="max-w-lg mx-auto" method="get">
                <div class="flex">
                    {{-- <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label> --}}
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

                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "email-asc" ? 'selected' : '' }} value="name-asc">Sort by Email - Ascending</option>
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "email-desc" ? 'selected' : '' }} value="name-desc">Sort by Email - Descending</option>
                                
                                
                                
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "created-asc" ? 'selected' : '' }} value="created-asc">Sort by Creation Date - Oldest</option>
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "created-desc" ? 'selected' : '' }} value="created-desc">Sort by Creation Date - Latest</option>

                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "updated-asc" ? 'selected' : '' }} value="date-asc">Sort by Updated Date - Oldest</option>
                                <option {{ !empty(Request::get('sort_by')) && Request::get('sort_by') == "updated-desc" ? 'selected' : '' }} value="date-desc">Sort by Updated Date - Latest</option>

                            </select>
                        </div>

                        <!-- end of Sorting -->



                        
                    </div>


                    <div class="relative w-full">
                        <!-- Search input -->
                            <input type="search" name="search" value="{{ !empty(Request::get('search')) ? Request::get('search') : old('search') }}" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search name or email..." />
                        <!-- end of Search input -->

                        <!-- Submit btn-->
                            <button type="submit" class=" absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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

               
            </div>
            
        </div>
        

      </div>

 
      <div class="container mb-4 px-4 sm:px-8 lg:px-16 xl:px-32">
        
        

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="px-6 py-3">
                          Name
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Email
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Created at
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Updated at
                      </th>
                      {{-- <th scope="col" class="px-6 py-3">
                          Action
                      </th> --}}
                  </tr>
              </thead>
              <tbody>
                @foreach($getRecord as $record)

                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $record->name }}
                      </th>
                      <td class="px-6 py-4">
                        {{ $record->email }}
                      </td>
                      <td class="px-6 py-4">
                        {{ date('M d, Y' ,strtotime($record->created_at)) }}
                      </td>
                      <td class="px-6 py-4">
                        {{ date('M d, Y' ,strtotime($record->updated_at)) }}
                      </td>
                      {{-- <td class="px-6 py-4">
                          <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                      </td> --}}


                  </tr>
                @endforeach 

                
                @if(count($getRecord) == 0)
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white col-span-5">
                        No Results found
                    </th>
                    
                  </tr>
                @endif
                  
              </tbody>
          </table>
        </div>



      </div> <!-- end of container -->

      <div class="container px-4 sm:px-8 lg:px-16 xl:px-32">
        {{ $getRecord->links() }}
      </div>
    </div> 
  <!-- end of Mass -->

</div>



@endsection