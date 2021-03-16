<x-app-layout>
    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-600">
            {{$post->name}}
        </h1>
        <div class="text-lg text-gray-500 mb-2">
            {!! $post->extract !!}
        </div>
        {{--Grid de Tailwind--}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{--Contenido principal--}}
            <div class="lg:col-span-2">
                <figure>
                    @if($post->image)
                        <img class="w-full h-80 object-cover object-center" src="{{ \Illuminate\Support\Facades\Storage::url($post->image->url) }}" alt="{{$post->name}}">
                    @else
                        <img class="w-full h-80 object-cover object-center" src="https://images.pexels.com/photos/1591056/pexels-photo-1591056.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="{{$post->name}}">
                    @endif
                </figure>
                <div class="text-base text-gray-500 mt-4">
                    {!! $post->body !!}
                </div>
            </div>
            {{--Contenido relacionado--}}
            <aside>
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Más en {{$post->category->name}}</h1>
                <ul>
                    @foreach($similares as $similar)
                        <li class="mb-4">
                            <a class="flex" href="{{route('posts.show',$similar)}}">
                                @if($similar->image)
                                    <img class="w-36 object-cover object-center" src="{{\Illuminate\Support\Facades\Storage::url($similar->image->url)}}" alt="{{$similar->name}}">
                                @else
                                    <img class="w-36 object-cover object-center" src="https://images.pexels.com/photos/1591056/pexels-photo-1591056.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">
                                @endif

                                <span class="ml-2 text-gray-600">{{$similar->name}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>
</x-app-layout>
