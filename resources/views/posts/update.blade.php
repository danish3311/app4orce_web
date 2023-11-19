@extends('layouts.master')

@section('content')

<div class="container mx-auto mt-8">
    <form action="{{ route('posts.update',$post['id']) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        @csrf
        <h2 class="text-2xl font-semibold mb-4">Create a Post</h2>

        <!-- Title Field -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" id="title" value="{{$post['title']}}" name="title" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">
        </div>

        <!-- Content Field -->
        <div class="mb-6">
            <label for="content" class="block text-gray-700">Content</label>
            <textarea id="content" name="content" rows="4" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">{{$post['content']}}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none">
            Update Post
        </button>
    </form>
</div>

@endsection
