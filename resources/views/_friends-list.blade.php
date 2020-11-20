<div class="bg-gray-200 rounded-lg py-4 px-6">
    <h3 class="font-bold text-xl mb-4">Following</h3>

    <ul>
        @foreach (auth()->user()->follows as $user)
        <li class="mb-4 w-20">
         
                
                <a href="{{route('profile',$user->name)}}" class="flex items-center max-w-xs">
                    <img
                        src="{{ $user->avatar }}"
                        alt=""
                        class="rounded-full mr-1"
                    >

                    {{ $user->name }}
                </a>
            
        </li>
        @endforeach
    </ul>
</div>