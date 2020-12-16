<div>

@forelse($notifications as $notification )

        <div class="flex items-center mb-5" wire:init="setUser({{ $notification->data['user_id'] }})" wire:key=" {{$notification->data['user_id']}}">
            <a href="{{ $path[$notification->data['user_id']] }}" >
                <img src="{{ $avatar[$notification->data['user_id']] }}"
                      alt="{{ $username[$notification->data['user_id']] }}'s avatar"
                      width="60"
                      class="mr-4 rounded"
                >

                <div>
                 <h2>{{ $username[$notification->data['user_id']] }} </h2>
                </div>
            </a>
           
           
            <button  wire:click="read('{{ $notification->id }}')" >
                Mark as read
            </button>
            
    
        </div>
        @if($loop->last)
            <button wire:click="read('0')" >
             Mark all as read
            </button>
        @endif
    @empty
        <div>You have no unread notifications at this time. </div>
    @endforelse
</div>
