<x-app>

<div class="flex">
    <ul>
    <div class="flex items-center mb-5">
    People what following you:
    </div>
    @forelse($notifications as $notification )
        
        <li class="flex items-center mb-5">
        
           @foreach ($users as $user)
           @if($notification->data['user_id']==$user->id)
            <a href="{{ $user->path() }}" >
                <img src="{{ $user->avatar }}"
                      alt="{{ $user->username }}'s avatar"
                      width="60"
                      class="mr-4 rounded"
                >

                <div>
                    <h4 class="font-bold">{{ '@' . $user->username }}</h4>
                </div>
            </a>
           
           
            <a href="{{route('read_notify',$notification->id)}}" class="" data-id="{{ $user->id }}">
                Mark as read
            </a>
            @endif
            @endforeach
    
        </li>
        @if($loop->last)
            <a href="{{route('read_notify',0)}}" id="mark-all">
             Mark all as read
            </a>
        @endif
    @empty
        <li>You have no unread notifications at this time. </li>
    @endforelse
    </ul>
</div>

</x-app>