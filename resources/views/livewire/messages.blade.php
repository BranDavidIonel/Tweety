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
<div class="border border-gray-300 rounded-lg ml-4">
<form wire:submit.prevent="submit" enctype="multipart/form-data" >

<textarea class="border rounded-md" name="" id="" cols="30" rows="5" wire:model="message_send">  </textarea>
<div>
<button
                type="submit"
                class="bg-blue-500 rounded-lg shadow py-0.5 px-1 text-white text-sm h-10 hover:bg-blue-600" 
            >
                Publish
</button>
</div>
</form>
@forelse($messages as $message)
<div class="flex p-4 border-b border-b-gray-400">
<p class="text-sm"> {{$message->message}}</p>
</div>
@empty
<div>No messages! </div>
@endforelse

</div>
</div>
