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
<div class="border border-gray-300 rounded-lg ml-20 mr-20">
    <form wire:submit.prevent="submit" enctype="multipart/form-data" >

    <textarea rows="7" class="w-full border rounded-md" wire:model="message_send"> </textarea>
    @error('message_send') <span class="error">{{ $message }}</span> @enderror
    <div class="flex">
                <input class="border border-gray-400 p-2 w-full"
                       type="file"
                       name="files[]"
                       wire:model="files"
                       id="files"
                       multiple
                >

    </div>
    <div>
    <button
                    type="submit"
                    class="bg-blue-500 rounded-lg shadow py-0.5 px-1 text-white text-sm h-10 hover:bg-blue-600"   
                >
                    Send
    </button>
    </div>
    </form>

    @forelse($messages as $message_user)
        <div class="p-2 border-solid border-2 border-blue-400">
        <p class="text-sm ">
        <img src="{{ $message_user->user->avatar }}"
                            alt="{{ $message_user->user->username }}'s avatar"
                            width="60"
                            class="mr-4 rounded"
                        >

                <h4 class="font-bold mr-4">{{ '@'. $message_user->user->username }}</h4>
        {{ $message_user->message}}

        </p>
        
        </div>
    @if($message_user->is_user_auth())
        <div class="border-solid border-2 border-blue-500">
        <button wire:click="delete('{{ $message_user->id }}')"
                class="text-xs border border-red-500 text-red-500 rounded-md hover:text-white hover:bg-red-600"                    
        >
            Delete
        </button>
        </div>

    @endif

    @empty
    <div>No messages! </div>
    @endforelse
    
</div>

</div>

