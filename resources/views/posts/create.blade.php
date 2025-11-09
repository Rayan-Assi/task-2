@extends('layouts.app')

@section('title', 'add post')

@section('content')
    <form action="{{ route('posts.store') }}" class="form1" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>Add New Post </h1>
        <div class="mb-3">
            <label for="posttitle" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="posttitle" placeholder="title " required>
        </div>
        <div class="mb-3">
            <label for="postdescription" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="postdescription" placeholder="post description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="choosingflie" class="form-label">choose image files</label>

            <input class="form-control" type="file" name="image[]" multiple id="choosingflie" required> 
        </div>
        <div class="d-grid gap-2">
            <input type="submit" value="Send" class="btn btn-primary " required>
        </div>
    </form>
@endsection
