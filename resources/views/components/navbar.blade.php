<nav class="bg-black z-10 fixed top-0 left-0 w-full">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <img class="h-8 w-auto p-1" src="https://th.bing.com/th/id/R.0809f8d114f821d2ffd31c38e21a56f6?rik=VPpy8MkYM9fqcA&riu=http%3a%2f%2fpngimg.com%2fuploads%2fbasketball%2fbasketball_PNG1100.png&ehk=X2dsCAnoqCC8AiL%2bbjHI5cxNPBmUCxR92FgSupg%2fADU%3d&risl=&pid=ImgRaw&r=0" alt="Your Company">
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="/home/{{ $slot }}" class="{{ request()-> is ("home/".$slot) ? 'hidden' : 'rounded-md px-3 py-2 text-sm font-medium text-yellow-400 bg-orange-950 hover:bg-amber-700 hover:text-white border-2 border-orange-700 hover:border-orange-400'}}" aria-current="page">Home</a>
            <a href="/classs/{{ $slot }}" class="{{ request()-> is ("classs/".$slot) ? 'hidden' : 'rounded-md px-3 py-2 text-sm font-medium text-yellow-400 bg-orange-950 hover:bg-amber-700 hover:text-white'}}" aria-current="page">Class</a>
            <a href="/session/{{ $slot }}" class="{{ request()-> is ("session/".$slot) ? 'hidden' : 'rounded-md px-3 py-2 text-sm font-medium text-yellow-400 bg-orange-950 hover:bg-amber-700 hover:text-white'}}" aria-current="page">Session</a>
            <a href="/attendance/{{ $slot }}" class="{{ request()-> is ("attendance/".$slot) ? 'hidden' : 'rounded-md px-3 py-2 text-sm font-medium text-yellow-400 bg-orange-950 hover:bg-amber-700 hover:text-white'}}" aria-current="page">Attendance</a>
            <a href="/payment/{{ $slot }}" class="{{ request()-> is ("payment/".$slot) ? 'hidden' : 'rounded-md px-3 py-2 text-sm font-medium text-yellow-400 bg-orange-950 hover:bg-amber-700 hover:text-white'}}" aria-current="page">Payment</a>
          
            {{-- <a href="/dbshow/{{ $slot }}" class="{{ request()-> is ('/paymentb') ? 'hidden' : 'rounded-md px-3 py-2 text-sm font-medium text-yellow-400 bg-orange-950 hover:bg-amber-700 hover:text-white'}}" aria-current="page">Database Show</a> --}}
          </div>
        </div>
      </div>

      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

        <a href="/profile/{{ $slot }}" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">Open user menu</span>
          <img 
            class="size-8 rounded-full border border-orange-800"
            src="{{ auth()->check() && auth()->user()->image_profile != 0
              ? asset(auth()->user()->image_profile)
              : asset('/images/user_profile.webp') }}" 
            alt="User Profile">
        </a>
      </div>

    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="/" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Home</a>
      <a href="/about" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">About</a>
      <a href="/contact" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Contact</a>
    </div>
  </div>
</nav>

<form action="{{ route('logout') }}" method="POST" id="logoutForm" style="display: none;">
  @csrf
</form>