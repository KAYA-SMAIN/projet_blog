@extends("layouts.app")
@section("content")




    <section class="text-gray-600 body-font h-full">
        <div class="flex mt-10 ml-12 font-bold"><a href="{{ route('posts.index') }}"> <- Retour au menu</a></div>
        <div class="container px-5 py-5 mx-auto">
            <div class="flex flex-wrap m-4 justify-center">
                <div class="flex w-full justify-center"><h1 class="title-font text-lg text-3xl pb-5 text-gray-900 mb-3">{{$post->title}}</h1></div>
                <div class="flex w-full pb-2 justify-center"><p class="font-bold">Par : {{ $post->user->name }}</p><p class="ml-3">le : {{ $post->created_at->format('d M Y') }}</p></div>
                <img class="lg:h-80 md:h-50 w-full object-cover object-center" src="{{asset('/storage/'. $post->picture) }}"/>
                <div class="flex items-center flex-wrap"><p class=" p-5" >{{$post->content}}</p></div>
            </div>
        </div>
    </section>

   
        <section class="flex mt-10 ml-12 font-bold">
        <div class="container px-5 py-5 mx-auto">
            <h2 class="title-font text-lg text-2xl pb-5 text-gray-900 mb-3">Chat du post :</h2>

            <div class="grid grid-cols-1 gap-4"> 
                <div class="col-span-1"> 
                    <div class="border border-black rounded-lg bg-white"> 
                        @foreach($post->chirps as $chirp)
                        <div class="chirp-message @if(auth()->check() && $chirp->user_id === auth()->user()->id) right @else left @endif">
                            <p class="@if(auth()->check() && $chirp->user_id === auth()->user()->id) text-right @else text-left @endif p-2">
                                {{ $chirp->user->name }} : {{ $chirp->message }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-span-1">
                    @if(auth()->check())
                        <form action="{{ route('chirps.store', $post->id) }}" method="post">
                            @csrf
                            <textarea name="message" rows="3" class="w-full h-40 p-2 rounded-lg" placeholder="Entrez votre message ici"></textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg">Envoyer</button>
                        </form>
                    @else
                        <p>Connectez-vous pour envoyer un message.</p>
                    @endif
                </div>
            </div>

        </div>
    </section>
     

@endsection

