<x-app>
    <header class="mb-6 relative">
        <img
            src="/images/default-profile-banner.jpg"
            alt=""
            class="mb-2"
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
            The name’s Bugs. Bugs Bunny. Don’t wear it out. Bugs is an anthropomorphic gray
            and white rabbit or hare who is famous for his flippant, insouciant personality.
            He is also characterized by a Brooklyn accent, his portrayal as a trickster,
            and his catch phrase "Eh...What's up, doc?"
        </p>

        <img
            src=" {{ URL::to( $user->avatar) }}"
            alt="avatar"
            class="rounded-full mr-2 absolute"
            style="width: 100px; height=100px; left: calc(50% - 75px); top: 35%"
        />

    </header>

    @include ('_timeline', [
        'tweets' => $tweets
    ])
</x-app>