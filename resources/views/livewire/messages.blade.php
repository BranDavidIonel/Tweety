<div class="flex flex-row">
<div> 
@foreach ($users as $user)
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
            <button  wire:click="setMessagesUserId('{{ $user->id }}')" >
                View messages
            </button>
        @endforeach

{{ $users->links() }}
</div>
<div class="border border-gray-300 rounded-lg">
@forelse($messages as $message)
<div class="flex p-4 border-b border-b-gray-400">
<textarea class="border rounded-md" name="" id="" cols="30" rows="10"> {{$message->message}} </textarea>
</div>
@empty
<div>No messages! </div>
@endforelse

</div>
</div>
