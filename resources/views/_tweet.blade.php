<div class="flex p-4 border-b border-b-gray-400">
    <div class="mr-2 flex-shrink-0">
        <a href="{{route('profile',$tweet->user->name)}}">
        <img
            src="{{ $tweet->user->avatar }}"
            alt=""
            class="rounded-full mr-2"
            width="50px"
        >
        </a>
    </div>

    <div>
        <a href="{{$tweet->user->path()}}">
            <h5 class="font-bold mb-2">{{ $tweet->user->name }}</h5>
        </a>

        <p class="text-sm">
            {{ $tweet->body }}
        </p>
        
        @if(!empty($tweet->name_file))
        @foreach(explode(',',$tweet->name_file) as $file)
        @if($tweet->checkFile($file))
        <img src="{{URL::to($tweet->path_file($file))}}" 
        width="100px"
        class="flex p-5 border-b border-b-red-400 rounded-md"
        />
        @endif
        <a href="{{URL::to($tweet->path_file($file))}}" class="text-sm hover:text-white hover:bg-blue-600" download>
        {{$file}}
        </a>
        @endforeach
        @endif
         @auth
            <x-like-buttons :tweet="$tweet" />
        @endauth
        @if($tweet->user_id==auth()->user()->id)
        <form method="POST"
          action="/tweets/{{ $tweet->id }}/tweet"
        >
        @csrf
        @method('DELETE')
        <button type="submit"
                    class="text-xs border border-red-500 text-red-500 rounded-md hover:text-white hover:bg-red-600"
                    
            >
            Delete
        </button>
        </form>
        @endif
    </div>
</div>