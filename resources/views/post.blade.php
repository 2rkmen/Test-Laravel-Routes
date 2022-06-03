<x-layout>
    <article>
        <h1>{{$post->title}}</h1>
        <div>
            {!! $post->body !!}
        </div>
    </article>

    <p>
        <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
    </p>
</x-layout>
