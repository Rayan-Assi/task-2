@extends('layouts.app')

@section('title', 'poste')

@section('content')

    <a href="{{ route('posts.create') }}"><button type="button" class="btn btn-outline-secondary" disabled>add new
            post</button></a>

    <div class="container">
        @forelse ($posts as $post)
            <div class="card">

                @php
                    $image = DB::table('posts')->where('id', 1)->first();

                    $images = json_decode($post->image);
                @endphp
                @foreach ($images as $im)
                    <img src="/images/posts/{{ $im }}" alt="" width="300px" height="200px">
                @endforeach
                {{-- <img src="/images/posts/{{ $post->image }}" alt="" width="300px" height="200px"> --}}
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->description }}</p>
                <a href="{{ route('posts.edit', $post->id) }}"><button class="btn btn-outline-success">update</button></a>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>

                <a href="{{ route('posts.show', $post->id) }}"> <i class="fa fa-eye" aria-hidden="true"> show
                        more</i></a>
            </div>
        @empty
            <h3>there is no posts</h3>
        @endforelse
    </div>




@endsection
