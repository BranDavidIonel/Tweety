<x-app>

<div class="flex">
    <ul>
    People what following you:
    @forelse($users as $user )
        <li>
            <a href="{{ $user->path() }}" class="flex items-center mb-5">
                <img src="{{ $user->avatar }}"
                      alt="{{ $user->username }}'s avatar"
                      width="60"
                      class="mr-4 rounded"
                >

                <div>
                    <h4 class="font-bold">{{ '@' . $user->username }}</h4>
                </div>
            </a>
        <br> 
        
        </li>
    @empty
        <li>You have no unread notifications at this time. </li>
    @endforelse
    </ul>
</div>

</x-app>