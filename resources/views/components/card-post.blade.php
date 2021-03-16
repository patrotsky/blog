@props(['post'])

{{--Tarjeta en Tailwind--}}
<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">{{--overflow hidden, para que las esquinas superiores de la tarjeta también estén redondeadas--}}
    @if($post->image)
        <img class="w-full h-80 object-cover object-center" src="{{ \Illuminate\Support\Facades\Storage::url($post->image->url) }}" alt="{{$post->name}}">
    @else
        <img class="w-full h-80 object-cover object-center" src="https://images.pexels.com/photos/1591056/pexels-photo-1591056.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="{{$post->name}}">
    @endif
    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{route('posts.show',$post)}}">
                {{$post->name}}
            </a>
        </h1>
        <div class="text-gray-700 text-base">
            {!! $post->extract !!}
        </div>
    </div>
    <div class="px-6 pt-4 pb-2">
        @foreach($post->tags as $tag)
            <a class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray-700 mr-2.5" href="{{ route('posts.tag',$tag) }}">{{$tag->name}}</a>
        @endforeach
    </div>
</article>
