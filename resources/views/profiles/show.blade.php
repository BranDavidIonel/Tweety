<x-app>
    <header class="mb-6 relative">
        <img
            src="{{ URL::to( $user->banner_img) }}"
            alt=""
          
            class="mb-5"
            
        >

        <div class="flex justify-between items-center mb-4">
            <div style="max-width:200px">
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                @can('edit',$user)
                    <a
                        href="{{ URL::to($user->path('edit')) }}"
                        class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2 "
                    >Edit Profile</a>
                @endcan
                <x-follow-button :user="$user"> </x-follow-button>
            </div>
        </div>

        <p class="text-sm">
            {{$user->description}}
        </p>

        <img
            src=" {{ URL::to( $user->avatar) }}"
            alt="avatar"
            class="rounded-full mr-2 absolute"
            style="width: 100px; height=100px; left: calc(50% - 50px); top: 50%"
        />

    </header>

    @include ('_timeline', [
        'tweets' => $tweets
    ])
</x-app>