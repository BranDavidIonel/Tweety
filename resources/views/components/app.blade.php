<x-master>
    <section class="px-8">
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-center">
                <div class="lg:w-32">
                    @include ('_sidebar-links')
                </div>

                <div class="lg:flex-1 lg:mx-10 lg:mb-10" style="max-width: 700px">
                    {{ $slot }}
                </div>

                <div class="lg:w-1/6">
                    @include ('_friends-list')
                </div>
            </div>
            @if (Session::has('success'))
            <div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
                <input type="checkbox" class="hidden" id="footertoast">

                <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-500 h-24 rounded shadow-lg text-white" title="close" for="footertoast">
                {{Session::get('success') }}
              
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                </label>
            </div>
            @endif
        </main>
    </section>
</x-master>