@component('mail::message')

<strong>{{ $user->send_title }}</strong>

{{-- {{ $user->remember_token }} --}}


<li class="mb-10 ms-4">
  <div class="absolute w-3 h-3 bg-indigo-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-indigo-900 dark:bg-indigo-700"></div>
  <time class="mb-1 text-sm font-normal leading-none text-indigo-400 dark:text-indigo-500">{{ date('M d, Y',strtotime($mass->date)) }} | {{ date('h:i A',strtotime($mass->start_time)) }} to {{ date('h:i A',strtotime($mass->end_time)) }} 
      {{-- @switch($mass->status)
          @case("pending")
              <span class="text-yellow-400 dark:text-yellow-500" style="color: rgb(227 160 8)">
                  <i class="fas fa-exclamation-circle "></i> <span class="capitalize">{{ $mass->status }}</span>
              </span>
              
              @break
          @case("confirmed")
              <span class="text-green-400 dark:text-green-500" style="color: rgb(49 196 141)">
                  <i class="fas fa-check"></i> <span class="capitalize">{{ $mass->status }}</span>
              </span>
              
              @break
          @case("cancelled")
              <span class="text-red-400 dark:text-red-500">
                  <i class="fas fa-ban"></i> <span class="capitalize">{{ $mass->status }}</span>
              </span>
              
              @break
          @default
              
      @endswitch --}}
  
  </time>
  <p class="my-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
      <i class="fas fa-crosshairs"></i> {{ $mass->location }}
  </p>

    Status: {{ $mass->status }}
    Created by: {{ $user->name }}
    Creator email: {{ $user->email }}
  
  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $mass->mass_intention }}</h3>
  <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $mass->details }}</p>

  
  

</li>

From,<br>
{{ config('app.name') }}

@endcomponent