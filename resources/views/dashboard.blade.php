<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session('success'))
        {{ session('success') }}
    @endif

      <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($posts as $post)
              <div class = "mb-5 p-3" style="background-color: rgba(217, 217, 217, 0.075); border: 2px solid rgba(0, 0, 0, 0.048);">
                  <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('/storage/'. $post->picture) }}" alt="blog cover"/>
                  <div class="p-4 items-center">
                      <h2 class="tracking-widest text-xs title-font font-bold text-gray-900 mb-1 uppercase "> {{Str::limit ($post->title, 25) }} </h2>  
                      <h1 class="title-font text-lg font-medium text-gray-400 mb-3">{{Str::limit ($post->content, 50) }}</h1>
                  </div>
                  <div class="flex items-center justify-center">
                    <a href="{{ route('posts.edit', $post) }}" class="mx-auto w-1/4 text-center text-black font-bold py-3 px-4 rounded-md " style="background-color: rgba(209, 209, 209, 0.993);">Modifier</a>
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('delete')
                        <x-dropdown-link :href="route('posts.destroy', $post)" onclick="event.preventDefault(); this.closest('form').submit(); ">
                          {{ __('Supprimer') }}
                        </x-dropdown-link>
                    </form>
                  </div>
              </div>
            @endforeach
          </div>
      </div>

</x-app-layout>

