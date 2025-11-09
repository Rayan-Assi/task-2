@extends('layouts.app')
@section('title', 'show post')

@section('content')

    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4 fath">
                {{-- ------------------------------------------------------------------------------- --}}
                @php
                    $image = DB::table('posts')->where('id', 1)->first();
                    $images = json_decode($posts->image);
                @endphp
                
                    @foreach ($images as $im)
                        <img src="/images/posts/{{ $im }}" alt="" width="250px" height="200px">
                    @endforeach
                
                {{-- --------------------------------------------------------------------------- --}}
                {{-- <img src="/images/posts/{{ $posts->image }}" class="img-fluid rounded-start" alt="...">
 --}}
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $posts->title }}</h5>
                    <p class="card-text">{{ $posts->description }}</p>
                </div>

             {{--    <p>added at :{{ $posts->created_at}}</p> --}}
            </div>
            <a href="{{ route('posts.index') }}"><button class="btn btn-outline-success">Back</button></a>
        </div>
    </div>


@endsection
