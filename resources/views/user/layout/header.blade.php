<!-- Navigation -->
<nav class="navbar fixed-top">
  <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">
      
      <!-- Text Logo - Use this if you don't have a graphic logo -->
      <!-- <a class="text-gray-800 font-semibold text-3xl leading-4 no-underline page-scroll" href="index.html">Pavo</a> -->

      <!-- Image Logo -->
      <a class="inline-block mr-4 py-0.5 text-xl whitespace-nowrap hover:no-underline focus:no-underline" href="{{ route('home') }}">
          <img src="{{ asset('template/pavo/images/logo2.svg') }}" alt="alternative" class="h-8" />
          
      </a>

      <button class=" background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400" type="button" data-toggle="offcanvas">
          <span class="navbar-toggler-icon inline-block w-8 h-8 align-middle"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center" id="navbarsExampleDefault">
          <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row">
               
                <li>
                    <a class="nav-link page-scroll " href="{{ !empty(Request::segment(1)) ? route('home') : '' }}#header">Home </a>
                </li>
                <li>
                    <a class="nav-link page-scroll " href="{{ !empty(Request::segment(1)) ? route('home') : '' }}#mass">Mass</a>
                </li>
                <li>
                    <a class="nav-link page-scroll " href="{{ !empty(Request::segment(1)) ? route('home') : '' }}#donation">Donation</a>
                </li>
               
                @guest 
                    <li>
                        <a class="nav-link  {{ Request::segment(2) == "login" ? 'active' : '' }}" href="{{ route('account.login') }}">Login</a>
                    </li>

                    <li>
                        <a class="nav-link  {{ Request::segment(2) == "register" ? 'active' : '' }}" href="{{ route('account.register') }}">Register</a>
                    </li>
                @endguest

                @auth
                    @if(Auth::user()->role =="admin")
                        <li>
                            <a class="nav-link {{ Request::segment(2) == "mass" ? 'active' : '' }}" href="{{ route('admin.mass.list') }}" >Appointments</a>
                        </li>

                        <li>
                            <a class="nav-link {{ Request::segment(2) == "user" ? 'active' : '' }}" href="{{ route('admin.user.list') }}" >Users</a>
                        </li>
                    @endif
                    <li class="dropdown w-full">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account
                        </a>
                        <div class="dropdown-menu " aria-labelledby="dropdown01">
                            <div class="dropdown-item text-wrap">
                                <p class="text-sm">{{ Auth::user()->name }}</p>
                                {{-- <p class="text-sm">{{ Auth::user()->email }}</p> --}}
                            </div>
                            
                            <div class="dropdown-divider"></div>
                            <button data-modal-target="profile-modal" data-modal-toggle="profile-modal" class="dropdown-item page-scroll" href="article.html">Update Account</button>
                            
                            @if(Auth::user()->role == "user")
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item page-scroll" href="{{ route('user.mass.list') }}">My Appointments</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item page-scroll" onclick="Logout()" href="{{ route('account.logout') }}">Logout</a>
                        </div>
                    </li>
                @endauth
          </ul>
          {{-- <span class="block lg:ml-3.5">
              <a class="no-underline" href="#your-link">
                  <i class="fab fa-apple text-indigo-600 hover:text-pink-500 text-xl transition-all duration-200 mr-1.5"></i>
              </a>
              <a class="no-underline" href="#your-link">
                  <i class="fab fa-android text-indigo-600 hover:text-pink-500 text-xl transition-all duration-200"></i>
              </a>
          </span> --}}
      </div> <!-- end of navbar-collapse -->
  </div> <!-- end of container -->
</nav> <!-- end of navbar -->
<!-- end of navigation -->
